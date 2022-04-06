<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Http\Form\AdminCustomValidator;
use App\Models\User;
use App\Models\VerifyUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class UserController extends Controller
{
    public function __construct(AdminCustomValidator $form)
    {
       $this->form = $form;
    }
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->form->validate($request,'ValidateFormLogin');// validate
            // $request->only nhận một phần nhỏ giữ liệu trong form 
            $creds = $request->only('email', 'password');
            if(Auth::guard('web')->attempt($creds, $request->remember)){
                return redirect()->route('user.index');
            }else{
                return redirect()->route('user.login')->with('fail', 'Email hoặc password nhập sai');
            }
        }
        return view('dashboard.user.login');
    }
    // Đăng ký tài khoản
    public function signup(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->form->validate($request,'ValidateFormSignup'); // validate
            try
            {
                $request->merge(['password' => Hash::make($request->input('password'))]);
                $user = new User();
                $user->fill($request->all());
                $save = $user->save();
                $user_id = $user->id;
                $token = $user_id.hash('sha256', Str::random(120));
                $verifyURL = route('user.verify', ['token'=>$token, 'email'=>$user->email]);
                VerifyUser::create([
                    'user_id'=>$user_id,
                    'token'=>$token,
                ]);
                $mail_data = [
                    'email' => $request->email,
                    'recipient' => $request->name,
                    'subject' => 'Xác thực email',
                    // 'content' => $message,
                    'actionLink' => $verifyURL,
                ];
                Mail::send('email-template', ['mail_data' => $mail_data], function($message) use ($mail_data){
                        $message->to($mail_data['email'])
                                ->from($mail_data['email'], $mail_data['recipient'])
                                ->subject($mail_data['subject']);
                });
                return redirect()->back()->with('success', 'Đăng ký thành công, bạn cần xác minh tài khoản trước khi đăng nhập, chúng tôi đã gửi link xác thực qua email đăng ký của bạn.');
            } catch(Exception $e) 
            {
                return redirect()->back()->with('fail', 'Đã có lổi khi đăng ký');
            }
        }
        return view('dashboard.user.signup');
    }
    
    // Xác thực tài khoản email người dùng đăng ký
    public function verify(Request $request)
    {
        $token = $request->token;
        $start_day = Carbon::now();
        $created_at = $request->created_at;
        $expiration_date = $start_day->diffInDays($created_at);
        $verifyUser = VerifyUser::where('token', $token)->first();
        if($expiration_date <= 1){
            // phương thức first lấy ra một dòng dữ liệu, không có trả về Null 
            
            if(!is_null($verifyUser)){
                $user = $verifyUser->user;
                if(!$user->email_verified) 
                {
                    $verifyUser->user->email_verified_at = Carbon::now();
                    DB::table('verify_users')->where([
                        'token'=> $token
                    ])->delete();
                    $verifyUser->user->save();
                    return redirect()->route('user.login')->with('info', 'Email của bạn đã được xác minh thành công. Bây giờ bạn có thể đăng nhập.')->with('verifiedEmail', $user->email);
                } else
                {
                    return redirect()->route('user.login')->with('info', 'Email của bạn đã được xác minh thành công. Bây giờ bạn có thể đăng nhập.')->with('verifiedEmail', $user->email);
                }
            }
        } else {
            // nếu quá thời gian xác nhận thì sẻ xóa tài khoản đã lưu ở database
            DB::table('users')->where('email', $request->email)->delete();
            return redirect()->route('user.login')->with('fail', 'Thời gian xác nhận tài khoản đăng ký hết, vui lòng đăng ký lại.')->withInput();
        }
    }
    // Danh sách người dùng
    public function list(Request $request)
    {
        $users = User::orderby('id')->paginate(5);
        return view('dashboard.user.index', compact('users'));
    }
    public function search(Request $request)
    {
        if(isset($_POST['search']))
        {
            $search= $_POST['search'];
            $users = User::where('name', 'LIKE', '%'.$search.'%')->orwhere('email', 'LIKE', '%'.$search.'%')->orderby('id')->paginate(5);
            return view('dashboard.user.index', compact('users'));
        }else{
            return view('dashboard.user.index');
        }
    }
    // guard('web') được dùng để xác thực người dùng
    function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
    // Gửi email đặt lại mật khẩu
    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->form->validate($request,'ValidateFormForgotPass'); // validate
            $token = Str::random(64);
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $action_link = route('user.reset.password.form', ['token'=>$token, 'email'=>$request->email]);
            // $content = 'Chúng tôi nhận được yêu cầu đặt lại mật khẩu từ tài khoản email là '.$request->email.'. Bạn có thể đặt lại mật khẩu của mình bằng cách click vào liên kết phía dưới.';
            $detail_mail = [
                'action_link' => $action_link,
                'email'=>$request->email
            ];

            Mail::send('email-forgot',['detail_mail'=>$detail_mail], function($message) use($request){
                $message->from('noreply@example.com', 'admin');
                $message->to($request->email)
                        ->subject('Reset password');
            });
            return back()->with('success', 'Chúng tôi đã gửi link đổi mật khẩu qua email của bạn.');
        }
        return view('dashboard.user.forgot');
    }
    public function showreset(Request $request, $token = null)
    {
        return view('dashboard.user.reset')->with(['token'=>$token, 'email'=>$request->email]);
    }
    // Đặt lại mật khẩu mới
    public function resetPassword(Request $request)
    {
        $this->form->validate($request,'ValidateFormResetPass'); // validate
        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();
        if(!$check_token){
            return back()->withInput()->with('fail', 'Token không hợp lệ');
        }else{
            $start_day = Carbon::now();
            $expiration_date = $start_day->diffInDays($request->created_at);
            if($expiration_date <= 1)
            {
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
                DB::table('password_resets')->where([
                    'email'=> $request->email
                ])->delete();
                return redirect()->route('user.login')->with('info', 'Mật khẩu bạn đã được thay đổi, bạn đăng nhập bằng mật khẩu mới.')->with('verifiedEmail', $request->email);
            } else {
                DB::table('password_resets')->where([
                    'email'=> $request->email
                ])->delete();
                return redirect()->route('user.forgot.password')->with('fail', 'Link thay đổi lại mật khẩu đã hết hạn, vui lòng đặt lại mật khẩu');
            }
        }
    }
    // Xóa User
    public function delUser($id, Request $request)
    {
        $user = User::find($id);
        if($user->delete()){
            return redirect()->route('user.index')->with('msg', 'Xóa thành công');
        }
    }
    // Sửa tên người dùng
    public function editUser($id, Request $request)
    {
        $user = User::find($id);
        if($request->isMethod('post'))
        {
            $this->form->validate($request,'ValidateFormEditUser'); // validate
            if(isset($user))
            {
                $name = $request->name;
                User::where('email', $user->email)->update([
                    'name' => $request->name
                ]);
                return redirect()->route('user.index')->with('msg', 'Sửa thành công');
            }
        }
        return view('dashboard.user.edit', compact('user'));
    }
}

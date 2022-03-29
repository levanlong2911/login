@extends('templates.duan.master')
@section('content')
    <div class="row justify-content-center my-5 form-signup">
        <form action="{{ route('login') }}" method="post" class="col-md-6 bg-light p-3" >
            @csrf
            @if (Session::has('msg'))
                <div class="alert alert-danger">
                    {{ Session::get('msg') }}
                </div>
            @endif
            <h1 class="text-center text-uppercase h3 py-3">ĐĂNG NHẬP</h1>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com">
                <p class="help is-danger" style="color:red">{{ $errors->first('email') }}</p>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@">
                <p class="help is-danger" style="color:red">{{ $errors->first('password') }}</p>
            </div>
            <input type="checkbox" name="remember"> Ghi nhớ tài khoản?
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Đăng nhập">
            <a href="{{ route('auth.signup') }}" style="text-decoration: none;" class="row justify-content-center">Tạo tài khoản</a>
            <a href="forgotPass.php" style="text-decoration: none;" class="row justify-content-center">Quên mật khẩu</a>
        </form>
    </div> 
@endsection
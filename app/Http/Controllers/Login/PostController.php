<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderby('id', 'desc')->paginate(5);
        return view('dashboard.post.index', compact('posts'));
    }
    public function addPost(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $post = new Post();
            $post->fill($request->all());
            if($post->save())
            {
                return redirect()->route('user.post.index')->with('msg', 'Thêm thành công');
            } else {
                return redirect()->route('user.post.index')->with('msg', 'Đã có lổi khi thêm');
            }
        }
        return view('dashboard.post.add');
    }
    public function editPost($id, Request $request)
    {
        $posts = Post::find($id);
        if($request -> isMethod('POST')) 
        {
            Post::where('id', $posts->id)->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
            return redirect()->route('user.post.index')->with('msg', 'Sửa thành công');
        }
        return view('dashboard.post.edit', compact('posts'));
    }
    public function delPost($id, Request $request)
    {
        $post = Post::find($id);
        if($post->delete()) {
            return redirect()->route('user.post.index')->with('msg', 'Xóa thành công');
        }
    }
    public function searchPost(Request $request)
    {
        if(isset($_POST['search']))
        {
            $search= $_POST['search'];
            $posts = Post::where('title', 'LIKE', '%'.$search.'%')->orwhere('content', 'LIKE', '%'.$search.'%')->orderby('id', 'desc')->paginate(5);
            return view('dashboard.post.index', compact('posts'));
        }else{
            return view('dashboard.post.index');
        }
    }
}

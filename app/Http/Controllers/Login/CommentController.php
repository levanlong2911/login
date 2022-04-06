<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderby('id', 'desc')->paginate(5);
        return view('dashboard.comment.index', compact('comments'));
    }
    public function addComment(Request $request)
    {
        if($request->isMethod('post'))
        {
                $comment = new Comment();
                $comment->fill($request->all());
                $comment['user_id'] = Auth::user()->id;
                $comment['name'] = Auth::user()->name;
                if($comment->save())
                {
                    return redirect()->back();
                }
        }
        return view('dashboard.home.detail');
    }
    public function delComment($id, Request $request)
    {
        $comments = Comment::find($id);
        if($comments->delete()){
            return redirect()->route('user.comment.index')->with('msg', 'Xóa thàng công');
        }
    }
    
    public function searchComment(Request $request)
    {
        if(isset($_POST['search']))
        {
            $search = $_POST['search'];
            $comments = Comment::where('name', 'LIKE', '%'.$search.'%')->orderby('id')->paginate(5);
            return view('dashboard.comment.index', compact('comments'));
        } else {
            return view('dashboard.comment.index');
        }
    }
}

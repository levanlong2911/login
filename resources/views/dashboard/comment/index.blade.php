@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Quản lý Comment</h3>
    @if (Session::get('msg'))
        <p class="category success">{{ Session::get('msg') }}</p>
    @endif
    <br/>
    <form action="" method="post">
        @csrf
        <input type="text" name="search" id="" placeholder="Search">
        <input type="submit" name="submit" value="Tìm kiếm">
        <br/><br/>
    </form>
        @if(isset($comments))
                <table class="table table-bordered table-hover center">
                    <thead>
                        <tr>
                            <th scope="col" width="20px">id</th>
                            <th scope="col" width="400px">Post_id</th>
                            <th scope="col" width="400px">Comment</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($comments) > 0)
                            @foreach ($comments as $comment)
                                @php
                                    // $id = $post->id;
                                    // $title = $post->title;
                                    // $content = $post->content;
                                    // $slug = Str::slug($name);
                                    // $urlDel = route('user.del', ['id'=>$id]);
                                @endphp
                                <tr>
                                    <th scope="row">{{ $comment->id }}</th>
                                    <td>{{ $comment->post_id }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->user_id }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>
                                        <a href="{{ route('user.comment.del', ['id'=>$comment->id]) }}" title="" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                    </td>
                                </tr>  
                            @endforeach
                        @else
                            <tr><td colspan="4">Không có dữ liệu</td></tr>
                        @endif
                    </tbody>
                </table>
            <div class="text-center">
                {{ $comments->links() }}
            </div>
        @endif
</div>
</div>
@endsection
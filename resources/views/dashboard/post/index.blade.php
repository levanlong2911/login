@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Quản lý Post</h3>
    @if (Session::get('msg'))
        <p class="category success">{{ Session::get('msg') }}</p>
    @endif
    <br/>
    <div>
        <a href="{{ route('user.post.add') }}" class="btn btn-primary">Thêm</a>
    </div>
    <br/>
    <form action="{{ route('user.post.search') }}" method="post">
        @csrf
        <input type="text" name="search" id="" placeholder="Search">
        <input type="submit" name="submit" value="Tìm kiếm">
        <br/><br/>
    </form>
        @if(isset($posts))
            <table class="table table-bordered table-hover center">
                <thead>
                    <tr>
                        <th scope="col" width="20px">id</th>
                        <th scope="col" width="400px">Title</th>
                        <th scope="col" width="400px">Content</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($posts) > 0)
                        @foreach ($posts as $post)
                            {{-- @php
                                // $id = $post->id;
                                // $title = $post->title;
                                // $content = $post->content;
                                // $slug = Str::slug($name);
                                // $urlDel = route('user.del', ['id'=>$id]);
                            @endphp --}}
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td>
                                    <a href="{{ route('user.post.edit', ['id'=>$post->id]) }}" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                    
                                    <a href="{{ route('user.post.del', ['id'=>$post->id]) }}" title="" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                </td>
                            </tr>  
                        @endforeach
                    @else
                        <tr><td colspan="4">Không có dữ liệu</td></tr>
                    @endif
                </tbody>
            </table>
        
        <div class="text-center">
            {{ $posts->links() }}
        </div>
        @endif
</div>
</div>
@endsection
@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Sửa Post</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('user.post.edit', $posts->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề</label><br/>
                    <textarea name="title" id="" cols="80" rows="5">{{ Null !== old('name') ? old('name') : $posts->title }}</textarea>
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="email">Nội dung:</label><br/>
                    <textarea name="content" id="" cols="80" rows="5" value="">{{ Null !== old('name') ? old('name') : $posts->content }}</textarea>
                </div>
                <input type="submit" name="submit" value="Sửa">
            </form>
        </div>

    </div>
</div>
</div>
@endsection
@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Thêm Post</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('user.post.add') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề</label><br/>
                    <textarea name="title" id="" cols="80" rows="5"></textarea>
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>
                <div class="form-group">
                    <label for="email">Nội dung:</label><br/>
                    <textarea name="content" id="" cols="80" rows="5"></textarea>
                </div>
                <input type="submit" name="submit" value="Thêm">
            </form>
        </div>

    </div>
    
   
</div>
</div>
@endsection
@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Sửa người dùng</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="{{ route('user.edit', $user->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ Null !== old('name') ? old('name') : $user->name }}">
                </div>
                <!-- không cho đổi thay đổi gmail -->
                <div class="form-group">
                    <label for="email">Email</label> 
                    <input type="text" class="form-control" readonly name="email" id="email" value="{{ null !== old('email') ? old('email') : $user->email }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="passwordconfirm">Passwordconfirm</label>
                    <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm">
                </div>
                <input type="submit" name="submit" value="Sửa">
            </form>
        </div>

    </div>
    
   
</div>
</div>
@endsection
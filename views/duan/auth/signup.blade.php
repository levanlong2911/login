@extends('templates.duan.master')
@section('content');
<div class="row justify-content-center my-5 form-signup">
    <form action="{{ route('auth.signup') }}" method="post" class="col-md-6 bg-light p-3">
        @csrf
        @if (Session::has('msg'))
            <div class="alert alert-success">
                {{ Session::get('msg') }}
            </div>
        @endif
        <h1 class="text-center text-uppercase h3 py-3">ĐĂNG KÝ TÀI KHOẢN</h1>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="VD: Nguyễn Văn A">
            <p class="help is-danger" style="color:red">{{ $errors->first('name') }}</p>
        </div>
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
        <div class="form-group">
            <label for="passwordconfirm">Password confirm</label>
            <input type="password" name="passwordconfirm" id="passwordconfirm" class="form-control" placeholder="Xác nhận lại password">
            <p class="help is-danger" style="color:red">{{ $errors->first('passwordconfirm') }}</p>
        </div>
        <!-- <button type="submit" name="submit" onclick="validate();" >Đăng ký</button> -->
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Đăng ký">
    </form>
</div>
@endsection
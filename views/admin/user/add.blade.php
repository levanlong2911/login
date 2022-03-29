@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Thêm người dùng</h3>
    <div class="row">
        @foreach ($errors->all() as $er)
            <p style="color:red">{{ $er }}</p>
        @endforeach
        <div class="col-md-4">
            <form action="{{ route('user.add') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label> 
                    <input type="text" class="form-control" name="email" id="email" > 
                    {{-- thiếu value --}}
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
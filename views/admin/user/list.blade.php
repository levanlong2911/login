@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Quản lý người dùng</h3>
    @if (Session::has('msg'))
        <p class="category success">{{ Session::get('msg') }}</p>
    @endif
    <div>
        <a href="{{ route('user.add') }}" class="btn btn-primary">Thêm</a>
    </div>
    <br/>
    <form action="" method="post">
        <input type="text" name="name" id="" placeholder="Name">
        <input type="submit" name="submit" value="Tìm kiếm">
        <br/><br/>
    </form>
    <table class="table table-bordered table-hover center">
        <thead>
            <tr>
                <th scope="col" width="20px">id</th>
                <th scope="col" width="400px">Name</th>
                <th scope="col" width="400px">Email</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Users as $User)
                @php
                    $id = $User->id;
                    $name = $User->name;
                    $email = $User->email;
                    $slug = Str::slug($name);
                    $urlDel = route('user.del', ['id'=>$id]);
                    $urlEdit = route('user.edit', ['id'=>$id]);
                @endphp
                <tr>
                    <th scope="row">{{ $id }}</th>
                    <td>{{ $name }}</td>
                    <td>{{ $email }}</td>
                    <td>
                        <a href="{{ $urlEdit }}" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                        
                        <a href="{{ $urlDel }}" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                        
                    </td>
                </tr>  
            @endforeach
            
        </tbody>
    </table>
    <div class="text-center">
        {{ $Users->links() }}
    </div>
    
</div>
</div>
@endsection
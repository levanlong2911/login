@extends('templates.admin.master')
@section('main-content')
<div class="content-home">
    <h3>Quản lý người dùng</h3>
    @if (Session::get('msg'))
        <p class="category success">{{ Session::get('msg') }}</p>
    @endif
    <br/>
    <form action="{{ route('user.search') }}" method="post">
        @csrf
        <input type="text" name="search" id="" placeholder="Search">
        <input type="submit" name="submit" value="Tìm kiếm">
        <br/><br/>
    </form>
    @if (isset($users))
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
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        @php
                            $id = $user->id;
                            $name = $user->name;
                            $email = $user->email;
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
                                
                                <a href="{{ $urlDel }}" title="" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                            </td>
                        </tr>  
                    @endforeach
                @else
                    <tr><td colspan="4">Không có dữ liệu</td></tr>
                @endif
            </tbody>
        </table>
        <div class="text-center">
            {{ $users->links() }}
        </div>
    @endif
    
    
</div>
</div>
@endsection
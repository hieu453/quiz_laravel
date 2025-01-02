@extends('admin.app')
@section('title', 'Người dùng | Sửa')
@section('content')
@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('email')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('current_password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@error('password')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="my-3 mx-3">
    <div class="row">
        <div class="col-6">
            <h2>Sửa thông tin người dùng</h2>
        </div>
        <div class="col-6">
            <a href="{{ route('user.all') }}" class="btn btn-secondary float-end">Trở lại</a>
        </div>
    </div>
    <div class="mb-3 border rounded px-2 py-2">
        <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Vai trò</label>
                <select name="is_admin" class="form-select">
                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Người dùng</option>
                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Quản trị viên</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên người dùng</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
    <div class="mb-3 border rounded px-2 py-2">
        <form action="{{ route('user.update.password', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" class="form-control" value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu mới</label>
                <input type="password" name="password" class="form-control" value="">
            </div>
            <div class="mb-3">
                <label class="form-label">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" value="">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div>
</div>
@endsection


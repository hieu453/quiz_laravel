@extends('admin.app')
@section('title', 'Người dùng | Tất cả')
@section('content')

{{-- Modal Add --}}
@include('admin.users.modals.add-modal')
{{-- Modal Delete --}}
@include('admin.users.modals.delete-modal')

<div class="container-fluid px-4">
    <h1 class="mt-4">Tất cả người dùng</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @if ($errors->get('password'))
        @foreach ($errors->get('password') as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    @if ($errors->get('password_confirmation'))
        @foreach ($errors->get('password_confirmation') as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                Thêm người dùng
            </button>
        </div>
        <div class="card-body">
            <table id="usersTable" class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Tạo lúc</th>
                    <th>Sửa lúc</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td></td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Quản trị viên' : 'Người dùng' }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-success">Sửa</a>
                            <a class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#userDeleteModal">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('javascript')
<script>
    const columnsSettings = [
        { searchable: false },
        { searchable: false },
        null,
        { searchable: false },
        { searchable: false },
        { searchable: false },
        { searchable: false },
        { searchable: false },
    ]
    datatable('#usersTable', '#userDeleteModal', "{{ route('user.deleteMultiple') }}", columnsSettings, [1,2,3,4,5,6])
</script>
@endpush

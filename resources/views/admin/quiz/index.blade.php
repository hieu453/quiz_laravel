@extends('admin.app')
@section('title', 'Môn học | Tất cả')
@section('content')
    <!-- Modal Delete -->
    @include('admin.quiz.modals.delete-modal')

    {{-- Modal Add --}}
    @include('admin.quiz.modals.add-modal')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Tất cả môn học</h1>

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addQuizModal">
                    Thêm môn học
                </button>
            </div>
            <div class="card-body">
                <table id="quizTable" class="table table-striped display">
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th>Danh mục</th>
                        <th>Tiêu đề</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tfoot>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Danh mục</th>
                        <th>Tiêu đề</th>
                        {{-- <th>Mô tả</th> --}}
                        {{-- <th>Đã có câu hỏi</th> --}}
                        <th>Trạng thái</th>
                        <th>Tạo lúc</th>
                        <th>Sửa lúc</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td></td>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->category->name }}</td>
                            <td>{{ $quiz->title }}</td>
                            {{-- <td>{{ $quiz->description }}</td> --}}
                            {{-- <td>{{ $quiz->has_questions ? 'Đã có' : 'Chưa có' }}</td> --}}
                            <td><span class="badge rounded-pill text-bg-{{ $quiz->status ? 'primary' : 'danger' }}">{{ $quiz->status ? 'Đang mở' : 'Đã khóa' }}</span></td>
                            <td>{{ $quiz->created_at }}</td>
                            <td>{{ $quiz->updated_at }}</td>
                            <td>
                                <a href="{{ route('quiz.edit', ['id' => $quiz->id]) }}" class="btn btn-sm btn-outline-success">Sửa</a>
                                <a class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#quizDeleteModal">Xóa</a>
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
    datatable('#quizTable', '#quizDeleteModal', "{{ route('quiz.deleteMultiple') }}", [2,3])
</script>
@endpush

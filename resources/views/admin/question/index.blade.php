@extends('admin.app')
@section('title', 'Câu hỏi | Tất cả')
@section('content')
    <!-- Modal Delete -->
    @include('admin.question.modals.delete-modal')
    {{-- Modal Add --}}
    @include('admin.question.modals.add-modal')

    <div class="container-fluid px-4">
        <h1 class="mt-4">Tất cả câu hỏi</h1>

        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('options')
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
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                    Thêm câu hỏi
                </button>
            </div>
            <div class="card-body">
                <table id="questionTable" class="table table-striped">
                    <tfoot>
                        <th></th>
                        <th></th>
                        <th>Môn học</th>
                        <th>Tiêu đề câu hỏi</th>
                        {{-- <th>Đã có lựa chọn</th> --}}
                        <th></th>
                        <th></th>
                    </tfoot>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Môn học</th>
                        <th>Tiêu đề câu hỏi</th>
                        {{-- <th>Đã có lựa chọn</th> --}}
                        <th>Tạo lúc</th>
                        <th>Sửa lúc</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td></td>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->quizz->title }}</td>
                            <td class="truncated-name">{{ $question->title }}</td>
                            {{-- <td>{{ $question->has_options ? 'Đã có' : 'Chưa có' }}</td> --}}
                            <td>{{ $question->created_at }}</td>
                            <td>{{ $question->updated_at }}</td>
                            <td>
                                <a href="{{ route('question.edit', ['id' => $question->id]) }}" class="btn btn-sm btn-outline-success">Sửa</a>
                                <a class="btn btn-sm btn-outline-danger"  data-bs-toggle="modal" data-bs-target="#questionDeleteModal">Xóa</a>
                                {{-- <form action="{{ route('question.delete', ['id' => $question->id]) }}" method="POST" class="btn">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form> --}}
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
    datatable('#questionTable', '#questionDeleteModal', "{{ route('question.deleteMultiple') }}", [2,3])

    let truncatedString = $('.truncated-name');
    for (let i = 0; i < truncatedString.length; ++i) {
        if (truncatedString[i].textContent.length > 30) {
            truncatedString[i].textContent = truncatedString[i].textContent.substring(0, 15) + '...'
        }
    }
</script>
@endpush

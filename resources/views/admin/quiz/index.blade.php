@extends('admin.app')
@section('content')
    <!-- Modal Delete -->
    @include('admin.quiz.modals.delete-modal')

    {{-- Modal Add --}}
    @include('admin.quiz.modals.add-modal')

    <div class="container-fluid px-4">
        <h1 class="mt-4">All Quizzes</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuizModal">
                    Add Quiz
                </button>
            </div>
            <div class="card-body">
                <table id="quizTable" class="table table-striped display">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td></td>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->category->name }}</td>
                            <td>{{ $quiz->created_at }}</td>
                            <td>{{ $quiz->updated_at }}</td>
                            <td>
                                <a href="{{ route('quiz.edit', ['id' => $quiz->id]) }}" class="btn btn-sm btn-success">Update</a>
{{--                                <form action="{{ route('quiz.delete', ['id' => $quiz->id]) }}" method="POST" class="btn">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                </form>--}}
                                <a class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#quizDeleteModal">Delete</a>
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
    ]
    datatable('#quizTable', '#quizDeleteModal', "{{ route('quiz.deleteMultiple') }}", columnsSettings)
</script>
@endpush

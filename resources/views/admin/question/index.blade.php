@extends('admin.app')
@section('content')
    <!-- Modal Delete -->
    @include('admin.question.modals.delete-modal')
    {{-- Modal Add --}}
    @include('admin.question.modals.add-modal')

    <div class="container-fluid px-4">
        <h1 class="mt-4">All Questions</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                    Add Question
                </button>
            </div>
            <div class="card-body">
                <table id="questionTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Id</th>
                        <th>Quiz</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr>
                            <td></td>
                            <td>{{ $question->id }}</td>
                            <td>{{ $question->quizz->title }}</td>
                            <td>{{ $question->title }}</td>
                            <td>{{ $question->created_at }}</td>
                            <td>{{ $question->updated_at }}</td>
                            <td>
                                <a href="{{ route('question.edit', ['id' => $question->id]) }}" class="btn btn-sm btn-success">Update</a>
                                <a class="btn btn-sm btn-danger"  data-bs-toggle="modal" data-bs-target="#questionDeleteModal">Delete</a>
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
    const columnsSettings = [
        { searchable: false },
        { searchable: false },
        { searchable: false },
        null,
        { searchable: false },
        { searchable: false },
        { searchable: false },
    ]
    datatable('#questionTable', '#questionDeleteModal', "{{ route('question.deleteMultiple') }}", columnsSettings)
</script>
@endpush

@extends('admin.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">All Quizzes</h1>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->created_at }}</td>
                            <td>{{ $quiz->updated_at }}</td>
                            <td>
                                <a href="{{ route('quiz.edit', ['id' => $quiz->id]) }}" class="btn btn-sm btn-success">Update</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

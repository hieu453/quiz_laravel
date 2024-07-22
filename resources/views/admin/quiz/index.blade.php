@extends('admin.app')
@section('content')
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
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="quizTable" class="table table-striped display">
                    <thead>
                    <tr>
                        <th></th>
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
                            <td></td>
                            <td>{{ $quiz->id }}</td>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->created_at }}</td>
                            <td>{{ $quiz->updated_at }}</td>
                            <td>
                                <a href="{{ route('quiz.edit', ['id' => $quiz->id]) }}" class="btn btn-sm btn-success">Update</a>
                                <form action="{{ route('quiz.delete', ['id' => $quiz->id]) }}" method="POST" class="btn">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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
    // let table = $('quizTable').DataTable()
    const ids = [];
    let state = false;

    let table = new DataTable('#quizTable', {
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        layout: {
            topStart: {
                buttons: [
                    {
                        text: 'Delete record(s): 0',
                        className: 'btn btn-success',
                        action: function () {
                            const ids = [];
                            const data = table.rows({ selected: true }).data();
                            data.each((item) => {
                                // push id of each item into ids array
                                ids.push(item[1])
                            })

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: '/admin/quiz-deleteMultiple',
                                type: 'DELETE',
                                data: {
                                    ids: ids
                                },
                                success: function (data) {
                                    table.rows({ selected: true }).remove().draw();
                                    table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
                                    table.button().disable();

                                    Toastify({
                                        text: "Selected rows deleted",
                                        close: true,
                                        duration: 2000
                                    }).showToast();
                                }
                            })
                        }
                    }
                ]
            }
        },
        select: true,
    })

    table.button().disable();

    table.on('select', () => {
        table.button().enable();
        table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
    })

    table.on('deselect', () => {
        if (table.rows({ selected: true }).count()) {
            table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
        } else {
            table.button().text(`Delete record(s): ${table.rows({ selected: true }).count()}`);
            table.button().disable();
        }
    })

</script>
@endpush

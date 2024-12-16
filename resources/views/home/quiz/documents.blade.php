@extends('home.app')
@section('title', 'Tài liệu')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="d-flex mb-3 justify-content-between">
            <h3>Tài liệu ôn tập</h3>
            <a href="{{ route('quiz.detail', ['id' => $quiz_id]) }}" class="btn btn-outline-secondary float-end">Trở lại</a>
        </div>
        @if (count($documents) != 0)
            <table class="table table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Video Youtube</th>
                        <th>Tài liệu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents as $key => $document)
                        <tr>
                            <td><a href="{{ $document->youtube_link }}" target="_blank">Xem video {{ ++$key }}</a></td>
                            <td><a href="{{ $document->document_link }}" target="_blank">Tài liệu ôn tập {{ $key }}</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div>
                <h4 class="text-center">Chưa có tài liệu</h4>
            </div>
        @endif
    </div>
</div>
@endsection

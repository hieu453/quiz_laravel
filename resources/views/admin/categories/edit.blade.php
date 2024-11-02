@extends('admin.app')
@section('content')
    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputText" class="form-label">Category</label>
            <input type="text" name="name" class="form-control" value="{{ $category->name }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

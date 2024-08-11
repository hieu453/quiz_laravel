@extends('admin.app')
@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Activities</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Activities</li>
        </ol>
        <div class="row" id="activities">
        </div>
    </div>
@endsection
@push('javascript')
<script type="module">
    Echo.channel('admin')
    .notification((notification) => {
        console.log(notification.type)
    });
</script>
@endpush


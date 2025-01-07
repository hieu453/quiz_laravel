@extends('admin.app')
@section('title', 'Tất cả phản hồi')
@section('content')
<div class="container mt-5">
    <div class="mb-3">
        <h3>Tất cả phản hồi</h3>
    </div>
    @foreach ($notifications as $notification)
    <a href="{{ route('feedback.detail', ['id' => $notification->id]) }}" class="text-reset text-decoration-none notification-link">
        <div class="d-flex flex-row border rounded px-3 py-3 mb-3">
            <div class="d-flex align-items-center rounded-circle px-3" style="background-color: #cbc8c8;"><i class="fa-solid fa-user" style="font-size: 30px; padding: 10px;"></i></div>
            <div class="ms-3">
                <h4>{{ $notification->data['title'] }}</h4>
                <p class="truncated">{{ $notification->data['body'] }}</p>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection
@push('javascript')
<script>
    function truncateNotificationBody() {
        let truncatedString = $('.truncated');
        console.log(truncatedString)

        for (let i = 0; i < truncatedString.length; ++i) {
            if (truncatedString[i].textContent.length > 100) {
                truncatedString[i].textContent = truncatedString[i].textContent.substring(0, 100) + '...'
            }
        }
    }

    truncateNotificationBody();
</script>
@endpush

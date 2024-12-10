<div>
<li class="nav-item dropdown">
    <a class="nav-link iconClass" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-regular fa-bell">
            <span class="badge badege-light text-danger">
                @if (count(Auth::user()->unreadNotifications) > 0)
                    <i class="fa-solid fa-circle"></i>
                @endif
            </span>
        </i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end announcements shadow" style="max-height: 350px; max-width: 400px; min-width: 300px;">
        <div class="sticky-top text-center header-notification py-2"><h3>Thông báo</h3></div>
        <div id="announcements-wrapper">
            @foreach (Auth::user()->notifications as $key => $notification)
                @if ($key === 10)
                @break
                @endif
                    <li class="mb-1">
                        <a class="dropdown-item {{ $notification->read_at == null ? 'listBgColor' : '' }}" href="#" wire:click.prevent="showNotification('{{$notification->id}}')">
                            <h5>{{ $notification->data['title'] }}</h5>
                            <p class="truncated-string">{{ $notification->data['body'] }}</p>
                        </a>
                    </li>
            @endforeach
        </div>
        @if (count(Auth::user()->notifications) > 0)
            @if (Auth::user()->is_admin == 1)
                <p class="text-center sticky-bottom footer-notification py-1"><a href="{{ route('notification.admin') }}" class="text-decoration-none text-secondary">Xem tất cả thông báo</a></p>
            @else
                <p class="text-center sticky-bottom footer-notification py-1"><a href="{{ route('notification.user') }}" class="text-decoration-none text-secondary">Xem tất cả thông báo</a></p>
            @endif
        @else
            <p class="text-center sticky-bottom footer-notification py-1">Chưa có thông báo nào</p>
        @endif
    </ul>
</li>
</div>
<script type="module">
function truncateNotificationBody() {
    let truncatedString = $('.truncated-string');

    for (let i = 0; i < truncatedString.length; ++i) {
        if (truncatedString[i].textContent.length > 35) {
            truncatedString[i].textContent = truncatedString[i].textContent.substring(0, 35) + '...'
        }
    }
}

truncateNotificationBody();

Echo.channel('all')
    .notification((notification) => {
        // chỉ những user đang đăng nhập có trong danh sách sentUsers mới được gửi thông báo bình luận mới
        if (notification.sentUsers.includes({{ Auth::user()->id }})) {
            const announcementsWrapper = $('#announcements-wrapper')
            const announcementList = $('.announcements li')

            if ($('.fa-bell').children().length > 0) {
                $('.badge').html(`
                    <i class="fa-solid fa-circle"></i>
                `)
            }

            if (announcementsWrapper.children().length == 10) {
                announcementList.last().remove()
                announcementsWrapper.prepend(`
                    <li class="mb-1">
                        <a class="dropdown-item listBgColor" href="#" wire:click.prevent="showNotification('${notification.id}')">
                            <h5>${notification.title}</h5>
                            <p class="truncated-string">${notification.body}</p>
                        </a>
                    </li>
                `)
            } else {
                announcementsWrapper.prepend(`
                    <li class="mb-1">
                        <a class="dropdown-item listBgColor" href="#" wire:click.prevent="showNotification('${notification.id}')">
                            <h5>${notification.title}</h5>
                            <p class="truncated-string">${notification.body}</p>
                        </a>
                    </li>
                `)
            }

            truncateNotificationBody();
        }
    });

Echo.private('feedback')
    .notification((notification) => {
        const announcementsWrapper = $('#announcements-wrapper')
        const announcementList = $('.announcements li')

        if ($('.fa-bell').children().length > 0) {
            $('.badge').html(`
                <i class="fa-solid fa-circle"></i>
            `)
        }

        if (announcementsWrapper.children().length == 10) {
            announcementList.last().remove()
            announcementsWrapper.prepend(`
                <li class="mb-1">
                    <a class="dropdown-item listBgColor" href="#" wire:click.prevent="showNotification('${notification.id}')">
                        <h5>${notification.title}</h5>
                        <p class="truncated-string">${notification.body}</p>
                    </a>
                </li>
            `)
        } else {
            announcementsWrapper.prepend(`
                <li class="mb-1">
                    <a class="dropdown-item listBgColor" href="#" wire:click.prevent="showNotification('${notification.id}')">
                        <h5>${notification.title}</h5>
                        <p class="truncated-string">${notification.body}</p>
                    </a>
                </li>
            `)
        }

        truncateNotificationBody();
    })
</script>



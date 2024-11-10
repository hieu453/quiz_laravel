<div>
<li class="nav-item dropdown">
    <a class="nav-link iconClass" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-regular fa-bell">
            @if (count(Auth::user()->unreadNotifications) > 0)
                <span class="badge badege-light text-danger"><i class="fa-solid fa-circle"></i></span>
            @endif
        </i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end announcements shadow" style="max-height: 350px; min-width: 300px;">
        <div class="sticky-top text-center header-notification py-2"><h3>Thông báo</h3></div>
        @foreach (Auth::user()->notifications as $key => $notification)
            @if ($key === 10)
            @break
            @endif
                <li>
                    <a class="dropdown-item {{ $notification->read_at == null ? 'listBgColor' : '' }}" href="#" wire:click.prevent="markAsRead('{{ $notification->id }}')">
                        <h5>{{ $notification->data['title'] }}</h5>
                        {{ $notification->data['body'] }}
                    </a>
                </li>
        @endforeach
        <p class="text-center sticky-bottom footer-notification py-1"><a href="" class="text-decoration-none text-info-emphasis">Xem tất cả thông báo</a></p>
    </ul>
</li>
</div>
<script type="module">
Echo.channel('all')
    .notification((notification) => {
        const announcementsWrapper = $('.announcements')
        const announcementList = $('.announcements li')

        if ($('.fa-bell').children().length > 0) {
            $('.badge').text(notification.unread)
        }

        if (announcementsWrapper.children().length == 10) {
            announcementList.last().remove()
            announcementsWrapper.prepend(`
                <li class="announcement"><a class="dropdown-item" href="#">${notification.body}</a></li>
            `)
        } else {
            announcementsWrapper.prepend(`
                <li class="announcement"><a class="dropdown-item" href="#">${notification.body}</a></li>
            `)
        }


    });
</script>



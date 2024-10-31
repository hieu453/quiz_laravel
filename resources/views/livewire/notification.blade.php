<li class="nav-item dropdown">
    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-regular fa-bell">
            <span class="badge text-bg-secondary">{{ Auth::user()->unreadNotifications->count() }}</span>
        </i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end announcements overflow-auto" style="max-height: 300px; min-width: 400px;">
        @foreach (Auth::user()->notifications as $key => $notification)
            @if ($key === 10)
            @break
            @endif
            <li class="announcement row">
                <div class="col-10">
                    <a class="dropdown-item" href="#" wire:click.prevent="markAsRead('{{ $notification->id }}')">
                        <h5>{{ $notification->data['title'] }}</h5>
                        {{ $notification->data['body'] }}
                    </a>
                </div>
                <div class="col-2 d-flex align-items-center">
                    @if ($notification->read_at == null)
                        <i class="fa-solid fa-circle-dot"></i>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</li>

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


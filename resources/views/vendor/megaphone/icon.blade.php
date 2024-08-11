<button type="button"
        id="bell-button"
        aria-label="show notifications"
        class="font-sans text-gray-900"
        @click="open = true"
>
    <span class="sr-only">Show Notifications</span>
    <svg class="h-full w-full fill-black dark:fill-white" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
    </svg>
    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="h-9 w-9 mt-1">
        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
    </svg> --}}


    @if ($unread->count() > 0)
        @if($showCount)
            <span id="unread-count" aria-label="unread count" class="absolute top-0 left-0 aspect-square max-h-fit rounded-full border-2 bg-red-500 px-1.5 shadow leading-5 text-white font-semibold text-xs">
                {{ $unread->count() }}
            </span>
        @else
            <span aria-label="has unread notifications" class="absolute top-0 left-0 aspect-square h-2/5 rounded-full bg-red-500 shadow">
        @endif
    @endif
</button>

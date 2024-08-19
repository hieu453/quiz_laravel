<div>
    {{-- <form class="d-flex" role="search"> --}}
        <input wire:model.live="search" class="form-control me-2" type="text" placeholder="Search">
        {{-- <button class="btn btn-outline-success" type="submit">Search</button> --}}
    {{-- </form> --}}
    <ul class="list-group">
        @foreach ($users as $user)
        <li class="list-group-item">{{ $user->name }}</li>
        @endforeach
    </ul>
</div>

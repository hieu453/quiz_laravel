<nav class="navbar navbar-expand-lg fixed-top" style="background-color: rgb(220, 205, 186)">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="https://media.istockphoto.com/id/1186386668/vector/quiz-in-comic-pop-art-style-quiz-brainy-game-word-vector-illustration-design.jpg?s=612x612&w=0&k=20&c=mBQMqQ6kZuC9ZyuV5_uCm80QspqSJ7vRm0MfwL3KLZY=" alt="" width="30" height="24" style="border-radius: 30px">
        </a>
        <div class="collapse navbar-collapse d-flex justify-content-between">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.category.all') }}">Danh mục</a>
                </li>
            </ul>
            <div class="">
                <form action="{{ route('home.category.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="c" class="form-control rounded-start-pill" placeholder="Tìm kiếm">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            @if (Auth::check())
                <div class="d-none d-md-inline-block form-inline me-0 me-md-3 my-2 my-md-0">
                    <ul class="nav navbar-nav navbar-right ms-md-0 me-3 me-lg-4">
                        <livewire:notification />
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>{{ Auth::user()->name }}</a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Cài đặt tài khoản</a></li>
                                @if (Auth::user()->is_admin == 1)
                                <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">Trang quản trị</a></li>
                                @endif
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            @else
                <div class="nav navbar-nav navbar-right">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
@push('javascript')
<script>

</script>
@endpush

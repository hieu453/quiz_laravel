<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Menu quản lý</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                    Danh mục
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('category.import') }}">Nhập excel</a>
                        <a class="nav-link" href="{{ route('category.all') }}">Tất cả danh mục</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                    Môn học
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts2" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('quiz.import') }}">Nhập excel</a>
                        <a class="nav-link" href="{{ route('quiz.all') }}">Tất cả môn học</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-question"></i></div>
                    Câu hỏi
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('question.import')  }}">Nhập excel</a>
                        <a class="nav-link" href="{{ route('question.export.select') }}">Xuất PDF</a>
                        <a class="nav-link" href="{{ route('question.all') }}">Tất cả câu hỏi</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file"></i></i></div>
                    Tài liệu
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts4" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        {{-- Tài liệu cũng k có nhập excel --}}
                        {{-- <a class="nav-link" href="{{ route('quiz.import') }}">Nhập excel</a> --}}
                        <a class="nav-link" href="{{ route('document.all') }}">Tất cả tài liệu</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts5" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></i></div>
                    Người dùng
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts5" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        {{-- Người dùng không có nhập excel --}}
                        {{-- <a class="nav-link" href="{{ route('question.import')  }}">Nhập excel</a> --}}
                        <a class="nav-link" href="{{ route('user.all') }}">Tất cả người dùng</a>
                    </nav>
                </div>
                <a class="nav-link" href="{{ route('option.create') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Thêm lựa chọn
                </a>
                {{-- <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('option.create')  }}">Add</a>
                    </nav>
                </div> --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">{{ Auth::user()->name }}</div>
        </div>
    </nav>
</div>

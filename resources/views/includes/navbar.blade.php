<nav class="navbar navbar-main bg-white navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl mt-1" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark"
                        href="javascript:;"><strong>@yield('title')</strong></a></li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">

            <ul class="navbar-nav me-auto ms-0 justify-content-end">

                <li class="nav-item d-flex align-items-center mx-1">
                    <a href="{{ route('logout') }}" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">تسجيل الخروج</span>
                    </a>
                </li>

                <li class="nav-item d-flex align-items-center mx-3">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">اسم المستخدم :<a
                            class="nav-link text-danger font-weight-bold px-0 mx-1 text-capitalize"
                                href="{{ route('users.profile') }}">{{ auth()->user()->name ?? '' }}</a> </span>
                    </a>
                </li>

                <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

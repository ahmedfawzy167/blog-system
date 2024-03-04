<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="sidenavAccordion">
     <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route('home')}}">{{__('admin.Hello')}} {{auth()->guard('admin')->user()->name}}</a>
    <!-- Sidebar Toggle-->
    <a class="sb-sidenav-toggler" id="sidebarToggle">
        <i class="fas fa-bars" id="sidebarToggle"></i>
    </a>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="get" action="{{route('search')}}">
        @csrf
        <div class="input-group">
            <input class="form-control" type="text" name="term" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Language Dropdown -->
    <div class="dropdown d-inline-block">
        <button class="btn btn-dark dropdown-toggle btn-sm" type="button" id="languageDropdown" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{__('admin.Language')}}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
            <li>
                <a class="dropdown-item" href="{{ route('change.language',['locale' => 'en']) }}">English - EN</a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('change.language', ['locale' => 'ar']) }}"> العربية - AR</a>
            </li>
        </ul>
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->guard('admin')->user()->name}}</a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{route('settings.index')}}"><i class="fa-solid fa-gear"></i> {{__('admin.Settings')}}</a></li>
                <li><a class="dropdown-item" href="{{route('profile.show')}}"><i class="fas fa-user fa-fw"></i>  {{__('admin.Profile')}}</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i>  {{__('admin.Logout')}}</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>
</nav>


<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="{{url('/admin/dashboard')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        {{__('admin.Dashboard')}}
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        {{__('admin.Posts')}}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('posts.index')}}"><i class="fa-solid fa-list me-2"></i> {{__('admin.All Posts')}}</a>
                            <a class="nav-link" href="{{route('posts.create')}}"><i class="ion-plus-circled me-2"></i> {{__('admin.Add New Post')}}</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                          {{__('admin.Users')}}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="{{route('users.index')}}">
                                <i class="fa-solid fa-list me-2"></i> {{__('admin.View All Users')}}
                            </a>

                            <a class="nav-link collapsed" href="{{route('users.create')}}">
                                <i class="ion-plus-circled me-2"></i> {{__('admin.Add New User')}}
                            </a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                          {{__('admin.Categories')}}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCategories" aria-labelledby="headingCategories" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionCategories">
                            <a class="nav-link collapsed" href="{{route('categories.index')}}">
                                <i class="fa-solid fa-list me-2"></i>  {{__('admin.View All Categories')}}
                            </a>
                            <a class="nav-link collapsed" href="{{route('categories.create')}}">
                                <i class="ion-plus-circled me-2"></i> {{__('admin.Add New Category')}}
                            </a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseitems" aria-expanded="false" aria-controls="collapseCategories">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-trash"></i></div>
                          {{__('admin.Trashed Items')}}
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseitems" aria-labelledby="headingitmes" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionitems">
                            <a class="nav-link collapsed" href="{{route('posts.trash')}}">
                                 {{__('admin.Trashed Posts')}}
                            </a>
                            <a class="nav-link collapsed" href="{{route('categories.trash')}}">
                                 {{__('admin.Trashed Categories')}}
                            </a>
                        </nav>
                    </div>

            </div>
        </nav>
       </div>


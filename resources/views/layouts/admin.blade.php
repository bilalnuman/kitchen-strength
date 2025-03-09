<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bundles/datatables/datatables.min.css')}}">
    <link rel="stylesheet"
        href="{{asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <title>Admin Panel</title>

    <style>
        body {
            background-color: #f4f6f9;
        }

        .navbar {
            background-color: #343a40;
        }
        .active-link{
            color: #454546;
            font-weight: 600;
            background-color: #e7ffc8;
        }
    </style>
</head>

<body>

    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a></li>
                        <li>
                            <form class="form-inline mr-auto">
                                <div class="search-element">
                                    <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                        data-width="200">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">

                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                                src="assets/img/user.png" class="user-img-radious-style"> <span
                                class="d-sm-none d-lg-inline-block"></span></a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">Hello Sarah Smith</div>
                            <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
                            </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                                Activities
                            </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i
                                    class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html"> <img alt="image" src="assets/img/fav1.png" class="header-logo" />
                        </a>
                    </div>
                    <ul class="sidebar-menu mb-5">
                        <li class="menu-header">Main</li>
                        <li class="dropdown {{ request()->is('dashboard') ? 'active-link' : '' }}">
                            <a href="/dashboard" class="nav-link"><i
                                    data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        <li
                            class="dropdown {{ Route::currentRouteName() == 'users.index' || Route::currentRouteName() == 'users.store' ? 'active-link' : '' }}">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i data-feather="users"></i><span>Users</span>
                            </a>
                        </li>



                        <li class="dropdown">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="copy"></i><span>Categories</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('courses.create') }}">Add Courses</a></li>
                                <li><a class="nav-link" href="{{ route('diets.create') }}">Add Diet</a></li>
                                <li><a class="nav-link" href="{{ route('dishes.create') }}">Add Dish</a></li>
                                <li><a class="nav-link" href="{{ route('methods.create') }}">Add Method</a></li>

                            </ul>
                        </li>


                        <li>
                            <a href="{{ route('recipes.index') }}" class="nav-link {{ request()->is('dashboard/recipes') ? 'active-link' : '' }}">Recipes</a>
                        </li>


                        <li>
    <a href="{{ route('prices.index') }}" class="nav-link {{ request()->is('dashboard/prices') ? 'active-link' : '' }}">Plan Price</a>
</li>




                    </ul>
                </aside>
            </div>
            <!-- Main Content -->

            <div>
                @yield('content')
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    <a href="#">Strength Kitchen</a></a>
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraries -->
    <script src="{{ asset('assets/bundles/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/widget-data.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/page/index.js') }}"></script>

    <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/datatables.js') }}"></script>

</body>

</html>
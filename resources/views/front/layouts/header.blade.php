<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/img/favicon.ico')}}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/swiper-bundle.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/aos.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    @yield('css')

</head>

<body>
<!-- Preloader start -->
<div id="preloader">
    <div class="loader--border"></div>
</div>
<!-- Preloader end -->

<!-- Start header area -->
<header class="header__section">
    <div class="header__sticky">
        <div class="container-fluid">
            <div class="main__header d-flex justify-content-between align-items-center">
                <div class="offcanvas__header--menu__open ">
                    <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/></svg>
                        <span class="visually-hidden">Offcanvas Menu Open</span>
                    </a>
                </div>
                <div class="main__logo">
                    <a class="main__logo--link" href="index.html">
                        <img class="main__logo--img" src="{{ asset('front/assets/img/logo/nav-log.png') }}" alt="logo-img">
                    </a>
                </div>
                <div class="main__menu d-none d-lg-block">
                    <nav class="main__menu--navigation">
                        <ul class="main__menu--wrapper d-flex">
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="./index.html"><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#FA4A4A"/>
                                    </svg>
                                    Home
                                    <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 12 7.41">
                                        <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                    </svg>
                                </a>
                                <ul class="sub__menu">
                                    <li class="sub__menu--items"><a href="./index.html" class="sub__menu--link">Home - One</a></li>
                                    <li class="sub__menu--items"><a href="./index-2.html" class="sub__menu--link">Home - Two</a></li>
                                    <li class="sub__menu--items"><a href="./index-3.html" class="sub__menu--link">Home - Three</a></li>
                                    <li class="sub__menu--items"><a href="./index-4.html" class="sub__menu--link">Home - Four</a></li>
                                    <li class="sub__menu--items"><a href="./index-5.html" class="sub__menu--link">Home - Five</a></li>
                                </ul>
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="./listing.html"> Listing </a>
                                <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 12 7.41">
                                    <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg>
                                <ul class="sub__menu">
                                    <li class="sub__menu--items"><a href="./listing.html" class="sub__menu--link">Listing Left Sidebar</a></li>
                                    <li class="sub__menu--items"><a href="./listing-right-sidebar.html" class="sub__menu--link">Listing Right Sidebar</a></li>
                                    <li class="sub__menu--items"><a href="./listing.html" class="sub__menu--link">Listing Grig</a></li>
                                    <li class="sub__menu--items"><a href="./listing-list.html" class="sub__menu--link">Listing List</a></li>
                                    <li class="sub__menu--items"><a href="./listing-details.html" class="sub__menu--link">Listing Details</a></li>
                                </ul>
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="./admin/my-properties.html"> Properties </a>
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="./admin/dashboard.html"> Dashboard </a>
                                <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 12 7.41">
                                    <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg>
                                <ul class="sub__menu">
                                    <li class="sub__menu--items"><a href="./admin/dashboard.html" class="sub__menu--link">Dashboard</a></li>
                                    <li class="sub__menu--items"><a href="./admin/create-listing.html" class="sub__menu--link">Creat Listing</a></li>
                                    <li class="sub__menu--items"><a href="./admin/chat.html" class="sub__menu--link">Chats</a></li>
                                    <li class="sub__menu--items"><a href="./admin/my-favorites.html" class="sub__menu--link">My Favorites</a></li>
                                    <li class="sub__menu--items"><a href="./admin/my-properties.html" class="sub__menu--link">My Properties</a></li>
                                    <li class="sub__menu--items"><a href="./admin/my-package.html" class="sub__menu--link">My Package</a></li>
                                    <li class="sub__menu--items"><a href="./admin/profile.html" class="sub__menu--link">My Profile</a></li>
                                    <li class="sub__menu--items"><a href="./admin/reviews.html" class="sub__menu--link">Reviews</a></li>
                                    <li class="sub__menu--items"><a href="./admin/saved-search.html" class="sub__menu--link">Saved Search</a></li>
                                    <li class="sub__menu--items"><a href="./admin/settings.html" class="sub__menu--link">Setting</a></li>
                                </ul>
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="./blog.html">News
                                </a>
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="#"> Pages </a>
                                <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="10" height="7" viewBox="0 0 12 7.41">
                                    <path  d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
                                </svg>
                                <ul class="sub__menu">
                                    <li class="sub__menu--items"><a href="./about.html" class="sub__menu--link">About Us</a></li>
                                    <li class="sub__menu--items"><a href="./contact.html" class="sub__menu--link">Contact Us</a></li>
                                    <li class="sub__menu--items"><a href="./project.html" class="sub__menu--link">Project</a></li>
                                    <li class="sub__menu--items"><a href="./project-details.html" class="sub__menu--link">Project Details</a></li>
                                    <li class="sub__menu--items"><a href="./services-details.html" class="sub__menu--link">Services Details</a></li>
                                    <li class="sub__menu--items"><a href="./login.html" class="sub__menu--link">Login</a></li>
                                    <li class="sub__menu--items"><a href="./sign-up.html" class="sub__menu--link">Sing Up</a></li>
                                    <li class="sub__menu--items"><a href="./404.html" class="sub__menu--link">Error 404</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="main__header--right d-flex align-items-center">
                    <a class="login__register--link" href="./login.html">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <span>Login / Register</span></a>
                    <a class="add__listing--btn solid__btn" href="./admin/create-listing.html"><span>Add Listing</span> <svg width="18" height="18" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 15.9992C12.4111 15.9992 16 12.4105 16 7.99962C16 3.58875 12.411 0 8 0C3.58901 0 0 3.58875 0 7.99962C0 12.4105 3.58901 15.9992 8 15.9992ZM4.19508 7.57155H7.57197V4.19439C7.57197 3.95805 7.76381 3.76636 8 3.76636C8.23634 3.76636 8.42804 3.95821 8.42804 4.19439V7.57155H11.8049C12.0413 7.57155 12.233 7.7634 12.233 7.99958C12.233 8.23592 12.0411 8.42762 11.8049 8.42762H8.42804V11.8046C8.42804 12.041 8.23619 12.2327 8 12.2327C7.76366 12.2327 7.57197 12.0408 7.57197 11.8046V8.42762H4.19508C3.95874 8.42762 3.76704 8.23577 3.76704 7.99958C3.76704 7.76324 3.9586 7.57155 4.19508 7.57155Z" fill="white"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End header area -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="Morden Bootstrap HTML5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('back/assets/img/favicon.ico') }}">

    <!-- ======= All CSS Plugins here ======== -->
    <link rel="stylesheet" href="{{ asset('back/assets/css/plugins/swiper-bundle.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Nunito:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('back/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/assets/css/plugins/glightbox.min.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('back/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('back/assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('back/assets/css/dark.css') }}">
    <link rel="stylesheet" href="{{ asset('back/assets/css/rtl.css') }}">

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem("theme-color") === "dark" || (!("theme-color" in localStorage) && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
            document.documentElement.classList.add("dark");
        }
        if (localStorage.getItem("theme-color") === "light") {
            document.documentElement.classList.remove("dark");
        }
    </script>

    <style>
        .dashboard__chart--box__inner {
            height: 317px;
            padding-left: 0px;
        }

        .sold-out__progress-bar__field {
            max-width: 200px;
            width: 100%;
        }
    </style>

    @stack('css')

</head>

<body>
<!-- Preloader start -->
<div id="preloader">
    <div class="loader--border"></div>
</div>
<div class="dashboard__page--wrapper">
    @include('back.layouts.offcanvas')


    @include('back.layouts.sidebar')

    <div class="page__body--wrapper" id="dashbody__page--body__wrapper">
        @include('back.layouts.navbar')
        <main class="main__content_wrapper">

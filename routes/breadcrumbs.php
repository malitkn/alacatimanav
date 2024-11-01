<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Ana Sayfa', 'Test');
});

// Home > Login
Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Giriş Yap', route('login'));
});

// Home > Login > Forgot Password
Breadcrumbs::for('forgot-password', function (BreadcrumbTrail $trail) {
    $trail->parent('login');
    $trail->push('Şifremi Unuttum', route('password.request'));
});

// Home > Login > Set New Password
Breadcrumbs::for('reset-password', function (BreadcrumbTrail $trail) {
    $trail->parent('login');
    $trail->push('Parola Oluştur');
});

//                              Admin Routes
// -------------------------------------------------------------------------

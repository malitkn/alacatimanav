@extends('back.layouts.master')
@section('title', 'Kontrol Paneli')
@section('content')
    <!-- dashboard container -->
    <div class="dashboard__container d-flex">
        <div class="main__content--left">
            <div class="main__content--left__inner">
                <!-- Welcome section -->
                <div class="welcome__section d-flex align-items-center">
                    <div class="welcome__content">
                        <h2 class="welcome__content--title">Hoşgeldiniz! {{ auth()->user()->name }}</h2>
                        <p class="welcome__content--desc">Bu panel üzerinden sitenizi yönetebilirsiniz.</p>
                    </div>
                    <div class="welcome__thumbnail">
                        <img src="{{ asset('back/assets/img/dashboard/welcome-thumbnail.png')}}" alt="img">
                    </div>
                </div>
                <!-- Welcome section .\ -->


            </div>
        </div>
        <div class="main__content--right">
            <div class="recent__activity--box">
                <div class="recent__activity--header d-flex align-items-center justify-content-between mb-25">
                    <h2 class="recent__activity--title">Son Etkinlikler</h2>
                </div>
                <ul class="recent__activity--message">
                    @foreach($sessions as $session)
                    <li class="recent__activity--message__list {{ $colours[$loop->index] }} d-flex justify-content-between">
                        <div class="recent__activity--message__content">
                            <p class="recent__activity--message__desc"> Kullanıcı: <span> {{ $session->user->name }} </span></p>
                            <p class="recent__activity--message__desc2"> {{ Breadcrumbs::pageTitle($session->payload['route']) }}  sayfasını ziyaret etti.</p>
                        </div>
                        <span class="recent__activity--message__time">{{ $session->last_activity }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!-- dashboard container .\ -->
@endsection

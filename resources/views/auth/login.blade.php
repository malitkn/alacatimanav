@extends('front.layouts.master')
@section('title', 'Giriş Yap')
@section('content')

    {{ Breadcrumbs::render('login') }}
    <!-- Account Page section -->
    <section class="account__page--section section--padding">
        <div class="container">
            <div class="account__section--inner">
                <x-auth.session-status :status="session('status')"/>

                <div class="account__tab--btn">
                    <ul class="account__tab--btn__wrapper d-flex justify-content-center">
                        <li class="account__tab--btn__items"><span
                                class="account__tab--btn__field active">{{ __('Log in') }}</span></li>
                    </ul>
                </div>

                <div class="account__form--wrapper">
                    <div class="account__form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="account__form--input mb-30">
                                <x-auth.form.input-label class="account__form--input__label mb-12" for="email"
                                                         value="{{__('Email')}}"/>
                                <x-auth.form.text-input type="email" id="email" value="{{ old('email') }}" name="email"
                                                        required/>
                                <x-auth.form.input-error :messages="$errors->get('email')" class="mt-2"/>
                            </div>
                            <div class="account__form--input mb-30">
                                <div
                                    class="account__form--input__top mb-12 d-flex align-items-center justify-content-between">
                                    <x-auth.form.input-label class="account__form--input__label mb-12" for="password"
                                                             value="{{__('Password')}}" required/>
                                    @if (Route::has('password.request'))
                                        <a class="account__form--forgot__password"
                                           href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                    @endif
                                </div>
                                <x-auth.form.text-input id="password" type="password" name="password"/>
                                <x-auth.form.input-error :messages="$errors->get('password')"/>
                            </div>

                            <p class="account__form--condition position-relative m-0">
                                <x-auth.form.input-label class="account__form--condition__label" for="remember-me"
                                                         value="{{ __('Remember me') }}"/>
                                <input class="account__form--condition__input" id="remember-me" name="remember"
                                       type="checkbox">
                                <span class="account__form--condition__checkmark"></span>
                            </p>
                            <button class="account__form--btn solid__btn">{{ __('Log in') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Page section .\ -->
@endsection

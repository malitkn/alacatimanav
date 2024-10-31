@extends('front.layouts.master')
@section('title',__('Reset Your Password'))
@section('content')
    {{ Breadcrumbs::render('forgot-password') }}
    <!-- Account Page section -->

    <section class="account__page--section section--padding">
        <div class="container">
            <div class="account__section--inner">
                <!-- Session Status -->
               <x-auth.session-status :status="session('status')"/>
                <div class="account__form--wrapper">
                     <div class="account__header text-center mb-30">
                         <h2 class="account__title">{{ __('Reset Your Password') }}</h2>
                         <p class="account__desc">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                     </div>
                    <div class="account__form">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="account__form--input mb-30">
                                <x-auth.form.input-label class="account__form--input__label mb-12" for="email" value="{{ __('Email') }}"/>
                                <x-auth.form.text-input type="email" id="email" name="email"/>
                                <x-auth.form.input-error :messages="$errors->get('email')" />
                            </div>
                            <button  class="account__form--btn solid__btn">{{ __('Email Password Reset Link') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Page section .\ -->
@endsection

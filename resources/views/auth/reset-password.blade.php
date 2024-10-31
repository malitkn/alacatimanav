@extends('front.layouts.master')
@section('title',__('Set Your New Password'))
@section('content')

    {{ Breadcrumbs::render('reset-password') }}
    <!-- Account Page section -->
    <section class="account__page--section section--padding">
        <div class="container">
            <div class="account__section--inner">
                <div class="account__form--wrapper">
                    <div class="account__header text-center mb-30">
                        <h2 class="account__title">{{ __('Set Your New Password') }}</h2>
                    </div>
                    <div class="account__form">
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="account__form--input mb-30">
                                <x-auth.form.input-label class="account__form--input__label mb-12" for="email" value="{{ __('Email') }}" />
                                <x-auth.form.text-input type="email" id="email" name="email" :value="old('email', $request->email)" />
                                <x-auth.form.input-error :messages="$errors->get('email')"/>
                            </div>

                            <div class="account__form--input mb-30">
                                <div class="account__form--input__top mb-12 d-flex align-items-center justify-content-between">
                                    <x-auth.form.input-label class="account__form--input__label mb-12" for="password"  value="{{__('Password')}}" required />
                                </div>
                                <x-auth.form.text-input id="password" type="password" name="password"/>
                                <x-auth.form.input-error :messages="$errors->get('password')" />
                            </div>

                            <div class="account__form--input mb-30">
                                <div class="account__form--input__top mb-12 d-flex align-items-center justify-content-between">
                                    <x-auth.form.input-label class="account__form--input__label mb-12" for="password" value="{{__('Confirm Password')}}" required />
                                </div>
                                <x-auth.form.text-input id="password" type="password" name="password_confirmation" />
                                <x-auth.form.input-error :messages="$errors->get('password_confirmation')" />
                            </div>

                            <button class="account__form--btn solid__btn">{{ __('Reset Password') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Account Page section .\ -->
@endsection

@extends('back.layouts.master')
@section('title', __('routes.settings.index'))
@pushOnce('css')
    <link rel="stylesheet" href="{{ asset('back/assets/css/creat-listing.css')}}">
@endpushOnce
@section('content')
    <!-- dashboard container -->
    <div class="dashboard__container setting__container">
        <div class="add__property--heading mb-30">
            <h2 class="add__property--heading__title">Genel Ayarlar</h2>
            <p class="add__property--desc">Bu sayfadan sitenizin genel ayarlarını düzenleyebilirsiniz.</p>
        </div>
        <x-alerts.session-status :status="session('status.isSuccess')" :message="session('status.message')"/>
        <div class="setting__page--inner d-flex">
            <div class="setting__profile my-profile">
                <div class="setting__my--profile">
                    <h3 class="setting__profile--title">Logo</h3>
                    {{--                    <div class="setting__profile--author d-flex align-items-center"></div>--}}
                    <form enctype="multipart/form-data" action="{{ route('media.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @foreach($media as $row)
                            <div class="edit__profile--step">
                                <h3 class="setting__profile--title"> {{ $row->section }} Logo</h3>
                                <div class="setting__profile--inner">
                                    <div class="property__media--wrapper d-flex justify-content-end">
                                        <div class="col-lg-8">
                                            <li class="chat__profile--photos__items">
                                                <a id="a-{{$row->section}}"
                                                   class="chat__profile--photos__link glightbox"
                                                   href="{{ asset('storage/' . $row->path) }}" data-gallery="gallery">
                                                    <img id="img-{{ $row->section }}"
                                                         class="chat__profile--photos__media"
                                                         src="{{ asset('storage/' . $row->path) }}" width="200" height="40"
                                                         alt="img">
                                                </a>
                                            </li>
                                        </div>
                                        <div class="browse__file--area position-relative col-lg-4">
                                            <button class="browse__file--btn">Dosya Seçin</button>
                                            <input id="{{ $row->section }}" class="browse__file--input__field"
                                                   name="section[{{ $row->section }}]" type="file"
                                                   onchange="previewImage('{{ $row->section }}', this.files[0])">
                                            <x-form.input-error :messages="$errors->get('section.' . $row->section)"
                                                                class="mt-2"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="setting__profile--inner">
                            <button type="submit" class="solid__btn add__property--btn">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="setting__profile edit-profile">
                <form method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="edit__profile--step">
                        <h3 class="setting__profile--title">Genel</h3>
                        <div class="setting__profile--inner">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="title">Site Başlığı</label>
                                        <input class="add__listing--input__field" id="title" name="title"
                                               value="{{ $setting->title }}" placeholder="Başlık girin.." type="text">
                                        <x-form.input-error :messages="$errors->get('title')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="add__listing--input__box">
                                        <label class="add__listing--input__label" for="url">Site URL</label>
                                        <input class="add__listing--input__field" id="url" name="url"
                                               value="{{ $setting->url }}"
                                               placeholder="Site URL adresini girin.. örn: https://example.com"
                                               type="url">
                                        <x-form.input-error :messages="$errors->get('url')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="meta_description">Site Meta
                                            Açıklaması</label>
                                        <input class="add__listing--input__field" id="meta_description"
                                               value="{{ $setting->meta_description }}"
                                               name="meta_description" placeholder="Meta açıklaması girin..."
                                               type="text">
                                        <x-form.input-error :messages="$errors->get('meta_description')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edit__profile--step">
                        <h3 class="setting__profile--title">Firma Bilgileri</h3>
                        <div class="setting__profile--inner">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="name">Firma Adı</label>
                                        <input class="add__listing--input__field" id="name" name="name"
                                               value="{{ $setting->name }}"
                                               type="text">
                                        <x-form.input-error :messages="$errors->get('name')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="phone">Telefon Numarası</label>
                                        <input class="add__listing--input__field" id="phone" name="phone" type="text"
                                               value="{{ $setting->phone }}"
                                               maxlength="10">
                                        <x-form.input-error :messages="$errors->get('phone')" class="mt-2"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="email">Firma Email Adresi</label>
                                        <input class="add__listing--input__field" id="email" name="email" type="email"
                                               value="{{ $setting->email }}">
                                        <x-form.input-error :messages="$errors->get('email')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="analytics">Google Analytics
                                            Kodu</label>
                                        <input class="add__listing--input__field" id="analytics"
                                               value="{{ $setting->analytics }}"
                                               placeholder="G-##########"
                                               name="analytics" type="text">
                                        <x-form.input-error :messages="$errors->get('analytics')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="add__listing--textarea__box mb-15">
                                        <label class="add__listing--input__label" for="address">Firma Adresi</label>
                                        <textarea class="add__listing--textarea__field" id="address" name="address"
                                                  placeholder="Firma adresini girin..">{{ $setting->address }}</textarea>
                                        <x-form.input-error :messages="$errors->get('address')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="maps">Google Maps iFrame
                                            kodu</label>
                                        <input class="add__listing--input__field" value="{{ $setting->maps }}" id="maps"
                                               name="maps" type="text">
                                        <x-form.input-error :messages="$errors->get('maps')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="facebook">Facebook Adresi</label>
                                        <input class="add__listing--input__field" id="facebook" name="facebook"
                                               value="{{ $setting->facebook }}"
                                               type="text">
                                        <x-form.input-error :messages="$errors->get('facebook')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="instagram">İnstagram
                                            Adresi</label>
                                        <input class="add__listing--input__field" id="instagram" name="instagram"
                                               value="{{ $setting->instagram }}"
                                               type="text">
                                        <x-form.input-error :messages="$errors->get('instagram')" class="mt-2"/>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="twitter">Twitter (X)
                                            Adresi</label>
                                        <input class="add__listing--input__field" id="twitter" name="twitter"
                                               value="{{ $setting->twitter }}"
                                               type="text">
                                        <x-form.input-error :messages="$errors->get('twitter')" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                            <div class="edit__profile--button d-flex justify-content-end">
                                <button type="submit" class="edit__profile--update__btn solid__btn">Kaydet</button>
                            </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- dashboard container .\ -->
@endsection
@pushOnce('js')
    <script>
        function previewImage(section, image) {
            const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp', 'image/svg'];  // Allowed mime types
            if (image && allowedExtensions.includes(image.type)) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('img-' + section).src = e.target.result; // update img element
                    document.getElementById('a-' + section).href = e.target.result; // update a element
                }

                reader.readAsDataURL(image); // Dosyayı oku
            }
        }
    </script>
@endpushonce


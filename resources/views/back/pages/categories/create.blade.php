@extends('back.layouts.master')
@section('title', 'Sayfa Kategorisi Oluştur')
@pushonce('css')
    <link rel="stylesheet" href="{{ asset('back/assets/css/creat-listing.css')}}">
@endpushonce
@section('content')
    <!-- dashboard container -->
    <div class="dashboard__container add__property--container">
        <x-alerts.session-status :status="session('status.isSuccess')" :message="session('status.message')"/>
        <div class="add__property__inner d-flex row">
            <div class="add__property--step left">
                <div class="add__property--step__inner">
                    <div class="add__property--box mb-30">
                        <h3 class="add__property--box__title mb-20">Sayfa Kategorisi Oluştur</h3>
                        <form class="add__property--form" action="{{ route('pages.categories.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-12">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="title">Sayfa Başlığı</label>
                                        <input class="add__listing--input__field" id="title" required name="title"
                                               onchange="generateSlug(this.id, 'slug')" type="text">
                                        <x-form.input-error :messages="$errors->get('title')"/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="add__listing--input__box mb-15">
                                        <label class="add__listing--input__label" for="meta_description">Meta
                                            Açıklaması </label>
                                        <input class="add__listing--input__field" id="meta_description"
                                               required name="meta_description" maxlength="150" type="text"/>
                                        <x-form.input-error :messages="$errors->get('meta_description')"/>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="add__listing--input__box mb-15">
                                        <label class="add__listing--input__label" for="slug">Sayfa Slug </label>
                                        <input class="add__listing--input__field" id="slug" name="slug" required
                                               type="text"/>
                                        <x-form.input-error :messages="$errors->get('slug')"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="parent">Üst Menü</label>
                                        <div class="select position-relative">
                                            <select required id="parent" name="parent"
                                                    class="add__listing--form__select">
                                                <option selected value="0">Ebeveyn Kategori</option>
                                                @foreach($pageCategories as $pageCategory)
                                                    <option
                                                        value="{{ $pageCategory->id }}"> {{ $pageCategory->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <x-form.input-error :messages="$errors->get('parent')"/>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="add__listing--input__box mb-20">
                                        <label class="add__listing--input__label" for="list_type">Listelenme türü</label>
                                        <div class="select position-relative">
                                            <select id="list_type" name="list_type" class="add__listing--form__select">
                                                <option selected="" value="grid">Grid</option>
                                                <option value="list">List</option>
                                            </select>
                                            <x-form.input-error :messages="$errors->get('list_type')"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="solid__btn add__property--btn">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dashboard container .\ -->
@endsection
@pushonce('js')
    <script src="{{ asset('back/assets/js/utils.js') }}"></script>
@endpushonce

@extends('back.layouts.master')
@section('title', __('routes.pages.categories.index'))
@pushOnce('css')
    <link rel="stylesheet" href="{{ asset('back/assets/css/creat-listing.css')}}">
    <link rel="stylesheet" href="{{ asset('back/assets/css/table.css') }} ">
    <link rel="stylesheet" href="{{ asset('back/assets/css/chat.css') }} ">
@endpushOnce
@section('content')
    <div class="dashboard__container dashboard__reviews--container">
        <div class="reviews__heading mb-30">
            <h2 class="reviews__heading--title">Sayfa kategorileri</h2>
            <p class="reviews__heading--desc">Sayfa kategorilerinizi buradan yönetebilirsiniz.</p>
        </div>
        <x-alerts.session-status :status="session('status.isSuccess')" :message="session('status.message')"/>
        <div class="properties__wrapper">
            <div class="properties__table table-responsive">
                <table class="properties__table--wrapper">
                    <thead>
                    <tr>
                        <th>Başlık</th>
                        <th><span class="min-w-100">Status</span></th>
                        <th>Oluşturulma Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pageCategories as $pageCategory)
                        <tr>
                            <td>
                                <div class="properties__author d-flex align-items-center">
                                    <div class="reviews__author--text">
                                        <h3 class="reviews__author--title">{{ $pageCategory->title }}</h3>
                                        <p class="reviews__author--subtitle">{{ Str::limit($pageCategory->meta_description, 25) }}</p>
                                        <span class="properties__author--price">Slug:{{ $pageCategory->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="status__btn @if($pageCategory->status) active @else pending @endif"> @if($pageCategory->status)
                                        @lang("Active")
                                    @else
                                        @lang("Passive")
                                    @endif</span>
                            </td>
                            <td>
                                <span class="reviews__date">{{ $pageCategory->created_at }}</span>
                            </td>
                            <td>
                                <div class="reviews__action--wrapper position-relative">
                                    <button class="reviews__action--btn" aria-label="action button" type="button"
                                            aria-expanded="true" data-bs-toggle="dropdown">
                                        <svg width="3" height="17" viewBox="0 0 3 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="1.5" cy="1.5" r="1.5" fill="currentColor"/>
                                            <circle cx="1.5" cy="8.5" r="1.5" fill="currentColor"/>
                                            <circle cx="1.5" cy="15.5" r="1.5" fill="currentColor"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu sold-out__user--dropdown "
                                        data-popper-placement="bottom-start">
                                        <li><a data-bs-toggle="modal" href="#editModal"
                                               onclick="loadEditModal({{ $pageCategory }}, formData, 'modal-body')">Düzenle</a></li>
                                        <li><a data-bs-toggle="modal"
                                               onclick="loadModalAction({{ $pageCategory->id }}, 'deleteForm')"
                                               href="#deleteModal">Sil</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pageCategories->links() }}
        </div>
    </div>
@endsection
@pushOnce('end')
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal__contact--main__content">
                <div class="modal__contact--header d-flex align-items-center justify-content-between">
                    <h3 id="modalHeader" class="modal__contact--header__title"> sayfası düzenleniyor</h3>
                    <button type="button" class="modal__contact--close__btn" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12.711" height="12.711"
                             viewBox="0 0 12.711 12.711">
                            <g id="Group_7205" data-name="Group 7205" transform="translate(-113.644 -321.644)">
                                <path id="Vector" d="M0,9.883,9.883,0" transform="translate(115.059 323.059)"
                                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"></path>
                                <path id="Vector-2" data-name="Vector" d="M9.883,9.883,0,0"
                                      transform="translate(115.059 323.059)" fill="none" stroke="currentColor"
                                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                            </g>
                        </svg>
                    </button>
                </div>
                <div id="modal-body" class="modal-body modal__contact--body">
                    <div class="modal__contact--form">
                        <form name="editForm" id="editForm"
                              method="POST"
                              action="{{ route('pages.categories.update', ['category' => ':category']) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal__contact--form__input mb-20 ">
                                <label class="modal__contact--input__label" for="title">Sayfa Başlığı</label>
                                <input class="add__listing--input__field " id="title"
                                       onchange="generateSlug(this.id, 'slug')" name="title" type="text">
                            </div>

                            <div class="modal__contact--form__input mb-20 ">
                                <label class="modal__contact--input__label" for="slug">Slug</label>
                                <input class="add__listing--input__field " id="slug" name="slug"
                                       type="text">
                            </div>

                            <div class="modal__contact--form__input mb-20 ">
                                <label class="modal__contact--input__label" for="meta_description">Meta
                                    Açıklaması</label>
                                <input class="add__listing--input__field " id="meta_description"
                                       name="meta_description" type="text">
                            </div>

                            <div class="modal__contact--form__input mb-20">
                                <label class="modal__contact--input__label" for="list_type">Listenme türü</label>
                                <div class="select position-relative">
                                    <select id="list_type" name="list_type" class="add__listing--form__select">
                                        <option value="0">Grid</option>
                                        <option value="1">List</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal__contact--form__input mb-20">
                                <label class="modal__contact--input__label" for="parent">Üst Menü</label>
                                <div class="select position-relative">
                                    <select id="parent" name="parent" class="add__listing--form__select">
                                        <option value="0">Üst Menü</option>
                                        @foreach($allPageCategories as $pageCategory)
                                            <option
                                                value="{{ $pageCategory->id }}"> {{ $pageCategory->title }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="modal__contact--form__input mb-20">
                                <label class="modal__contact--input__label" for="status">Durum:</label>
                                <button type="button" id="statusButton"
                                        onclick="toggleStatusButtonBootstrap(this.id, 'status')"
                                        class="btn btn-success btn-lg">Aktif
                                </button>
                                <input type="hidden" id="status" name="status">
                            </div>

                            <div class="modal__contact--footer">
                                <button class="solid__btn border-0" onclick="sendUpdateRequest('editForm', 'modal-body')"
                                        type="button">Kaydet
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal__contact--main__content">
                <div class="modal-body modal__contact--body">
                    <div class="modal__calling--wrapper">
                        <div class="modal__calling--author">
                            <svg xmlns="http://www.w3.org/2000/svg" class="modal__calling--author__thumb text-warning"
                                 width="96" height="96" viewBox="0 0 512 512">
                                <path
                                    d="M256 80c-8.66 0-16.58 7.36-16 16l8 216a8 8 0 008 8h0a8 8 0 008-8l8-216c.58-8.64-7.34-16-16-16z"
                                    fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="32"/>
                                <circle cx="256" cy="416" r="16" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                            </svg>
                            <h3 class="modal__calling--author__name">Seçili kategoriyi silmek istediğinizden emin
                                misiniz?</h3>
                            <span
                                class="modal__calling--author__subtitle">Seçili kategori kalıcı olarak silinecek.</span>
                        </div>
                        <div class="modal__calls--footer d-flex justify-content-center">
                            <form method="POST" id="deleteForm"
                                  action="{{ route('pages.categories.destroy',['category' => ':category']) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="call__receive border-0 color-accent-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="ionicon"
                                         viewBox="0 0 512 512">
                                        <path
                                            d="M112 112l20 320c.95 18.49 14.4 32 32 32h184c17.67 0 30.87-13.51 32-32l20-320"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="32"/>
                                        <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                                              stroke-width="32" d="M80 112h352"/>
                                        <path
                                            d="M192 112V72h0a23.93 23.93 0 0124-24h80a23.93 23.93 0 0124 24h0v40M256 176v224M184 176l8 224M328 176l-8 224"
                                            fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="32"/>
                                    </svg>
                                </button>
                            </form>
                            <button class="call__cancel border-0 btn-close-white" data-bs-dismiss="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="ionicon"
                                     viewBox="0 0 512 512">
                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                          stroke-linejoin="round" stroke-width="32"
                                          d="M368 368L144 144M368 144L144 368"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endpushOnce

@pushonce('js')
    <script src="{{ asset('back/assets/js/utils.js') }}"></script>
    <script defer src="{{ asset('back/assets/js/modal.js') }}"></script>
    <script>
        const formData = {
            formId: 'editForm',
            formName: 'editForm',
            inputs: {
                0: {
                    id: 'title',
                    attribute: 'value',
                    value: 'title',
                },
                1: {
                    id: 'slug',
                    attribute: 'value',
                    value: 'slug',
                },

                2: {
                    id: 'meta_description',
                    attribute: 'value',
                    value: 'meta_description',
                },

                3: {
                    id: 'list_type',
                    attribute: 'option',
                    value: 'list_type',
                },

                4: {
                    id: 'parent',
                    attribute: 'option',
                    value: 'parent',
                },

                5: {
                    id: 'statusButton',
                    attribute: 'toggle',
                    value: 'status',
                },

                6: {
                    id: 'status',
                    attribute: 'value',
                    value: 'status',
                }
            },
            elements: {
                0: {
                    id: 'modalHeader',
                    attribute: 'textContent',
                    value: 'title',
                    prependValue: true,
                    defaultValue: ' sayfası düzenleniyor',
                }
            }
        }
    </script>
@endpushonce

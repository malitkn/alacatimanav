@extends('back.layouts.master')
@section('title', __('routes.settings.index'))
@pushOnce('css')
    <link rel="stylesheet" href="{{ asset('back/assets/css/creat-listing.css')}}">
    <style>.delete__row--btn {
            display: inline-block;
            font-size: 1.5rem;
            line-height: 4.2rem;
            height: 4.3rem;
            padding: 0 1.5rem;
            letter-spacing: 0.2px;
            border-radius: 0.5rem;
            background: var(--bs-danger);
            color: var(--color-white);
            border: 0;
            font-weight: 700;
        }

        .add__row--btn {
            display: inline-block;
            font-size: 1.5rem;
            line-height: 4.2rem;
            height: 4.3rem;
            padding: 0 1.5rem;
            letter-spacing: 0.2px;
            border-radius: 0.5rem;
            background: var(--bs-secondary);
            color: var(--color-white);
            border: 0;
            font-weight: 700;
        }
		

	.loader-overlay-inside {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(255, 255, 255, 0.6);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10;
}

.loader {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #3498db; /* Mavi renk */
  border-radius: 50%;
  width: 70px;
  height: 70px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0%   { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    </style>
@endpushOnce
@section('content')
    <!-- dashboard container -->
    <div class="dashboard__container setting__container">
        <div class="add__property--heading mb-30">
            <h2 class="add__property--heading__title">Genel Ayarlar</h2>
            <p class="add__property--desc">Bu sayfadan sitenizin genel ayarlarını düzenleyebilirsiniz.</p>
        </div>
        <div class="setting__page--inner d-flex">
            <livewire:products.update/>
        </div>
    </div>
    </div>
    </div>
    <!-- dashboard container .\ -->
@endsection

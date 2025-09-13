@assets
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
@endassets

<div>
@section('title', __('routes.settings.index'))
    <!-- dashboard container -->
    <div class="dashboard__container setting__container">
        <div class="add__property--heading mb-30">
            <h2 class="add__property--heading__title">Genel Ayarlar</h2>
            <p class="add__property--desc">Bu sayfadan sitenizin genel ayarlarını düzenleyebilirsiniz.</p>
        </div>
        <div class="setting__page--inner d-flex">
			<div class="setting__profile edit-profile">
			<form method="POST" action="{{ route('settings.update') }}">
            <div class="edit__profile--step">
                <h3 class="setting__profile--title">Firma Komisyon Oranlarını Düzenleyin</h3>
                <div class="setting__profile--inner">
                    <x-alerts.session-status :status="session('status.isSuccess')" :message="session('status.message')"/>
					<div wire:loading class="loader-overlay" wire:target="update">
  						  <div class="loader"></div>
				</div>
                    <div wire:loading.remove wire:target="update" class="row">
						@foreach($firms as $index => $firm)
                  		<div class="col-lg-3 col-md-3">
                                <div class="add__listing--input__box mb-20">
                                    <label class="add__listing--input__label" for="{{$firm['firm']}}"> Firma Adı </label>
                                    <input class="add__listing--input__field" id="{{$firm['firm']}}" type="text" wire:model="firms.{{$index}}.firm" readonly autocomplete="off">
                                </div>
                            </div>
						
						<div class="col-lg-3 col-md-3">
                                <div class="add__listing--input__box mb-20">
                                    <label class="add__listing--input__label" for="commissionRate{{$firm['firm']}}">Komisyon Oranı</label>
                                    <input class="add__listing--input__field" id="commisionRate{{$firm['firm']}}" type="text" wire:model.live="firms.{{ $index }}.rate" autocomplete="off">
									
									 @error("firms.$index.rate")
                                    <span class=" text-warning text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                      	@endforeach
                        <h3 class="setting__profile--title mb-10"></h3>
                        <div class="edit__profile--button d-flex justify-content-end">
                            <button type="button" wire:click="update" class="edit__profile--update__btn solid__btn">Güncelle</button>
                        </div>
                    </div>
                </div>
            </div>
		</form>
    </div>
        </div>
    </div>
    </div>
    </div>
    <!-- dashboard container .\ -->
</div>

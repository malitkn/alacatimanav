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
                <h3 class="setting__profile--title">Fiyat Güncelle</h3>
                <div class="setting__profile--inner">
                    <x-alerts.session-status :status="session('status.isSuccess')" :message="session('status.message')"/>
					<div wire:loading class="loader-overlay" wire:target="update, loadOldRows">
  						  <div class="loader"></div>
				</div>
                    <div wire:loading.remove wire:target="update, loadOldRows" class="row">
						
                        @foreach($rows as $index => $row)
                            <div class="col-lg-3 col-md-3">
                                <div class="add__listing--input__box mb-20">
                                    <label class="add__listing--input__label" for="midipos{{$index}}">Kod</label>
                                    <input class="add__listing--input__field" id="midipos{{$index}}" wire:model.change="rows.{{$index}}.midipos" type="number" autocomplete="off">
                                    @error("rows.$index.midipos")
                                    <span class=" text-warning text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-md-3">
                                <div class="add__listing--input__box">
                                    <label class="add__listing--input__label" for="productName{{$index}}">Ürün Adı</label>
                                    <input class="add__listing--input__field" id="productName{{$index}}" wire:model="rows.{{$index}}.productName" readonly type="text">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <div class="add__listing--input__box">
                                   <div class="add__listing--input__box mb-20">
                                                    <label class="add__listing--input__label"> Durum</label>
                                                    <div class="select position-relative">
                                                 <select wire:model.live="rows.{{ $index }}.status" class="add__listing--form__select">
                                                            <option selected="" value="0">Kapalı</option>
                                                            <option value="1">Açık</option>    
                                                        </select>
                                                    </div>
                                                </div>
                                    @error("rows.$index.status")
                                    <span class="text-warning text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 d-flex align-items-center">
                                <button type="button" wire:click="removeRow({{$index}})" class="delete__row--btn">Sil</button>
                            </div>
                        @endforeach
                        <div class="edit__profile--button d-flex justify-content-end">
                            <button type="button" wire:click="addRow()" class="add__row--btn">
								Satır Ekle
							</button>
                        </div>
                        <h3 class="setting__profile--title mb-10"></h3>
						
                        <div class="edit__profile--button d-flex justify-content-end">
							<button type="button" @if(empty($oldRows)) disabled @endif wire:click="loadOldRows()" class="add__row--btn">Önceki satırları yükle</button>
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

<div>
    <div class="setting__profile edit-profile">
        <form method="POST" action="{{ route('settings.update') }}">
            <div class="edit__profile--step">
                <h3 class="setting__profile--title">Fiyat Güncelle</h3>
                <div class="setting__profile--inner">
                    <x-alerts.session-status :status="session('status.isSuccess')" :message="session('status.message')"/>
                    <div class="row">
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
                                    <label class="add__listing--input__label" for="newPrice{{$index}}">Yeni Fiyat</label>
                                    <input class="add__listing--input__field" id="newPrice{{$index}}" wire:model="rows.{{$index}}.newPrice" type="number">
                                    @error("rows.$index.newPrice")
                                    <span class="text-warning text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 d-flex align-items-center">
                                <button type="button" wire:click="removeRow({{$index}})" class="delete__row--btn">Sil</button>
                            </div>
                        @endforeach
                        <div class="edit__profile--button d-flex justify-content-end">
                            <button type="button" wire:click="addRow()" class="add__row--btn">Satır Ekle</button>
                        </div>
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

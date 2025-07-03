<?php

namespace App\Livewire\Products;

use App\Http\Yemeksepeti;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    #[Validate]
    public array $rows = [];

    protected function rules()
    {
        return [
            'rows.*.midipos' => 'required|int',
            'rows.*.newPrice' =>'required|decimal:1',
        ];
    }

    protected function messages() {
        return [
            'rows.*.midipos.required' => 'Midipos kodu zorunludur.',
            'rows.*.newPrice.required' => 'Fiyat girilmedi.',
        ];
    }

    public function mount()
    {
        $this->addRow();
    }

    public function addRow()
    {
        $this->rows[] = [
            'midipos' => '',
            'productName' => '',
            'newPrice' => '',
        ];
    }

    public function updatedRows($value, $key)
    {
        $exploded = explode('.', $key);
        $inputName = $exploded[1];
        $index = $exploded[0];

        try {
            if ($inputName == 'midipos') {
                $this->rows[$index]['productName'] = DB::table('products')->where('midipos', $value)->first()->product_name;
            }
        } catch (\Exception $e) {
            session()->now('status', ['isSuccess' => false, 'message' => 'Girdiğiniz koda tanımlı ürün yok!']);
            $this->rows[$index]['midipos'] = '';
        }
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }

    public function render()
    {
        return view('livewire.products.update');
    }

    public function update(\App\Yemeksepeti\Product $yemeksepeti) {
        dd(session('access_token'));

    }
}

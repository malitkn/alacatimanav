<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Update extends Component
{
    #[Validate]
    public array $rows = [];
	public array $oldRows = [];
	public $withoutCommission;

    protected function rules()
    {
        return [
            'rows.*.midipos' => 'required|int|distinct',
            'rows.*.newPrice' =>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    protected function messages() {
        return [
            'rows.*.midipos.required' => 'Midipos kodu zorunludur.',
            'rows.*.newPrice.required' => 'Fiyat girilmedi.',
			'rows.*.midipos.distinct' => 'Aynı midipos kodu tekrar girilemez',
        ];
    }

    public function mount()
    {
        $this->addRow(4);
    }

    public function addRow($count = 1)
    {
		for ($i = 1; $i <= $count; $i++) {
        $this->rows[] = [
            'midipos' => '',
            'productName' => '',
            'newPrice' => '',
        ];
		}
    }

	public function loadOldRows()
	{
		$this->rows = $this->oldRows;
	}

    public function updatedRows($value, $key)
    {
        $exploded = explode('.', $key);
        $inputName = $exploded[1];
        $index = $exploded[0];

        try {
            if ($inputName == 'midipos') {
                $this->rows[$index]['productName'] = DB::table('products')
					->where('midipos', $value)
					->first()
					->product_name;
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

	public function resetRows() {
		$this->rows = [];
		$this->addRow(4);
	}

    public function update(\App\Yemeksepeti\Product $yemeksepeti, \App\Getir\Product $getir) {
		$this->validate();
		// dd($yemeksepeti->login());
        $ys = $yemeksepeti->update($this->rows, $this->withoutCommission);
		sleep(2);
		$gtr = $getir->update($this->rows, $this->withoutCommission);

		 if($ys) {
			 $statuses[] =  ['isSuccess' => true, 'message' => 'Yemeksepeti Başarıyla Güncellendi.'];
		 } else {
		 	$statuses[] =  ['isSuccess' => false, 'message' => "Yemeksepeti güncellenemedi."];
		 }

		if($gtr["status"]) {
			 $statuses[] =  [
				 'isSuccess' => true,
				 'message' => 'Getir Başarıyla Güncellendi.',
				 'data' => $gtr['data']
			 ];
		 } else {
			$statuses[] =  [
				'isSuccess' => false,
				'message' => $gtr['message'],
				'data' => $gtr['data']
			];
		}
		session()->now('statuses', $statuses);
		$this->oldRows = $this->rows;
		$this->resetRows();
    }
}

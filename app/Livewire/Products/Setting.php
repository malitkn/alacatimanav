<?php

namespace App\Livewire\Products;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\CommissionRate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Setting extends Component
{
	#[Validate]
    public $firms = [];
	public $shouldUpdate;
	
	protected function rules()
    {
        return [
            'firms.*.rate' =>'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    protected function messages() {
        return [
            'firms.*.rate.required' => 'Komisyon oranı alanı zorunludur.',
        ];
    }
	
	public function updatedFirms($value, $key) {
		$this->validate();
		$exploded = explode('.', $key);
        $inputName = $exploded[1];
        $index = $exploded[0];
		$updatedFirm = $this->firms[$index];
        if ($inputName == 'rate' && !$this->shouldUpdate->contains('id', $updatedFirm['id'])) {
            $this->shouldUpdate->push([
				'id' => $updatedFirm['id'],
				'firm' => $updatedFirm['firm'],
				'rate' => $value
			]);
	   } elseif ($inputName == 'rate' && $this->shouldUpdate->contains('id', $updatedFirm['id'])) {
			 $this->shouldUpdate->transform(function ($item) use ($updatedFirm, $value) { 
				if($item['id'] == $updatedFirm['id']) {
					$item['rate'] = $value;
				}
				 return $item;
			});
		}
	}

     public function mount()
    {
      	$this->firms = CommissionRate::all()->toArray();
		$this->shouldUpdate = collect();
    }


    public function render()
    {
        return view('livewire.products.setting')
			->layout('livewire.layouts.page');
    }
	
	public function update() {
		$this->validate();
		
		
		 $update = CommissionRate::upsert($this->shouldUpdate->toArray(), ['id'], ['firm', 'rate']);
		 if($update) {
			 $statuses[] =  ['isSuccess' => true, 'message' => 'Komisyon oranları Başarıyla Güncellendi.'];
		 } else {
		 	$statuses[] =  ['isSuccess' => false, 'message' => "Komisyon oranları güncellenemedi."];
		 }  
		
		session()->now('statuses', $statuses);
		
    }
}

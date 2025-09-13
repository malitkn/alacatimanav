<?php

namespace App\Getir;

use App\Models\CommissionRate;
use App\Models\Token;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\DecimalHelper;

class Product
{
	use DecimalHelper;
		
    private $username;
    private $password;
    private $firmId;
    private $token;
	private $commissionRate;

    public function __construct()
    {
        $this->username = config('credentials.getir.username', 'alacatimanav@gmail.com');
        $this->password = config('credentials.getir.password', 'Iskele7272.');
        $this->firmId = CommissionRate::where('firm', 'getir')->first()->id;
		$this->commissionRate = CommissionRate::find($this->firmId)->rate;
		$this->login();
        $this->token = @Token::where('firm', $this->firmId)->orderBy('created_at', 'desc')->first()->token; //
        if (is_null($this->token)) {
            $this->login();
        }
    }

    public function login()
    {
        $response = Http::withHeaders([
        'Host' => 'locals-api-gateway.artisan.getirapi.com',
    'Connection' => 'keep-alive',
    'shopid' => 'dummy',
    'sec-ch-ua-platform' => '"Windows"',
    'Authorization' => 'Bearer undefined',
    'Accept-Language' => 'tr',
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',
    'oauthenabled' => '1',
    'token' => 'dummy',
    'Origin' => 'https://panel.getircarsi.com',
    'Referer' => 'https://panel.getircarsi.com/',
    'Accept-Encoding' => 'gzip, deflate',
        ])->withOptions(['verify' => false])->withBody('{"username":"' . $this->username . '","password":"' . $this->password . '"}')->post('https://locals-api-gateway.artisan.getirapi.com/auth/login');
        if (!$response->successful()) {
            Log::channel('products')->critical('Getir login olunamadı');
        }
		$accessToken = data_get($response->json(), 'accessToken');
        Token::create([
            'firm' => $this->firmId,
            'token' => trim($accessToken)
        ]);
		$this->token = $accessToken;
      // return $accessToken;
		return $response;
    }

    public function update($rows, $withoutCommission = false)
    {
		
		$this->login();
		$products = collect();
		$message = "Girdiğiniz ürünlerin fiyatı zaten güncel. [Getir]";
		$skippedProducts = [];
		$errorMessage = [];
		
		 foreach ($rows as $row) {
			$price = $row['newPrice'];
   		 	$relatedProducts = DB::table('products')->where('midipos', $row['midipos'])
		 	 ->where('firm', $this->firmId)
			 ->get()
			 ->map(function ($product) use ($price) 
				   {
   					 $product->price = $price;
  				 	 return $product;
				});
				if ($relatedProducts->isEmpty()) {
   				 Log::channel('products')->warning('Getir ürünü bulunamadı. midipos: ' . $row['midipos']);
					$skippedProducts[] = $row['midipos']; // Bulunamayan ürün kodunu ekle diziye
       			 continue;
			}
			
    	 $products = $products->merge($relatedProducts);
		}
		
		 $productItems = $products->map(function ($product) use ($withoutCommission) {
		
    return [
            "listingProductId" => trim($product->SKU),
            "shelfId" => trim($product->shelfId),
            "newValue" => [
                "price" => $this->truncateDecimal(($product->price * ($withoutCommission ? 1.00 :  $this->commissionRate)) * ($product->factor)),
            ]
        ];  
})->values()->all(); 
		$productItems = $this->removeHasSamePrice($productItems);
		
		if(empty($productItems)) {
		 return ['status' => false, 'message' => $message, 'data' => ['skippedProducts' => $skippedProducts]];
		}
        $data = [
    "payloads" => array_values($productItems)
];
	
	
        $response = Http::withHeaders([
       'Host' => 'locals-api-gateway.artisan.getirapi.com',
    'Connection' => 'keep-alive',
    'sec-ch-ua' => '"Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'shopid' => '684fd9f1f5df904ba20be44d',
    'Accept-Language' => 'tr',
    'sec-ch-ua-mobile' => '?0',
    'Authorization' => "Bearer $this->token",
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json, text/plain, */*',
    'oauthenabled' => '1',
    'token' => 'dummy',
    'sec-ch-ua-platform' => '"Windows"',
    'Origin' => 'https://panel.getircarsi.com',
    'Sec-Fetch-Site' => 'cross-site',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Dest' => 'empty',
    'Referer' => 'https://panel.getircarsi.com/',
    'Accept-Encoding' => 'gzip, deflate',
            ])->withOptions(['timeout' => 20])
			->post('https://locals-api-gateway.artisan.getirapi.com/locals-menu/demands/listing-product/update/bulk',$data);
        if (!$response->successful()) {
			$this->login();
			$errorCode = data_get($response->json(),'code');
			$errorMessage[] = data_get($response->json(),'message');
			$statusCode = data_get($response->json(),'statusCode');
			switch($errorCode) {
				case 17000:
				Log::channel('products')->warning('Getir ürün bilgisi bulunamadığı için fiyat güncellenemedi!', $rows);
				$message = "Girdiğiniz ürünlerin arasında getire eklenmemiş ürün bulunuyor.";
				break;
				case 20001:
				Log::channel('products')->warning('Getir ürün fiyatı aynı olduğu için güncellenemedi!', $rows);
				$message = "Değiştirilmek istenen ürünler arasında aynı fiyatlı ürün var.";
				default:
					Log::channel('products')->warning("Getir fiyat güncellenemedi! Durum Kodu: $statusCode, Hata Mesajı:", $errorMessage);
				
					$message ='Hata Kodu:' . $statusCode;
			}
        }
		
		Log::channel('products')->info('Getir Response =>', [
		'status' => $response->status(), 
		'headers' => $response->headers(),
    	'body' => $response->body(),
	]);	
		
    return [
			'status' => $response->successful(),
			'message' => $message,
			'data' => ['skippedProducts' => $skippedProducts, 'errorMessage' => $errorMessage]
	];
    }
	
	protected function removeHasSamePrice($products)
	{
			foreach($products as $index => $product) {
		 $response = Http::withHeaders([
       'Host' => 'locals-api-gateway.artisan.getirapi.com',
    'Connection' => 'keep-alive',
    'sec-ch-ua' => '"Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'shopid' => '684fd9f1f5df904ba20be44d',
    'Accept-Language' => 'tr',
    'sec-ch-ua-mobile' => '?0',
    'Authorization' => "Bearer $this->token",
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json, text/plain, */*',
    'oauthenabled' => '1',
    'token' => 'dummy',
    'sec-ch-ua-platform' => '"Windows"',
    'Origin' => 'https://panel.getircarsi.com',
    'Sec-Fetch-Site' => 'cross-site',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Dest' => 'empty',
    'Referer' => 'https://panel.getircarsi.com/',
    'Accept-Encoding' => 'gzip, deflate',
            ])->withOptions(['timeout' => 20])
			->get("https://locals-api-gateway.artisan.getirapi.com/locals-menu/listing-products/$product[listingProductId]?merchantTypeCode=49bb82b8-d3a6-4366-8e9b-ff9234f56c6e");
				$price = data_get($response->json(), 'price');
				if($price == $product['newValue']['price']) {
					unset($products[$index]);
				}	
		}
		return $products;
	}
	
	public function openVendor()
	{
		try {
		 $this->login();
		 $response = Http::withHeaders([
    'Connection' => 'keep-alive',
    'sec-ch-ua' => '"Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'shopid' => '684fd9f1f5df904ba20be44d',
    'Accept-Language' => 'tr',
    'sec-ch-ua-mobile' => '?0',
    'Authorization' => "Bearer $this->token",
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json, text/plain, */*',
    'oauthenabled' => '1',
    'token' => 'dummy',
    'Accept-Encoding' => 'gzip, deflate',
            ])->withOptions(['timeout' => 20])
			->post('https://api-gateway.artisan.getirapi.com/shops/684fd9f1f5df904ba20be44d/status/open', [
				"timeOffAmount" => 0,
				"strategy" => ["type" => "INDEFINITE"]
		]);
			$result = data_get($response->json(), 'result');
		//	Log::channel('orders')->warning('response =>', ['resp' => $response->body()]);
			return $result ? true : false;
		} catch (\Exception $e) {
			Log::channel('orders')->critical('[Getir::class] Kritik hata: Vendor açılamadı', ['message' => $e->getMessage()]);
		}
		
	}
	
	public function setStatus($rows)
    {
		$this->login();
		$products = collect();
		$errorMessage = [];
		$skippedProducts = [];
		$message = "Getir ürün durumu başarıyla güncellendi";
		
		 foreach ($rows as $row) {
			$status = $row['status'];
   		 	$relatedProducts = DB::table('products')->where('midipos', $row['midipos'])
		 	 ->where('firm', $this->firmId)
			 ->get()
			 ->map(function ($product) use ($status) {
   					 $product->isActive = $status ? true : false;
  				 	 return $product;
				});
				if ($relatedProducts->isEmpty()) {
   				 Log::channel('products')->warning('Getir ürünü bulunamadı. midipos: ' . $row['midipos']);
					$skippedProducts[] = $row['midipos']; // Bulunamayan ürün kodunu ekle diziye
       			 continue;
			}
			
    	 $products = $products->merge($relatedProducts);
		}
		
		 $productItems = $products->map(function ($product) {
		
    return [
            "listingProductId" => trim($product->SKU),
            "isActive" => $product->isActive,
			"beLocked" => true,
        ];  
})->values()->all(); 
		
		
		if(empty($productItems)) {
		 return ['status' => false, 'message' => $message, 'data' => ['skippedProducts' => $skippedProducts]];
		}
        $data = $productItems;
	
	
        $response = Http::withHeaders([
       'Host' => 'locals-api-gateway.artisan.getirapi.com',
    'Connection' => 'keep-alive',
    'sec-ch-ua' => '"Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"',
    'shopid' => '684fd9f1f5df904ba20be44d',
    'Accept-Language' => 'tr',
    'sec-ch-ua-mobile' => '?0',
    'Authorization' => "Bearer $this->token",
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json, text/plain, */*',
    'oauthenabled' => '1',
    'token' => 'dummy',
    'sec-ch-ua-platform' => '"Windows"',
    'Origin' => 'https://panel.getircarsi.com',
    'Sec-Fetch-Site' => 'cross-site',
    'Sec-Fetch-Mode' => 'cors',
    'Sec-Fetch-Dest' => 'empty',
    'Referer' => 'https://panel.getircarsi.com/',
    'Accept-Encoding' => 'gzip, deflate',
            ])->withOptions(['timeout' => 20])
			->put('https://locals-api-gateway.artisan.getirapi.com/locals-menu/listing-products/bulk-status-update',$data);
        if (!$response->successful()) {
			$this->login();
			$message = "Getir ürün durumu güncellenemedi.";
			Log::channel('products')->critical('Getir ürün durumu güncellenemedi', ['response' => $response]);
        }
		
		Log::channel('products')->info('Getir Response =>', [
		'status' => $response->status(), 
		'headers' => $response->headers(),
    	'body' => $response->body(),
	]);	
		
    return [
			'status' => $response->successful(),
			'message' => $message,
			'data' => ['skippedProducts' => $skippedProducts, 'errorMessage' => $errorMessage]
	];
    }
	
	
}

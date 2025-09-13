<?php

namespace App\Yemeksepeti;

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
        $this->username = config('credentials.yemeksepeti.username', 'alacatimanav@gmail.com');
        $this->password = config('credentials.yemeksepeti.password', 'iskele72');
        $this->firmId = CommissionRate::where('firm', 'yemeksepeti')->first()->id;
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
            'Host' => 'bff-api.eu.prd.portal.restaurant',
            'Connection' => 'keep-alive',
            'sec-ch-ua-platform' => '"Windows"',
            'X-App-Name' => 'one-web',
            'sec-ch-ua' => '"Not)A;Brand";v="8", "Chromium";v="138", "Google Chrome";v="138"',
            'sec-ch-ua-mobile' => '?0',
            'X-Device' => 'eyJhbGciOiJSUzI1NiIsImtpZCI6ImtleW1ha2VyLXZwLTAwMTQtdnAtZXUtZHZjIiwidHlwIjoiSldUIn0.eyJpc3MiOiJodHRwczovL3ZlbmRvcnBvcnRhbC1ldS5kaC1hdXRoLmlvIiwic3ViIjoiMjE4MDdjNDgtYzI1NS00OTlkLWFmOWQtMzAwZWZjMjA5ODA3IiwiYXVkIjoidmVuZG9yLXBvcnRhbC1wcmQtZXUiLCJleHAiOjQ5MDUxNzU0OTgsImlhdCI6MTc1MTU3NTQ5OCwianRpIjoiNWI2ZTdiZWItMTVkNS00ZWZmLWJiYWMtMWEwMjg3MmRlYTA4Iiwic2NvcGUiOiJERVZJQ0VfVE9LRU4iLCJtZXRhZGF0YSI6bnVsbH0.NAvcv0KSzHN91iphzY2GGnhO0vJhvf6W9GJcI5-q6eMQcjp8tnNs1fuEiFQXb-lK9YFUiWhsPaO_8KXVlQHdjgFMDkqQJL7i8oCBA5uo44EuOT8gpbxbASAvwWLYOeXBFCtmHA_ihHR0Sad6qrntm6fbSH6VpIjDoIe5LhlEYeOSqHKL3yO6DadrEY_k8XgHBhlGI2NUvxXbMGyYAIuB1mR8AipdwB_cp18mFlGFGJluhnG6Em4ezjj3MSPqn9N5RRBz-muBjWxYbQW-N-pRQZaXP0aPPrOaYWujzm3Tx1B3q8hupYaiA_5jar3rHesfO2T1VOuA1Ixpd-5DzoZCcQ',
            'X-App-Version' => '3.19.2',
            'Accept' => 'application/json, text/plain, */*',
            'Content-Type' => 'application/json',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36',
            'Origin' => 'https://partner-app.yemeksepeti.com',
            'Sec-Fetch-Site' => 'cross-site',
            'Sec-Fetch-Mode' => 'cors',
            'Sec-Fetch-Dest' => 'empty',
            'Referer' => 'https://partner-app.yemeksepeti.com/',
            'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
            'Accept-Encoding' => 'gzip, deflate',
        ])->withOptions(['verify' => false])->withBody('{"username":"' . $this->username . '","password":"' . $this->password . '"}')->post('https://bff-api.eu.prd.portal.restaurant/auth/v4/login');
        if (!$response->ok()) {
            Log::channel('products')->critical('Yemeksepeti login olunamadı');
        }
		$accessToken = data_get($response->json(), 'keymaker.access_token');
        Token::create([
            'firm' => $this->firmId,
            'token' => trim($accessToken)
        ]);
		$this->token = $accessToken;
        return $accessToken;
    }

    public function update($rows, $withoutCommission = false)
    {
		$products = collect();

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

   				 Log::channel('products')->warning('Yemeksepeti ürün bulunamadı. Midipos:' . $row['midipos']);
       			 continue;
			}
    	 $products = $products->merge($relatedProducts);
		}
		$productItems = $products->map(function ($product) use ($withoutCommission) {

    return [
        "sku" => trim($product->SKU), // SKU şeklinde olacak ufak harfte patlıyor
        "price" => $this->truncateDecimal(($product->price * ($withoutCommission ? 1.00 :  $this->commissionRate)) * ($product->factor)),
    ];
})->values()->all();
        $data = [
            "operationName" => "UpdateProducts",
            "variables" => [
                "productsUpdate" => [
                    "vendorIdentifiers" => [
                        [
                            "globalEntityId" => "YS_TR",
                            "platformVendorId" => "ttc4",
                        ],
                    ],
                    "requestConfiguration" => [
                        "isAsyncModeCountBased" => true,
                        "minimumUpdatesForAsync" => 1,
                    ],
                    "products" => $productItems,
                ],
            ],
            "query" => "mutation UpdateProducts(\$productsUpdate: ProductsUpdate!) {\n  productsUpdate(productsUpdate: \$productsUpdate) {\n    ... on ProductsUpdateAccepted {\n      bulkRequestId\n      __typename\n    }\n    ... on ProductsUpdateValidationErrors {\n      productsErrors {\n        vendorIdentifier {\n          platformVendorId\n          globalEntityId\n          __typename\n        }\n        sku\n        barcode\n        identifier\n        error\n        __typename\n      }\n      error {\n        key\n        variables\n        __typename\n      }\n      __typename\n    }\n    ... on ProductsUpdateAsyncAccepted {\n      result {\n        vendorIdentifier {\n          platformVendorId\n          globalEntityId\n          __typename\n        }\n        status\n        jobId\n        __typename\n      }\n      __typename\n    }\n    ... on ProductsUpdateAccepted {\n      bulkRequestId\n      __typename\n    }\n    __typename\n  }\n}",
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer $this->token",
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
            'Origin' => 'https://partner-app.yemeksepeti.com',
            'Referer' => 'https://partner-app.yemeksepeti.com/',
            'x-client-source' => 'one-web',
        ])->withOptions(['verify' => false,
            'allow_redirects' => true, // Yönlendirmeleri takip et
            'decode_content' => true,  // gzip/deflate çözümlemesi
            ])->post('https://catalog-vss-api-me.deliveryhero.io/graphql',$data);
        if (!$response->ok()) {
			$this->login();
            Log::channel('products')->critical('Yemeksepeti fiyat güncellenemedi');
        }
	Log::channel('products')->info('Yemeksepeti Response =>', [
		'status' => $response->status(),
		'headers' => $response->headers(),
    	'body' => $response->body(),
	]);
    return $response->ok();
    }

	public function setStatus($rows) {
		$products = collect();

		foreach ($rows as $row) {
			$status = $row['status'];
   			$relatedProducts = DB::table('products')->where('midipos', $row['midipos'])
			 ->where('firm', $this->firmId)
			 ->get()
			 ->map(function ($product) use ($status)
				   {
   					 $product->active = $status ? true : false;
  				 	 return $product;
				});
			if ($relatedProducts->isEmpty()) {

   				 Log::channel('products')->warning('Yemeksepeti ürün bulunamadı. Midipos:' . $row['midipos']);
       			 continue;
			}
    	 $products = $products->merge($relatedProducts);
		}
		$productItems = $products->map(function ($product) {

    return [
        "sku" => trim($product->SKU), // SKU şeklinde olacak ufak harfte patlıyor
        "active" => $product->active,
    ];
})->values()->all();
        $data = [
    "operationName" => "UpdateProducts",
    "variables" => [
        "productsUpdate" => [
            "vendorIdentifiers" => [
                [
                    "globalEntityId" => "YS_TR",
                    "platformVendorId" => "ttc4",
                ],
            ],
            "requestConfiguration" => [
                "isAsyncModeCountBased" => true,
                "minimumUpdatesForAsync" => 1,
            ],
            "products" => $productItems,
        ],
    ],
    "query" => "mutation UpdateProducts(\$productsUpdate: ProductsUpdate!) {\n  productsUpdate(productsUpdate: \$productsUpdate) {\n    ... on ProductsUpdateAccepted {\n      bulkRequestId\n      __typename\n    }\n    ... on ProductsUpdateValidationErrors {\n      productsErrors {\n        vendorIdentifier {\n          platformVendorId\n          globalEntityId\n          __typename\n        }\n        sku\n        barcode\n        identifier\n        error\n        __typename\n      }\n      error {\n        key\n        variables\n        __typename\n      }\n      __typename\n    }\n    ... on ProductsUpdateAsyncAccepted {\n      result {\n        vendorIdentifier {\n          platformVendorId\n          globalEntityId\n          __typename\n        }\n        status\n        jobId\n        __typename\n      }\n      __typename\n    }\n    ... on ProductsUpdateAccepted {\n      bulkRequestId\n      __typename\n    }\n    __typename\n  }\n}",
];

        $response = Http::withHeaders([
            'Authorization' => "Bearer $this->token",
            'Content-Type' => 'application/json; charset=utf-8',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
            'Origin' => 'https://partner-app.yemeksepeti.com',
            'Referer' => 'https://partner-app.yemeksepeti.com/',
            'x-client-source' => 'one-web',
        ])->withOptions(['verify' => false,
            'allow_redirects' => true, // Yönlendirmeleri takip et
            'decode_content' => true,  // gzip/deflate çözümlemesi
            ])->post('https://catalog-vss-api-me.deliveryhero.io/graphql',$data);
        if (!$response->ok()) {
			$this->login();
            Log::channel('products')->critical('Yemeksepeti ürün durumu güncellenemedi');
        }
	Log::channel('products')->info('Yemeksepeti Response =>', [
		'status' => $response->status(),
		'headers' => $response->headers(),
    	'body' => $response->body(),
	]);
    return $response->ok();
	}
}

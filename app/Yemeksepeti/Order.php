<?php

namespace App\Yemeksepeti;

use App\Models\CommissionRate;
use App\Models\Token;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class Order
{
    private $username;
    private $password;
	private $firmId;
    private $token;
	

    public function __construct()
    {
        $this->username = config('credentials.yemeksepeti.username', 'alacatimanav@gmail.com');
        $this->password = config('credentials.yemeksepeti.password', 'iskele72');
		$this->firmId = CommissionRate::where('firm', 'yemeksepeti')->first()->id;
		$this->login();
        $this->token = @Token::where('firm', $this->firmId)->orderBy('created_at', 'desc')->first()->token; //
        if (is_null($this->token)) {
            $this->login();
        }
    }

    private function login()
    {
        $response = Http::withHeaders([
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
            'Content-Length' => '59',
        ])->withOptions(['verify' => false])->withBody('{"username":"' . $this->username . '","password":"' . $this->password . '"}')->post('https://bff-api.eu.prd.portal.restaurant/auth/v4/login');
		try {
        if (!$response->ok()) {
            Log::critical('Yemeksepeti login olunamadı');
			Log::channel('orders')->critical('Yemeksepeti Login olunamadı', ['response' => $response]);
        }
        $accessToken = explode('"access_token":"', $response->body())[1];
        $accessToken = explode('"', $accessToken)[0];
        Token::create([
            'firm' => $this->firmId,
            'token' => trim($accessToken)
        ]);
		$this->token = $accessToken;
        return $accessToken;
		} catch (\Exception $e) {
			Log::channel('orders')->critical('Yemeksepeti Login olunamadı', ['response' => $response, 'message' => $e->getMessage()]);
		}
    }

	public function getLastOrders()
	{
		$this->login();
		$dateFrom = $this->getStartOfDayUtc(6);
		$dateTo = $this->getEndOfDayUtc();
		
		$data = [
    "operationName" => "ListOrders",
    "variables" => [
        "params" => [
            "pagination" => [
                "pageSize" => 50
            ],
            "timeFrom" => $dateFrom,
            "timeTo" => $dateTo,
            "globalVendorCodes" => [
                [
                    "globalEntityId" => "YS_TR",
                    "vendorId" => "ttc4"
                ]
            ]
        ]
    ],
    "query" => <<<GQL
query ListOrders(\$params: ListOrdersReq!) {
  orders {
    listOrders(input: \$params) {
      nextPageToken
      resultTimestamp
      orders {
        ...OrderListingFields
        __typename
      }
      __typename
    }
    __typename
  }
}

fragment OrderListingFields on OrderSummary {
  orderId
  globalEntityId
  vendorId
  vendorName
  orderStatus
  placedTimestamp
  subtotal
  billableStatus
  deliveryType
  billing {
    commissionAmount
    netRevenue
    __typename
  }
  orderIssues
  __typename
}
GQL
];
		
		$response = Http::withHeaders([
            'Authorization' => "Bearer $this->token",
            'Host' => 'vagw-api.eu.prd.portal.restaurant',
    		'Connection' => 'keep-alive',
    		'apollographql-client-name' => 'API Gateway',
    		'x-user-id' => '21807c48-c255-499d-af9d-300efc209807',
    'x-vendor-id' => 'WVNfVFItdHRjNA',
    'x-global-entity-id' => 'YS_TR',
    'x-country' => 'TR',
    'x-app-name' => 'one-web',
    'x-rps-device' => '8ef83def-f973-48d1-bbce-ef53b9a89694',
    //'x-request-id' => '53c1cdc2-951d-4cf9-b99b-3d1a271eadd5',
    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0...)',
    'Origin' => 'https://partner-app.yemeksepeti.com',
    'Referer' => 'https://partner-app.yemeksepeti.com/',
    'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
    'Accept-Encoding' => 'gzip, deflate',
    'Content-Type' => 'application/json',
        ])->withOptions([
			'verify' => false,
            'allow_redirects' => true, // Yönlendirmeleri takip et
            'decode_content' => true,  // gzip/deflate çözümlemesi
            ])->post('https://vagw-api.eu.prd.portal.restaurant/query',$data);
		try {
			$orders = data_get($response->json(),'data.orders.listOrders.orders');
			$lastOrder = data_get($orders, '0');
			if($lastOrder['orderStatus'] != 'DELIVERED') {
			 Log::channel('orders')->info('[Order::class] Yeni Sipariş Var. Bu logdan sonra bildirim gelmesi gerek.' , $lastOrder);
			}
		} catch (\Exception $e) {
			Log::channel('orders')->critical('[Order::class] Orders null', [
				'error' => $e->getMessage(),
				'response' => $response,
				'orders' => $orders,
			]);
			}
		return $orders;
	}
	
	private function getDate($addDays = 0, $subDays = 0)
	{
		return Carbon::now('Europe/Istanbul')
			->setTimezone('UTC')
			->startofDay()
			->addDays($addDays)
			->subDays($subDays)
			->format('Y-m-d\TH:i:s.000\Z');
	}
	
	protected function getStartOfDayUtc(int $daysFromToday = 0): string
{
    return Carbon::now('Europe/Istanbul')
        ->subDays($daysFromToday)
        ->startOfDay()
        ->setTimezone('UTC')
        ->format('Y-m-d\TH:i:s.000\Z');
}
	
	protected function getEndOfDayUtc(int $daysFromToday = 0): string
{
    return Carbon::now('Europe/Istanbul')
        ->addDays($daysFromToday)
        ->endOfDay()
        ->setTimezone('UTC')
        ->format('Y-m-d\TH:i:s.999\Z');
}
	

    
}

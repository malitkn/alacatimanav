<?php

namespace App\Yemeksepeti;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Product
{
    private $username;
    private $password;

    public function __construct()
    {
        $this->username = config('credentials.yemeksepeti.username', 'alacatimanav@gmail.com');
        $this->password = config('credentials.yemeksepeti.password', 'iskele72');

        if (Cookie::has('access_token')) {
            // Check token
        } else {

        }
    }

    private function checkAccessToken()
    {

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
            'Content-Length' => '59',
        ])->withOptions(['verify' => false])->withBody('{"username":"' . $this->username . '","password":"' . $this->password . '"}')->post('https://bff-api.eu.prd.portal.restaurant/auth/v4/login');
        if (!$response->ok()) {
            Log::critical('Yemeksepeti login olunamadı');
        }
        $accessToken = explode('"access_token":"',$response->body())[1];
        $accessToken = explode('"', $accessToken)[0];
        session()->put('access_token', $accessToken);
        return $accessToken;
    }
}

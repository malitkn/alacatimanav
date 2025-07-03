<?php

namespace App\Http;

use Illuminate\Support\Facades\Http;

class Getir
{
    private $username;
    private $password
    public function __construct()
    {
        $this->username = config('credentials.getir.username', 'alacatimanav@gmail.com');
        $this->password = config('credentials.getir.password', 'Iskele7272.');
    }

    public function login() {
      //
    }
    public function __invoke(): void
    {
        //
    }
}

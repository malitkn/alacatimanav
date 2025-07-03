<?php

namespace App\Http;

class Yemeksepeti
{
    private $username;
    private $password
    public function __construct()
    {
        $this->username = config('credentials.yemeksepeti.username', 'alacatimanav@gmail.com');
        $this->password = config('credentials.yemeksepeti.password', 'iskele72');
    }

}

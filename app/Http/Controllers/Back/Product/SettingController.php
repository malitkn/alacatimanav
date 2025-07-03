<?php

namespace App\Http\Controllers\Back\Product;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('back.products.settings');
    }
}

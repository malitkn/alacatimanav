<?php

namespace App\Http\Controllers\Back\Product;

use App\Http\Controllers\Controller;

class UpdateController extends Controller
{
    public function index()
    {
        return view('back.products.update');
    }
}

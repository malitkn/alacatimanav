<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sessions = Session::query()
            ->orderBy('last_activity','desc')
            ->limit(4)
            ->get();

        $colours = ['one', 'two', 'three', 'four'];
        return view('back.index', compact('sessions', 'colours'));
    }
}

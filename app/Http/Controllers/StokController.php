<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// 追加
use App\Stok;

class StokController extends Controller
{
    // indexアクション
    public function index()
    {
        $stoks = Stok::all();
        return view('stoks.index', ['stoks' => $stoks]);
    }
}

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

    // showアクション
    public function show($id)
    {
        $stok = Stok::find($id);
        if ($stok === null) {
            abort(404);
        }
        return view('stoks.show', ['stok' => $stok]);
    }

    // updateアクション
    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $stok = Stok::find($id);
        if ($stok === null) {
            abort(404);
        }

        $fillData = [];
        if (isset($request->name)) {
            $fillData['name'] = $request->name;
        }
        if (isset($request->price)) {
            $fillData['price'] = $request->price;
        }
        if (isset($request->quantity)) {
            $fillData['quantity'] = $request->quantity;
        }
        if (isset($request->role)) {
            $fillData['role'] = $request->role;
        }

        if (count($fillData) > 0) {
            $stok->fill($fillData);
            $stok->save();
        }
        return redirect('/stoks/' . $id);
    }

    public function new()
    {
        return view('stoks.new');
    }

    public function create(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        Stok::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'role' => $request->role,
        ]);
        return redirect('/stoks');
    }

    public function delete($id)
    {
        Stok::destroy($id);
        return redirect('/stoks');
    }

}

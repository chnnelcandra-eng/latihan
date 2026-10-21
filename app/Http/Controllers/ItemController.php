<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $items = DB::table('items')->get();
        return view('items.index', ['items' => $items]);
    }

    // CREATE: Menyimpan data baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('items')->insert([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Item berhasil ditambahkan!'
        ]);
    }

    // UPDATE: Mengubah data yang sudah ada
    // UPDATE
public function update(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id'          => 'required|integer|exists:items,id',
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    DB::table('items')->where('id', $request->id)->update([
        'name'        => $request->name,
        'description' => $request->description,
        'price'       => $request->price,
        'stock'       => $request->stock,
        'updated_at'  => now(),
    ]);

    return response()->json([
        'status'  => true,
        'message' => 'Item berhasil diperbarui!'
    ]);
}

// DELETE
public function destroy(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'required|integer|exists:items,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    DB::table('items')->where('id', $request->id)->delete();

    return response()->json([
        'status'  => true,
        'message' => 'Item berhasil dihapus!'
    ]);
}
}
<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();

        return response()->json([
            'status' => true,
            'message' => 'List Produk',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data =  $request->validate([
            'name' => 'required',
            'price' =>  'required',
            'stock' => 'required',
            'description' => 'required'
        ]);

        try {
            Produk::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Produk'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Produk'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data Produk',
            'data' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk, $id)
    {
        // $produk = Produk::find($id);

        // // dd($produk);

        // if (!$produk) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Produk tidak ditemukan'
        //     ]);
        // }

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required',
        ]);

        try {
            $produk->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Product'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambhkan Product'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Data'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index($id)
    {
        $data = Transaction::where('produk_id', $id)->get();
        return response()->json(['data' => $data]);
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
        return response()->json(['data' => $transaction]);
    }

    public function store(Request $request)
    {
        $data =  $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'quantity' => 'required|integer',
        ]);

        // dd($data);

        $produk = Produk::find($data['produk_id']);
        $price = $produk->price;
        $paymentAmount = $price * $data['quantity'];

        $transaction = new Transaction([
            // 'reference_no' => $this->generateReferenceNo(),
            'price' => $price,
            'quantity' => $data['quantity'],
            'payment_amount' => $paymentAmount,
            'produk_id' => $data['product_id'],
        ]);

        $transaction->save();

        return response()->json([
            'message' => 'Transaksi berhasil ditambahkan',
            'transaction' => $transaction,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'reference_no' => 'required',
            'quantity' => 'required',
            'payment_amount' => 'required',
            'produk_id' => 'required'
        ]);

        $transaction->update($data);

        return response()->json(['message' => 'Transaksi berhasil diupdate', 'data' => $transaction]);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }

    // public function getResponseReferenceNo()
    // {
    //     $currentTime = now();
    //     $referenceNo = 'REF' . $currentTime->format('YmdHis') . uniqid();

    //     return $referenceNo;
    // }
}

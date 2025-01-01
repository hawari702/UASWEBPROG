<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = session()->get('pesanan', []);
        return view('pesanan', compact('pesanan'));
    }

    public function remove($id)
    {
        $pesanan = session()->get('pesanan', []);
        if (isset($pesanan[$id])) {
            unset($pesanan[$id]);
            session()->put('pesanan', $pesanan);
        }
        return redirect()->route('pesanan');
    }

    public function clearCart(Request $request)
    {
        $pesanan = session()->get('pesanan', []);
        
        foreach ($pesanan as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'error' => "Stok produk {$product->name} tidak mencukupi. Stok tersedia: {$product->stock}"
                    ]);
                }
            }
        }
        
        foreach ($pesanan as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $product->stock = $product->stock - $item['quantity'];
                $product->save();
            }
        }

        session()->forget('pesanan');
        
        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart; 
use App\Models\Product; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function __construct()
    {
        
    }

    public function add(Request $request)
    {
        try {
            $productId = $request->product_id;
            $quantity = max(1, (int)$request->quantity); 
            
            $product = Product::findOrFail($productId);
            
            $cart = session()->get('pesanan', []);
            
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity
                ];
            }
            
            session()->put('pesanan', $cart);
            
            \Log::info('Cart updated:', ['cart' => $cart]);
            
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            \Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $cart = session()->get('pesanan', []);
            $productId = $request->product_id;
            $quantity = (int)$request->quantity;

            if(isset($cart[$productId])) {
                if($quantity <= 0) {
                    unset($cart[$productId]);
                } else {
                    $cart[$productId]['quantity'] = $quantity;
                }
                session()->put('pesanan', $cart);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Quantity berhasil diupdate',
                    'cart' => $cart
                ]);
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan dalam pesanan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate quantity: ' . $e->getMessage()
            ], 500);
        }
    }
    
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FrontEndController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('frontend.index', compact('products')); 
    }

    public function show($id) {
        $product = Product::find($id);
        return view('frontend.product-detail.index', compact('product'));
    }

    public function cart() {
        // Fetch user and their points
        $user = Auth::user();
        $points = $user->poin;

        // Fetch cart items
        $cart = session('cart');
        $total = 0;

        if ($cart) {
            foreach ($cart as $item) {
                $total += $item['quantity'] * $item['price'];
            }
        }

        return view('frontend.cart.index', compact('cart', 'total', 'points'));
    }


    public function addToCart($id) {
        $product = Product::find($id);
        $cart = session()->get('cart');
    
        // Check if the cart already has this product
        if(isset($cart[$id])) {
            // Increase quantity if product is already in cart
            $cart[$id]['quantity']++;
        } else {
            // Add new product to cart
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'photo' => $product->image,
            ];
        }
    
        // Calculate points for the current item
        $points = 0;
        $typeName = $product->productType->name;
    
        if ($typeName == 'deluxe' || $typeName == 'superior' || $typeName == 'suite') {
            // Add points for deluxe, superior, or suite products
            $points = 5;
        } else {
            // Add points based on other conditions
            $points = floor($product->price / 300000);
        }
    
        // Update user's session with cart
        session()->put('cart', $cart);
    
        // Redirect back with status message
        return redirect()->back()->with("status", "Produk Telah ditambahkan ke Cart")->with("points", $points);
    }
    
    

    public function addQuantity(Request $request) {
        $id = $request->id;
        $cart = session()->get('cart');
        $product = Product::find($cart[$id]['id']);
        if(isset($cart[$id])) {
            $jumlahAwal = $cart[$id]['quantity'];
            $jumlahPesan = $jumlahAwal+1;
            if($jumlahPesan < $product->available_room) {
                $cart[$id]['quantity']++;
            } else {
                return redirect()->back()->with('error','Jumlah pemesanan melebihi total kamar yang tersedia');
            }
        }
        session()->forget('cart');
        session()->put('cart',$cart);
    }

    public function reduceQuantity(Request $request) {
        $id = $request->id;
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 0) {
                $cart[$id]['quantity']--;
            }
        }
        session()->forget('cart');
        session()->put('cart',$cart);
    }

    public function deleteFromCart($id) {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->forget('cart');
        session()->put('cart',$cart);
        return redirect()->back()->with("status","Produk Telah dibuang dari Cart");
    }

    public function checkout() {
        $cart = session('cart');
        $user = Auth::user();
        $totalPoints = 0;
    
        // Calculate total points for the entire cart
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            $typeName = $product->productType->name;
    
            if ($typeName == 'deluxe' || $typeName == 'superior' || $typeName == 'suite') {
                // Add points for deluxe, superior, or suite products
                $totalPoints += 5 * $item['quantity'];
            } else {
                // Add points based on other conditions
                $totalPoints += floor($item['quantity'] * $item['price'] / 300000);
            }
        }
    
        // Save transaction
        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->transaction_date = Carbon::now()->toDateTimeString();
        $transaction->save();
    
        // Insert into junction table product_transaction using eloquent
        $transaction->insertProducts($cart, $user);
    
        // Update user points
        $user->poin += $totalPoints;
        $user->save();
    
        // Clear cart after checkout
        session()->forget('cart');
    
        return redirect()->route('laralux.index')->with('status', 'Checkout berhasil');
    }
    

}

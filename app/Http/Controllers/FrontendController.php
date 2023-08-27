<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $order_utama = null;
        $user = Auth::user();

        if ($user) {
            $order_utama = \App\Models\Order::where('user_id', $user->id)->where('status', 0)->first();
        }

        if (!$user || !$order_utama) {
            $notif = 0;
        } else {
            $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();
        }

        $products = \App\Models\Product::all();
        return view('frontend.home', [
            'products' => $products,
            'notif' => $notif
        ]);
    }
}

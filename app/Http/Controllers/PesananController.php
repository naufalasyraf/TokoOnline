<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;

        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 1)->first();

        if ($order_utama) {
            $notif = OrderItem::whereHas('order', function ($query) use ($order_utama) {
                $query->where('status', 0)->where('id', $order_utama->id);
            })->count();
        } else {
            $notif = 0;
        }

        $order_items= [];

        if ($order_utama) {
            $order_items = OrderItem::whereHas('order', function($query) use ($order_utama) {
                $query->where('user_id', $order_utama->user_id);
            })->get();
        }

        return view('frontend.riwayat_pesanan.index', [
            'transactions' => Transaction::where('user_id', $id)->get(),
            'notif' => $notif,
            'order_items' => $order_items
        ]);
    }

}

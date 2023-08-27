<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $products = Product::findOrFail($id);
        $reviews = Review::whereHas('orderItem', function ($query) use ($id) {
            $query->where('product_id', $id);
        })->get();
        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $user = Auth::check();
        if ($user == false) {
            $notif = 0;
        } else if ($order_utama) {
            $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();
        } else {
            $notif = 0;
        }

        // dd($products);
        return view('frontend.pesan.index', [
            'products' => $products,
            'notif' => $notif,
            'reviews' => $reviews  
                      
        ]);
    }

    public function order(Request $request, $id)
    {
        $products = Product::where('id', $id)->first();
        $tanggal = Carbon::now();

        //cek stok
        if ($request->jumlah_order > $products->stock) {
            return redirect('order/' . $id);
        }

        $cek_order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        //database orders
        if (empty($cek_order)) {
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->tanggal = $tanggal;
            $order->status = 0;
            $order->jumlah_harga = 0;
            $order->save();
        } else {
        }

        //database order_items
        $order_baru = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        $cek_order_item = OrderItem::where('product_id', $products->id)->where('order_id', $order_baru->id)->first();

        if (empty($cek_order_item)) {
            $order_item = new OrderItem;
            $order_item->product_id = $products->id;
            $order_item->order_id = $order_baru->id;
            $order_item->jumlah = $request->jumlah_order;
            $order_item->jumlah_harga = $products->price * $request->jumlah_order;
            $order_item->save();
        } else {
            $order_item = OrderItem::where('product_id', $products->id)->where('order_id', $order_baru->id)->first();
            $order_item->jumlah = $order_item->jumlah + $request->jumlah_order;

            //harga sekarang
            $harga_order_item_baru = $products->price * $request->jumlah_order;
            $order_item->jumlah_harga = $order_item->jumlah_harga + $harga_order_item_baru;
            $order_item->update();
        }

        //jumlah total
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $order->jumlah_harga = $order->jumlah_harga + $products->price * $request->jumlah_order;
        $order->update();



        return redirect('home');
    }

    public function cart()
    {

        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if ($order === null) {
            $order_item = ""; // Set order_item ke string kosong
        } else {
            $order_item = OrderItem::where('order_id', $order->id)->get();
        }


        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $user = Auth::check();
        if ($user == false) {
            $notif = 0;
        } else if($order_utama){
            $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();
        }else{
            $notif = 0;
        }

        if ($order === null) {
            $order_item = ""; // Set order_item ke string kosong
        } else {
            $order_item = OrderItem::where('order_id', $order->id)
            ->whereHas('order', function ($query) {
                $query->where('status', 0);
            })
            ->get();
        }
        

        return view('frontend.keranjang.index', compact('order', 'order_item', 'notif'));
    }

    public function checkout()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_item = OrderItem::findOrFail($id);

        $order = Order::where('id', $order_item->order_id)->first();
        $order->jumlah_harga = $order->jumlah_harga - $order_item->jumlah_harga;
        $order->update();

        $order_item->delete();

        return redirect('cart');
    }
}

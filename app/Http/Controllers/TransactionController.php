<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $data = $request->all();
        $user = Auth::user()->id;
        $telephone = $data['telephone'];
        $address = $data['address'];
        $shippingCost = $data['shipping-cost'];
        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();

        User::where('id', $user)->update([
            'telephone' => $telephone,
            'address' => $address
        ]);

        $orders = Order::findOrFail($id);
        $grandTotal = floatval($shippingCost) + floatval($orders->jumlah_harga);

        // Simpan nilai dalam tabel transaction
        $order = Order::where('id', $orders->id)->first();
        if ($order) {
            $order->update(['status' => 1]); // Mengubah status menjadi 1
        }

        Transaction::updateOrCreate(
            [
                'order_id' => $orders->id
            ],[
            'user_id' => Auth::user()->id,
            'status' => 0,
            'total_pembayaran' => $grandTotal,
        ]);

        return redirect('/pembayaran/' . $id);
    }

    public function pembayaran(Request $request, $id)
    {
        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if($order_utama){
            $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();
        }else{
            $notif = 0;
        }
        $data = Transaction::findOrFail($id);
        return view('frontend.pembayaran.index', [
            'notif' => $notif,
            'data' => $data
        ]);
    }

    public function pembayaranProses(Request $request, $id)
    {
        $pembayaran = Transaction::findOrFail($id);
        $order_id = $pembayaran->order_id;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);
        }

        $order = Order::where('id', $order_id)->first();
        if ($order) {
            $order->update(['status' => 1]); // Mengubah status menjadi 1
        }

        $pembayaran->update([
            'image' => $imageName,
            'status' => 1
        ]);

        return redirect('/pesanan-saya')->with('success', 'Pembayaran Berhasil.');
    }



    public function pembayaranSelesai()
    {

        return view('frontend.riwayat_pesanan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

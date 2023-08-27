<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{
    public function index(Request $request, $order_id)
    {
        $order = \App\Models\Order::where('id', $order_id)->first();
        if ($order) {
            $order_items = OrderItem::with('product')
                ->where('order_id', $order_id)
                ->get();
        }

        $order_utama = \App\Models\Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $user = Auth::check();
        if ($user == false) {
            $notif = 0;
        } else if ($order_utama) {
            $notif = \App\Models\OrderItem::where('order_id', $order_utama->id)->count();
        } else {
            $notif = 0;
        }


        // Anda bisa mengambil data yang diperlukan dari $order dan menggunakan dalam tampilan
        return view('frontend.penilaian.index', compact('order', 'order_id', 'notif', 'order_items'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'rating.*' => 'required|integer|min:1|max:5',
            'content.*' => 'required|string',
        ]);

        $user_id = Auth::user()->id;

        foreach ($validatedData['rating'] as $index => $rating) {
            $review = new Review();
            $review->user_id = $user_id;
            $review->order_item_id = $request->order_item_id[$index];
            $review->rating = $rating;
            $review->content = $validatedData['content'][$index];
            $review->save();

            // Update the order status to 3 for each order item
            $orderItem = OrderItem::find($request->order_item_id[$index]);
            if ($orderItem) {
                $transaction = Transaction::where('order_id', $orderItem->order_id)->first();
                if ($transaction) {
                    $transaction->status = 3;
                    $transaction->save();
                }
            }
        }

        Alert::success('Berhasil', 'Profil berhasil diperbarui');
        return redirect('/home');
    }
}

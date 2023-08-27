<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\transaction;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return view('backend.pesanan.konfirmasi.index', [
            'transactions' => Transaction::get()
        ]);
    }

    public function detailDikirim($id)
    {
        
        return view('backend.pesanan.dikirim.detail_dikirim', [
            'order_items' => OrderItem::where('order_id', $id)->get()
            

        ]);
    }

    public function detailKonfirmasi($id)
    {
        return view('backend.pesanan.konfirmasi.detail_konfirmasi', [
            'order_items' => OrderItem::where('order_id', $id)->get()
        ]);
    }

    public function pesananDikirim()
    {
        return view('backend.pesanan.dikirim.index', [
            'transactions' => Transaction::get()
        ]);
    }

    public function pesananDiterima()
    {
        return view('backend.pesanan.diterima.index', [
            'transactions' => Transaction::get()
        ]);
    }

    public function konfirmasiProses($id)
    {
        try {
            // Temukan transaksi berdasarkan ID
            $pembayaran = Transaction::findOrFail($id);
        
            // Update status transaksi menjadi 2
            $pembayaran->update([
                'status' => 2
            ]);
        
            // Mendapatkan informasi pesanan terkait
            $pesanan = $pembayaran->order;
        
            // Mendapatkan daftar item pesanan (order_items)
            $itemsPesanan = $pesanan->orderItems;
            
            foreach ($itemsPesanan as $item) {
                $produk = $item->product;
                $jumlahBeli = $item->jumlah;
                
                if ($produk) {
                    $stokSekarang = $produk->stock - $jumlahBeli;
        
                    // Pastikan stok tidak menjadi negatif
                    if ($stokSekarang >= 0) {
                        $produk->update([
                            'stock' => $stokSekarang
                        ]);
                    } else {
                        return redirect('/konfirmasi-pembayaran')->with('error', 'Stok produk tidak mencukupi.');
                    }
                }
            }
        
            // Redirect kembali ke halaman pesanan dengan pesan sukses
            return redirect('/konfirmasi-pembayaran')->with('success', 'Pesanan Berhasil Dikonfirmasi.');
        } catch (\Exception $e) {
            // Tangani jika terjadi kesalahan, misalnya transaksi tidak ditemukan
            return redirect('/konfirmasi-pembayaran')->with('error', 'Terjadi kesalahan saat mengkonfirmasi pesanan.');
        }
    }
    
}

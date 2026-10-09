<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $keranjang = session()->get('keranjang', []);
        $totalItem = array_sum(array_column($keranjang, 'jumlah'));
        
        return view('shop.index', compact('products', 'totalItem'));
    }

    public function tambahKeranjang(Request $request, $id_barang)
    {
        $product = Product::findOrFail($id_barang);
        $keranjang = session()->get('keranjang', []);

        if ($product->stok <= 0) {
            return back()->with('error', 'Stok barang habis!');
        }

        if (isset($keranjang[$id_barang])) {
            if ($keranjang[$id_barang]['jumlah'] < $product->stok) {
                $keranjang[$id_barang]['jumlah']++;
            } else {
                return back()->with('error', 'Jumlah di keranjang melebihi stok!');
            }
        } else {
            $keranjang[$id_barang] = [
                'id_barang' => $id_barang,
                'jumlah' => 1
            ];
        }

        session()->put('keranjang', $keranjang);
        return back()->with('success', 'Berhasil ditambahkan ke keranjang!');
    }

    public function keranjang()
    {
        $keranjangSession = session()->get('keranjang', []);
        $keranjang = [];
        $totalHarga = 0;

        foreach ($keranjangSession as $id_barang => $item) {
            $product = Product::find($id_barang);
            if ($product) {
                $subtotal = $product->harga * $item['jumlah'];
                $totalHarga += $subtotal;
                
                $keranjang[] = [
                    'id_barang' => $id_barang,
                    'nama_barang' => $product->nama_barang,
                    'harga' => $product->harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal,
                    'stok' => $product->stok
                ];
            }
        }

        return view('shop.keranjang', compact('keranjang', 'totalHarga'));
    }

    public function updateKeranjang(Request $request, $id_barang)
    {
        $keranjang = session()->get('keranjang', []);
        $product = Product::find($id_barang);
        
        if (isset($keranjang[$id_barang]) && $product) {
            if ($request->aksi == 'tambah') {
                if ($keranjang[$id_barang]['jumlah'] < $product->stok) {
                    $keranjang[$id_barang]['jumlah']++;
                } else {
                    return back()->with('error', 'Jumlah tidak boleh melebihi stok!');
                }
            } elseif ($request->aksi == 'kurang') {
                $keranjang[$id_barang]['jumlah']--;
                if ($keranjang[$id_barang]['jumlah'] <= 0) {
                    unset($keranjang[$id_barang]); 
                }
            }
            session()->put('keranjang', $keranjang);
        }
        return back();
    }

    public function hapusKeranjang($id_barang)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id_barang])) {
            unset($keranjang[$id_barang]);
            session()->put('keranjang', $keranjang);
        }
        return back();
    }

    public function checkout(Request $request)
    {
        $keranjang = session()->get('keranjang', []);
        
        if (empty($keranjang)) {
            return back()->with('error', 'Keranjang Anda masih kosong!');
        }

        DB::beginTransaction();
        try {
            $id_order = 'ORD-' . Str::upper(Str::random(5));
            $total_harga = 0;

            foreach ($keranjang as $id_barang => $item) {
                $product = Product::find($id_barang);
                $total_harga += ($product->harga * $item['jumlah']);
            }

            Order::create([
                'id_order' => $id_order,
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $total_harga,
                'alamat_pengiriman' => Auth::user()->alamat,
            ]);

            foreach ($keranjang as $id_barang => $item) {
                $product = Product::find($id_barang);
                
                OrderDetail::create([
                    'id_order' => $id_order,
                    'id_barang' => $id_barang,
                    'harga_satuan' => $product->harga,
                    'jumlah_beli' => $item['jumlah']
                ]);

                $product->stok -= $item['jumlah'];
                $product->save();
            }

            session()->forget('keranjang');
            
            DB::commit(); 

            return redirect('/riwayat')->with('success', 'Checkout berhasil! Pesanan Anda telah diproses.');
        } catch (\Exception $e) {
            DB::rollBack(); 
            return back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $orders = Order::where('id_user', Auth::user()->id_user)
                       ->orderBy('tanggal_order', 'desc')
                       ->get();
                       
        return view('shop.riwayat', compact('orders'));
    }
}
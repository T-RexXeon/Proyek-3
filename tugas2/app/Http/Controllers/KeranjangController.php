<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class KeranjangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        
        $keranjang = session('keranjang', []);
        
        $totalItem = array_sum(array_column($keranjang, 'jumlah'));

        return view('index', compact('barang', 'totalItem'));
    }
    public function tambah($id)
    {
        $barang = Barang::findOrFail($id);

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'id' => $id,
                'jumlah' => 1
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->back();
    }
    public function keranjang()
    {
        $keranjangSession = session()->get('keranjang', []);
        
        $keranjang = [];
        $totalHarga = 0;

        foreach ($keranjangSession as $id => $item) {
            $barang = Barang::find($id);
            if ($barang) {
                $subtotal = $barang->harga * $item['jumlah'];
                $totalHarga += $subtotal;
                
                $keranjang[] = [
                    'id' => $id,
                    'nama' => $barang->nama,
                    'harga' => $barang->harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $subtotal
                ];
            }
        }

        return view('keranjang', compact('keranjang', 'totalHarga'));
    }

    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        
        if (isset($keranjang[$id])) {
            if ($request->aksi == 'tambah') {
                $keranjang[$id]['jumlah']++;
            } elseif ($request->aksi == 'kurang') {
                $keranjang[$id]['jumlah']--;
                
                if ($keranjang[$id]['jumlah'] <= 0) {
                    unset($keranjang[$id]);
                }
            }
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back();
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        return redirect()->back();
    }

    public function kosongkan()
    {
        session()->forget('keranjang');
        return redirect()->back();
    }
}
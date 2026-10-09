<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; 

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id_barang' => 'BRG001', 'nama_barang' => 'Laptop ASUS ROG', 'deskripsi' => 'Laptop gaming performa tinggi.', 'harga' => 15000000, 'stok' => 10, 'gambar' => 'asus.jpg'],
            ['id_barang' => 'BRG002', 'nama_barang' => 'Mouse Logitech', 'deskripsi' => 'Mouse wireless ergonomis.', 'harga' => 250000, 'stok' => 50, 'gambar' => 'mouse.jpg'],
            ['id_barang' => 'BRG003', 'nama_barang' => 'Keyboard Mechanical', 'deskripsi' => 'Keyboard RGB blue switch.', 'harga' => 600000, 'stok' => 30, 'gambar' => 'keyboard.jpg'],
            ['id_barang' => 'BRG004', 'nama_barang' => 'Monitor Samsung 24"', 'deskripsi' => 'Monitor IPS panel 75Hz.', 'harga' => 1800000, 'stok' => 20, 'gambar' => 'monitor.jpg'],
            ['id_barang' => 'BRG005', 'nama_barang' => 'Headset Gaming', 'deskripsi' => 'Headset 7.1 surround sound.', 'harga' => 450000, 'stok' => 25, 'gambar' => 'headset.jpg'],
            ['id_barang' => 'BRG006', 'nama_barang' => 'Flashdisk 64GB', 'deskripsi' => 'Flashdisk USB 3.0 cepat.', 'harga' => 85000, 'stok' => 100, 'gambar' => 'flashdisk.jpg'],
            ['id_barang' => 'BRG007', 'nama_barang' => 'Hardisk Eksternal 1TB', 'deskripsi' => 'Penyimpanan eksternal portabel.', 'harga' => 900000, 'stok' => 15, 'gambar' => 'hdd.jpg'],
            ['id_barang' => 'BRG008', 'nama_barang' => 'Mousepad Gaming', 'deskripsi' => 'Mousepad lebar anti slip.', 'harga' => 50000, 'stok' => 80, 'gambar' => 'mousepad.jpg'],
            ['id_barang' => 'BRG009', 'nama_barang' => 'Webcam 1080p', 'deskripsi' => 'Webcam untuk streaming dan meeting.', 'harga' => 350000, 'stok' => 40, 'gambar' => 'webcam.jpg'],
            ['id_barang' => 'BRG010', 'nama_barang' => 'Kabel HDMI 2 Meter', 'deskripsi' => 'Kabel HDMI kualitas terbaik.', 'harga' => 35000, 'stok' => 60, 'gambar' => 'hdmi.jpg'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
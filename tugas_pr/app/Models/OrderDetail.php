<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id_order', 'id_barang', 'harga_satuan', 'jumlah_beli'
    ];
}
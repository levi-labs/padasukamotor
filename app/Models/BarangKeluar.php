<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar';
    protected $fillable = ['barang_masuk_id', 'cart_id', 'qty', 'tanggal'];
    public $timestamps = false;


    public function barangmasuks()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id', 'id');
    }

    public function carts()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
}

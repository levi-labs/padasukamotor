<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';

    public $timestamps = false;

    public function suppliers(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function barangs(){
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}

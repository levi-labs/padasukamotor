<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table    = 'cart';

    public $timestamps = false;

    public function barangs()
    {

        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function barangmasuks()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_masuk_id', 'id');
    }

    public function getInvoice()
    {




        $date = Carbon::now()->format('dm');
        $user = Cart::count();

        if ($user == 0) {
            $antrian = 00001;
            $nomor = 'TR-' . $date . sprintf('%05s', $antrian);
        } else {
            $last = Cart::all()->last();
            $urut = (int)substr($last->invoice, -5) + 1;

            $nomor = 'TR-' . $date  . sprintf('%05s', $urut);
        }

        return $nomor;
    }
}

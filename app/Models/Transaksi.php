<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'cart';

    public $timestamps = false;


    public function barangs(){

        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

     public function getInvoice(){



        $date = Carbon::now()->format('dm');
        $user = Transaksi::count();

        if ($user == 0) {
            $antrian = 00001;
            $nomor = 'TR-' . $date . sprintf('%05s', $antrian);
        } else {
            $last = Transaksi::all()->last();
            $urut = (int)substr($last->invoice, -5) + 1;

            $nomor = 'TR-' . $date  . sprintf('%05s', $urut);
        }

        return $nomor;
        }

}

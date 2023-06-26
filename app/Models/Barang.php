<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
      public function getKodeBarang(){



        $date = Carbon::now()->format('dm');
        $user = Barang::count();

        if ($user == 0) {
            $antrian = 00001;
            $nomor = 'BRG-' . $date . sprintf('%05s', $antrian);
        } else {
            $last = Barang::all()->last();
            $urut = (int)substr($last->kode_barang, -5) + 1;

            $nomor = 'BRG-' . $date  . sprintf('%05s', $urut);
        }

        return $nomor;
        }
     public function kategoris(){

        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
     }

     public function getFoto(){

        return '/storage/'. $this->foto;
     }
}

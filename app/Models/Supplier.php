<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    public $timestamps = false;

      public function getKodeSupplier(){



        $date = Carbon::now()->format('dm');
        $user = Supplier::count();

        if ($user == 0) {
            $antrian = 00001;
            $nomor = 'SP- ' . $date . sprintf('%05s', $antrian);
        } else {
            $last = Supplier::all()->last();
            $urut = (int)substr($last->kode_supplier, -5) + 1;

            $nomor = 'SP- ' . $date  . sprintf('%05s', $urut);
        }

        return $nomor;
    }
}

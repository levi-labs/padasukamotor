<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $barang = Barang::count();
        $barangmasuk = Barang::count();
        $barangkeluar = Barang::count();
        $brg = Barang::all();
        $dg_brg = [];
        $stock = [];

        foreach ($brg as $key => $value) {
            $dg_brg[] = $value->nama_barang;
            $stock[]  = $value->stock;
        }

        return view('pages.dashboard.index', ['barang' => $barang, 'barangmasuk' => $barangmasuk, 'barangkeluar' => $barangkeluar, 'dg_brg' => $dg_brg, 'stock' => $stock]);
    }

    public function report(Request $request)
    {
        $title =  'Daftar Report';
        $dari = $request->dari;
        $sampai = $request->sampai;

        if (isset($dari) and isset($sampai)) {

            $data = Cart::where('status', 'PAID')->where('qty', '>', 0)->where('tanggal', '>=', $dari)->where('tanggal', '<=', $sampai)->get();
            $total = Cart::where('status', 'PAID')->where('tanggal', '>=', $dari)->where('tanggal', '<=', $sampai)->sum('subtotal');

            return view('pages.report', ['title' => $title, 'data' => $data, 'total' => $total]);
        }
        return view('pages.report', ['title' => $title]);
    }
}

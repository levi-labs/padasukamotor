<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title  = 'Pilih Daftar Belanja';
        $barang = Barang::all();
        $tr     = new Transaksi();

        $invoice = $tr->getInvoice();

        return view('pages.transaksi.index', ['title' => $title, 'data' => $barang, 'invoice' => $invoice]);
    }

    public function transaksiBerlangsung()
    {
        $title = 'Daftar Transaksi-Berlangsung';
        // $detail = 
        $data = DB::table('cart')->select('tanggal', 'invoice')->where('status', 'UNPAID')->groupBy('invoice', 'tanggal')->get();

        return view('pages.transaksi.berlangsung', ['title' => $title, 'data' => $data]);
    }

    public function transaksiBerhasil()
    {
        $title = 'Daftar Transaksi-Berhasil';
        $data = DB::table('cart')->select('tanggal', 'invoice')->where('status', 'PAID')->groupBy('invoice', 'tanggal')->get();

        return view('pages.transaksi.berhasil', ['title' => $title, 'data' => $data]);
    }

    public function detailTransaksi($invoice)
    {
        $title = 'Detail Transaksi';
        $customer = Cart::where('invoice', $invoice)->first();
        $total = Cart::where('invoice', $invoice)->sum('subtotal');
        $data = Cart::where('invoice', $invoice)->where('qty', '>', 0)->get();
        $status = Cart::where('invoice', $invoice)->first();

        return view('pages.transaksi.detail', ['title' => $title, 'data' => $data, 'total' => $total, 'invoice' => $invoice, 'customer' => $customer, 'info' => $status]);
    }

    public function paidTransaksi($invoice)
    {
        try {

            Cart::where('invoice', $invoice)->where('status', 'UNPAID')->update([
                'status' => 'PAID'
            ]);
            return back()->with('success', 'Transaksi berhasil di approve...!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function unpaidTransaksi($invoice)
    {
        try {

            Cart::where('invoice', $invoice)->where('status', 'PAID')->update([
                'status' => 'UNPAID'
            ]);
            return back()->with('success', 'Transaksi berhasil di cancel...!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }


    public function addItem($id)
    {
        try {
            $item = Barang::where('id', $id)->first();
            $transaksi              = new Transaksi();
            $transaksi->barang_id   = $id;
            $transaksi->qty         = 1;
            $transaksi->harga       = $item->harga;
            $transaksi->subtotal    = $item->harga * $transaksi->qty;
            $transaksi->tanggal     = Carbon::now();
            $transaksi->status      = 'UNPAID';
            $transaksi->save();

            return back()->with('success', 'Barang Berhasil dipilih...!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title      = 'Keranjang Transaksi';
        $barang     = Barang::all();

        return view('pages.transaksi.tambah', ['title' => $title, 'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $barang  = 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}

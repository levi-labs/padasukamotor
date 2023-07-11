<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Pilih Customer';
        $customers  = Customer::all();

        return view('pages.cart.index', ['title' => $title, 'data' => $customers]);
    }

    public function addTransaksi($id)
    {
        $title      = 'Buat Transaksi';
        $customer   = Customer::where('id', $id)->first();
        $barang     = Barang::all();
        $invoice    = new Cart();
        $cart       = Cart::where('customer_id', $id)->where('status', 'UNPAID')->get();
        $total      = Cart::where('customer_id', $id)->where('status', 'UNPAID')->sum('subtotal');
        return view('pages.cart.tambah', [
            'title' => $title,
            'customers' => $customer,
            'barang' => $barang,
            'cart' => $cart,
            'total' => $total,
            'invoice' => $invoice->getInvoice()
        ]);
    }

    public function cart(Request $request)
    {
        $title      = 'Buat Transaksi';
        $customers  = Customer::where('id', $request->customer)->first();
        $barang     = Barang::all();
        $cart       = Cart::where('customer_id', $request->customer)->get();
        $invoice = new Cart();


        $total  = Cart::where('customer_id', $request->customer)->sum('subtotal');

        return view('pages.cart.tambah', [
            'title' => $title,
            'customers' => $customers,
            'barang' => $barang,
            'cart' => $cart,
            'total' => $total,
            'invoice' => $invoice->getInvoice()
        ]);
    }

    public function addItem(Request $request, $id, $customerid)
    {
        try {
            $item = Barang::where('id', $id)->first();
            $cart              = new Cart();
            $defaultValue = 1;
            $barangMasuk       = BarangMasuk::where('barang_id', $id)
                ->where('qty', '>', '0')
                ->orderBy('tanggal', 'asc')
                ->first();

            $cek = Cart::where('customer_id', $customerid)->where('status', 'UNPAID')->first();

            if ($defaultValue < $item->stock) {
                $temp = $defaultValue;
                if ($cek != null) {
                    $cart->invoice = $cek->invoice;
                } else {
                    $cart->invoice = $cart->getInvoice();
                }
                $cart->customer_id = $customerid;
                $cart->barang_id   = $id;
                $cart->qty         = $temp;
                $cart->harga       = $item->harga;
                $cart->subtotal    = $item->harga * $cart->qty;
                $cart->tanggal     = Carbon::now();
                $cart->status      = 'UNPAID';
                $cart->save();

                BarangKeluar::insert([
                    'barang_masuk_id' => $barangMasuk->id,
                    'cart_id'         => $cart->id,
                    'qty'             => $defaultValue,
                    'tanggal'         => Carbon::now()
                ]);
                BarangMasuk::where('id', $barangMasuk->id)->update([
                    'qty' => $barangMasuk->qty - $defaultValue
                ]);
                Barang::where('id', $id)->update([
                    'stock' => $item->stock - $defaultValue
                ]);
            }



            return back()->with('success', 'Barang Berhasil dipilih...!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function updateItem(Request $request, $id, $customerid)
    {
        // dd($id);
        try {
            $cart = Cart::where('id', $id)->where('customer_id', $customerid)->first();
            $qty = $request->qty;
            for ($i = 0; $i < count($qty); $i++) {
                $cart->qty = $qty[$i];
                $cart->update();
            }



            return back()->with('success', 'Berhasil di ubah...!');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    public function checkOut(Request $request, $customerid)
    {
        try {
            $qty        = $request->qty;
            $c_id       = $request->cart_id;
            $harga      = $request->harga;
            $barang_id  = $request->barang_id;

            $barangAll  = Barang::all();
            //loop->for find 
            for ($x = 0; $x < count($c_id); $x++) {
                $barangID   = Barang::where('id', $barang_id[$x])->first();

                if ($qty[$x] < $barangID->stock) {
                    $outItem                = BarangKeluar::where('cart_id', $c_id[$x])->first();
                    // $getBarangMasuk      = BarangMasuk::where('id', $outItem->barang_masuk_id)->first();
                    // $getBarangKeluar     = BarangKeluar::where('barang_Masuk_id', $getBarangMasuk->id)->first();
                    $tempOUtStock           = BarangKeluar::where('cart_id', $c_id[$x])->orderBy('tanggal', 'asc')->get();

                    // dd($tempOUtStock);
                    foreach ($tempOUtStock as $key => $value) {
                        $getBarangMasuk     = BarangMasuk::where('id', $value->barang_masuk_id)->first();
                        $tempstockmasuk     = $getBarangMasuk->qty + $value->qty;
                        $tempstockGudang    = $barangID->stock + $value->qty;
                        // dd($tempstockmasuk);
                        $barangID->stock    = $tempstockGudang;
                        BarangMasuk::where('id', $value->barang_masuk_id)->update([
                            'qty' => $tempstockmasuk
                        ]);
                    }
                    $getItemBefore = Cart::where('id', $c_id[$x])->first();
                    $tempoldStock  = $getItemBefore->qty;

                    $newItem = BarangMasuk::where('barang_id', $barang_id[$x])
                        ->where('qty', '>', '0')
                        ->orderBy('tanggal', 'asc')
                        ->get();

                    Cart::where('id', $c_id[$x])->update([
                        'invoice'   => $request->invoice,
                        'qty'       => $qty[$x],
                        'subtotal'  => $harga[$x] * $qty[$x]
                    ]);

                    Barang::where('id', $barang_id[$x])->update([
                        'stock'     => $barangID->stock - $qty[$x]
                    ]);

                    foreach ($newItem as $key => $nt) {
                        BarangKeluar::where('barang_masuk_id', $nt->id)->update([
                            'qty'  => 0
                        ]);

                        // $nt->qty += $tempoldStock;
                        if ($qty[$x] > 0) {
                            $temp[$x]   = $qty[$x];
                            $qty[$x]    = $qty[$x] - $nt->qty;
                            // dd($qty[$x]);

                            if ($qty[$x] > 0) {

                                // BarangKeluar::where('barang_masuk_id', $nt->id)->update([
                                //     'qty' => $tempstockmasuk
                                // ]);
                                $itm = BarangKeluar::where('barang_masuk_id', $nt->id)->count();
                                // BarangKeluar::where('barang_masuk_id', $nt->id)->where('qty', '=', 0)->delete();

                                if ($itm > 0) {
                                    BarangKeluar::where('barang_masuk_id', $nt->id)->update([
                                        'cart_id'         => $c_id[$x],
                                        'qty'             => $tempstockmasuk / 2,
                                        'tanggal'         => Carbon::now()
                                    ]);
                                } else {
                                    BarangKeluar::create([
                                        'barang_masuk_id' => $nt->id + 1,
                                        'cart_id'         => $c_id[$x],
                                        'qty'             => $qty[$x],
                                        'tanggal'         => Carbon::now()
                                    ]);
                                }
                                $new_stock = 0;
                            } else {


                                BarangKeluar::where('barang_masuk_id', $nt->id)->update([
                                    'qty' => $temp[$x]
                                ]);
                                // BarangKeluar::where('barang_masuk_id', $nt->id)->where('qty', '=', 0)->delete();


                                $new_stock = $nt->qty - $temp[$x];
                            }

                            // BarangKeluar::where
                            BarangMasuk::where('id', $nt->id)->update([
                                'qty' => $new_stock
                            ]);
                        }
                    }
                } else {
                    $error  = 'stock ' . $barangID->nama_barang . ' tidak mencukupi';
                    return back()->with('failed', $error);
                }
            }
            return back()->with('success', 'Data berhasil diupdate...!');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}

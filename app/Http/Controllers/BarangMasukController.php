<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title   = 'Daftar Barang Masuk';
        $data    = BarangMasuk::all();

        return view('pages.barangmasuk.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title      = 'Form Tambah Barang Masuk';

        $supplier   = Supplier::all();
        $barang     = Barang::all();

        return view('pages.barangmasuk.tambah', ['title' => $title, 'supplier' => $supplier,'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier'   => 'required',
            'barang'     => 'required',
            'qty'           => 'required',
            'harga'         => 'required',
            'tanggal'       => 'required'
        ]);

        try {
            $barangMasuk                =  new BarangMasuk();
            $barangMasuk->supplier_id   = $request->supplier;
            $barangMasuk->barang_id     = $request->barang;
            $barangMasuk->qty           = $request->qty;
            $barangMasuk->harga         = $request->harga;
            $barangMasuk->tanggal       = $request->tanggal;
            $barangMasuk->save();

            $barang = Barang::where('id', $barangMasuk->barang_id)->first();
            $barang->stock += $barangMasuk->qty;
            $barang->update();

            return redirect('daftar-barang-masuk')->with('success','Barang Masuk berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang-masuk')->with('failed',$e->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(BarangMasuk $barangMasuk)
    {
          return view('pages.barangmasuk.detail', ['title' => 'Detail Barang' , 'barangMasuk' => $barangMasuk]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        $title      = 'Form Edit Barang Masuk';
        $supplier   = Supplier::all();
        $barang     = Barang::all();

        return view('pages.barangmasuk.edit', 
                                        [
                                                'title' => $title,
                                                'supplier' => $supplier, 
                                                'barang' => $barang, 
                                                'barangMasuk' => $barangMasuk
                                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $request->validate([
            'supplier'       => 'required',
            'barang'         => 'required',
            'qty'            => 'required',
            'harga'          => 'required',
            'tanggal'        => 'required'
        ]);
        try {
            
            $barangMasuk->supplier_id   = $request->supplier;
            $barangMasuk->barang_id     = $request->barang;
            
            $barangMasuk->harga         = $request->harga;
            $barangMasuk->tanggal       = $request->tanggal;
            

            $barang = Barang::where('id', $barangMasuk->barang_id)->first();
            $tempStock = (int)$barang->stock - (int)$barangMasuk->qty;
        
            $barangMasuk->qty           = $request->qty;
            $barangMasuk->update();
     
      
            $tempStock  += $barangMasuk->qty;
            $barang->stock = $tempStock;
          
            $barang->update();
           

            return redirect('daftar-barang-masuk')->with('success','Barang Masuk berhasil diupdate...!');
        } catch (\Exception $e) {
             return redirect('daftar-barang-masuk')->with('failed',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BarangMasuk  $barangMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        $barang = Barang::where('id', $barangMasuk->barang_id)->first();
        $barang->stock = $barang->stock - $barangMasuk->qty;
        $barang->update();
        $barangMasuk->delete();

        return back()->with('success', 'Barang Masuk berhasil dihapus...!');
    }
}

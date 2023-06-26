<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Supplier';
        $data = Supplier::all();


        return view('pages.supplier.index', ['title' =>  $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Tambah Supplier';
        $supplier = new Supplier();
        $kodeSupplier = $supplier->getKodeSupplier();

        return view('pages.supplier.tambah', ['title' => $title , 'supplier' => $kodeSupplier]);
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
            'nama_supplier' => 'required',
            'no_hp'         => 'required',
            'email'         => 'required',
            'alamat'        => 'required'
        ]);

        $supplier = new Supplier();
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->kode_supplier = $supplier->getKodeSupplier();
        $supplier->no_hp         = $request->no_hp;
        $supplier->email         = $request->email;
        $supplier->alamat        = $request->alamat;
        $supplier->save();

        return redirect('daftar-supplier')->with('success','Supplier Berhasil ditambahkan...!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $title = 'Form Edit Supplier';

        return view('pages.supplier.edit', ['title' => $title, 'supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
           $request->validate([
            'nama_supplier' => 'required',
            'no_hp'         => 'required',
            'email'         => 'required',
            'alamat'        => 'required'
        ]);

        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->no_hp         = $request->no_hp;
        $supplier->email         = $request->email;
        $supplier->alamat        = $request->alamat;
        $supplier->update();

        return redirect('daftar-supplier')->with('success','Supplier Berhasil diupdate...!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back()->with('success', 'Supplier Berhasil dihapus...!');
    }
}

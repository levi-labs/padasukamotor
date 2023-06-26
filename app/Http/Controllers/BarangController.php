<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Daftar Barang';
        $data = Barang::all();

        return view('pages.barang.index', ['title' => $title, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Form Tambah Barang';
        $kategori = Kategori::all();
        $barang = new Barang();


        return view('pages.barang.tambah', ['title' => $title, 'kategori' => $kategori, 'kodebarang' => $barang->getKodeBarang()]);
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
            'nama_barang' => 'required',
            'satuan'      => 'required',
            // 'jumlah'      => 'required',
            'harga'       => 'required',
            'kategori'    => 'required',
        ]);

        try {
            $barang                 = new Barang();
            $barang->nama_barang    = $request->nama_barang;
            $barang->kode_barang    = $barang->getKodeBarang();
            $barang->satuan         = $request->satuan;
            $barang->stock          = 0;
            // $request->jumlah
            $barang->harga          = $request->harga;
            $barang->kategori_id    = $request->kategori;

            $imgFoto = $request->file('foto');
            if ($imgFoto) {
                $fileNama = $request->nama_barang . ' ' . $imgFoto->getClientOriginalName();
                $path = $imgFoto->storeAs('images', $fileNama);
                $barang->foto = $path;
            }
            $barang->save();

            return redirect('daftar-barang')->with('success', 'Barang berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {

        return view('pages.barang.detail', ['title' => 'Detail Barang', 'barang' => $barang]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $kategori = Kategori::all();
        return view('pages.barang.edit', ['title' => 'Form Edit Barang', 'barang' => $barang, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required',
            'satuan'      => 'required',
            // 'jumlah'      => 'required',
            'harga'       => 'required',
            'kategori'    => 'required',
        ]);

        try {
            $barang->nama_barang    = $request->nama_barang;
            $barang->satuan         = $request->satuan;
            // $barang->stock          = $request->jumlah;
            $barang->harga          = $request->harga;
            $barang->kategori_id    = $request->kategori;

            $imgFoto = $request->file('foto');
            if ($imgFoto) {
                if ($barang->foto != null) {
                    Storage::delete($barang->foto);
                }
                $fileNama = $request->nama_barang . ' ' . $imgFoto->getClientOriginalName();
                $path = $imgFoto->storeAs('images', $fileNama);
                $barang->foto = $path;
            } else {
                $path = $barang->foto;
            }
            $barang->save();

            return redirect('daftar-barang')->with('success', 'Barang berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('daftar-barang')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return back()->with('success', 'Barang Berhasil dihapus...!');
    }
}

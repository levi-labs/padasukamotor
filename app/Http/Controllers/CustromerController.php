<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustromerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Form Tambah Customer";

        return view('pages.customers.tambah', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_customer' => 'required',
            'no_hp'         => 'required'
        ]);
        try {
            $customer                    = new Customer();
            $customer->nama_customer     = $request->nama_customer;
            $customer->no_hp             = $request->no_hp;
            $customer->save();

            return redirect('buat-cart')->with('success', 'Customers berhasil ditambahkan...!');
        } catch (\Exception $e) {
            return redirect('buat-cart')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $title = 'Form Edit Customer';

        return view('pages.customers.edit', ['title' => $title, 'customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'nama_customer'  =>  'required',
            'no_hp'          => 'required'
        ]);

        try {
            $customer->nama_customer = $request->nama_customer;
            $customer->no_hp         = $request->no_hp;
            $customer->save();

            return redirect('buat-cart')->with('success', 'Customer berhasil diupdate...!');
        } catch (\Exception $e) {
            return redirect('buat-cart')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

@extends('layout.master')
@section('content')
    <div class="pagetitle d-print-none">
        <h1>{{ $title }} </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row d-print-none">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-end">
                            <div class="col-md-9">
                                @php
                                    $cekinvoice = \App\Models\Cart::where('customer_id', $customers->id)
                                        ->where('status', 'UNPAID')
                                        ->first();
                                    
                                @endphp
                                <h5 class="card-title">{{ $cekinvoice->invoice ?? $invoice }}</h5>
                            </div>
                            <div class="col-md-3 ">
                                <h5 class="card-title"> Nama Customer : {{ $customers->nama_customer }}</h5>
                            </div>
                        </div>
                        <style>
                            .datatable-dropdown {
                                font-size: 14px;
                            }

                            input[type='number'] {
                                width: 50px;
                            }

                            input[type='search'] {
                                width: 200px;
                                height: 30px;
                            }

                            .datatable-info {
                                display: none;
                            }
                        </style>


                        {{-- <h5 class="card-title">Basic Modal</h5> --}}
                        <!-- Basic Modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#basicModal">
                            Pilih Barang
                        </button>
                        <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Basic Modal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Table with stripped rows -->
                                        <table class="table datatable" style="font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    {{-- <th scope="col">No</th> --}}
                                                    <th scope="col">Kode Barang</th>
                                                    <th scope="col">Nama Barang</th>
                                                    <th scope="col">Stock</th>


                                                    <th scope="col">Option</th>
                                                </tr>
                                            </thead>



                                            <tbody>
                                                @foreach ($barang as $dt)
                                                    <tr>
                                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                                        <td>{{ $dt->kode_barang }}</td>
                                                        <td>{{ $dt->nama_barang }}</td>

                                                        {{-- <td><input type="number" name="qty[]"></td> --}}
                                                        <td> @currency($dt->harga)</td>

                                                        <td class="text-sm">
                                                            @php
                                                                $existcart = \App\Models\Cart::where('barang_id', $dt->id)
                                                                    ->where('customer_id', $customers->id)
                                                                    ->where('status', 'UNPAID')
                                                                    ->count();
                                                            @endphp
                                                            @if ($existcart == null)
                                                                <a class="btn btn-info btn-sm"
                                                                    href="{{ url('pilih-barang/' . $dt->id . '/' . $customers->id) }}">Pilih</a>
                                                            @else
                                                                <a class="btn btn-info btn-light" href="#">Pilih</a>
                                                            @endif

                                                            {{-- <a class="btn btn-warning btn-sm"
                                                                href="{{ url('edit-barang/' . $dt->id) }}">Edit</a>
                                                            <a class="btn btn-danger btn-sm"
                                                                href="{{ url('delete-barang/' . $dt->id) }}"
                                                                onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>


                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div><!-- End Basic Modal-->



                        {{-- <form action="{{ url('post-checkout/' . $customers->id) }}" method="GET">
                            @csrf --}}
                        <table class="table table-hover" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>

                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>

                                    <th scope="col">SubTotal</th>
                                    <th scope="col">Qty</th>
                                    {{-- <th scope="col">Option</th> --}}
                                </tr>
                            </thead>



                            <tbody>
                                <form action="{{ url('post-checkout/' . $customers->id) }}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $invoice }}" name="invoice">
                                    @foreach ($cart as $ct)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $ct->barangs->kode_barang }}</td>
                                            <td>{{ $ct->barangs->nama_barang }}</td>

                                            <td>{{ $ct->qty }}</td>
                                            <td> @currency($ct->barangs->harga)</td>
                                            <td>@currency($ct->subtotal)</td>
                                            <td>
                                                <input type="hidden" name="cart_id[]" value="{{ $ct->id }}">
                                                <input type="hidden" name="barang_id[]" value="{{ $ct->barang_id }}">
                                                <input type="hidden" name="harga[]" value="{{ $ct->barangs->harga }}">
                                                <input type="number" name=qty[] min="0" width="30px"
                                                    value="{{ $ct->qty }}">
                                            </td>
                                            <td class="text-sm">
                                                {{-- <a class="btn btn-info btn-sm"
                                                    href="{{ url('pilih-barang/' . $dt->id . '/' . $customers->id) }}">Pilih</a>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ url('update-cart/' . $ct->id . '/' . $customers->id) }}"><i
                                                        class="bi bi-check2"></i></a> --}}
                                                {{-- <a class="btn btn-danger btn-sm"
                                                    href="{{ url('delete-cart/' . $ct->id . '/' . $customers->id) }}"><i
                                                        class="bi bi-x-lg"></i></a> --}}

                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">TOTAL </td>
                                        <td colspan="3" class="text-start">:@currency($total)</td>

                                    </tr>

                            </tbody>
                        </table>
                        <div class="row justify-content-between">
                            <div class="col-md-3 ">

                            </div>
                            <div class="col-md-9 text-end ">

                                <button class="btn btn-primary btn-sm" type="submit">
                                    CheckOut
                                </button>

                            </div>
                        </div>

                        </form>



                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
        @isset($cart)
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-end">
                                <div class="col-md-9">
                                    @php
                                        $cekinvoice = \App\Models\Cart::where('customer_id', $customers->id)
                                            ->where('status', 'UNPAID')
                                            ->first();
                                        
                                    @endphp
                                    <h5 class="card-title">{{ $cekinvoice->invoice ?? $invoice }}</h5>
                                </div>
                                <div class="col-sm-3 text-sm">
                                    <p class="card-title text-sm"> Nama Customer : {{ $customers->nama_customer }}</p>
                                </div>
                            </div>
                            <style>
                                .datatable-dropdown {
                                    font-size: 14px;
                                }

                                input[type='number'] {
                                    width: 50px;
                                }

                                input[type='search'] {
                                    width: 200px;
                                    height: 30px;
                                }

                                .datatable-info {
                                    display: none;
                                }
                            </style>



                            <table class="table table-hover" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Nama Barang</th>

                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>

                                        <th scope="col">SubTotal</th>
                                        <th scope="col">Qty</th>
                                        {{-- <th scope="col">Option</th> --}}
                                    </tr>
                                </thead>



                                <tbody>


                                    @foreach ($cart as $ct)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $ct->barangs->kode_barang }}</td>
                                            <td>{{ $ct->barangs->nama_barang }}</td>

                                            <td>{{ $ct->qty }}</td>
                                            <td> @currency($ct->barangs->harga)</td>
                                            <td>@currency($ct->subtotal)</td>
                                            <td>{{ $ct->qty }}</td>


                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">TOTAL </td>
                                        <td colspan="3" class="text-start">:@currency($total)</td>

                                    </tr>

                                </tbody>
                            </table>
                            <div class="row justify-content-between">
                                <div class="col-md-3 ">

                                </div>
                                <div class="col-md-9 text-end ">

                                    <a href="#" onclick="window.print()" class="btn btn-secondary btn-sm d-print-none"
                                        type="submit">
                                        Print
                                    </a>

                                </div>
                            </div>





                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        @endisset

    </section>
@endsection

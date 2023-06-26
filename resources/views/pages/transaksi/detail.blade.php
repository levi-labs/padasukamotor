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
        <style>
            @media print {
                img {
                    width: 70px;
                    height: 70px;
                }
            }
        </style>

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-end mt-2">
                            <div class="col-md-9">
                                <p class=" text-sm">invoice : {{ $invoice }}</p>
                                <h3 class="text-sm mt-2" style="font-size: 12px;"> Nama Customer :
                                    {{ $customer->customers->nama_customer }}</h3>

                            </div>
                            <div class="col-sm-3 text-sm text-end">
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('Nama Customer: ' . $customer->customers->nama_customer . '|' . ' Invoice: ' . $invoice, 'QRCODE') }}"
                                    width="100" height="80" alt="{{ $invoice }}">

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



                        <table class="table table-hover mt-4" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>

                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>

                                    <th scope="col">SubTotal</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Tanggal</th>
                                    {{-- <th scope="col">Option</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $ct)
                                    @php
                                        $status = $ct->Status;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ct->barangs->kode_barang }}</td>
                                        <td>{{ $ct->barangs->nama_barang }}</td>
                                        <td>{{ $ct->qty }}</td>
                                        <td> @currency($ct->barangs->harga)</td>
                                        <td>@currency($ct->subtotal)</td>
                                        <td>{{ $ct->qty }}</td>
                                        <td>{{ $ct->tanggal }}</td>
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
                                @php
                                    // dd($info->status);
                                @endphp
                                @if ($info->status == 'UNPAID')
                                    <a class="btn btn-success btn-sm"
                                        href="{{ url('transaksi-approve/' . $invoice) }}">Approve</a>
                                @elseif($info->status == 'PAID')
                                    <a class="btn btn-danger btn-sm"
                                        href="{{ url('transaksi-cancel/' . $invoice) }}">Cancel</a>
                                @endif

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


    </section>
@endsection

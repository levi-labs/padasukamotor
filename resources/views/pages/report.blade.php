@extends('layout.master')
@section('content')
    <div class="pagetitle d-print-none">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('daftar-barang-masuk') }}">Daftar Barang Masuk</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-12 ">

                <div class="card d-print-none">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title }}</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                                <ul>
                                    @foreach ($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- General Form Elements -->
                        <form action="{{ url('post-report') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Dari</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="dari">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Sampai</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="sampai">
                                </div>
                            </div>


                            {{-- <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control">
                                </div>
                            </div> --}}




                            <div class="row mb-3 justify-content-md-center">
                                {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                                <div class="col-sm-12 text-sm d-flex">
                                    <button type="submit" class="btn btn-primary mx-1">Submit</button>
                                    <a href="#" class="btn btn-secondary"
                                        onclick="window.location.reload()">Cancel</a>
                                </div>
                                {{-- <div class="col-sm-2 text-sm">

                                </div> --}}
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
                @isset($data)
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Bordered Table</h5> --}}
                            {{-- <p>Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> --}}
                            <!-- Bordered Table -->
                            <style>
                                @media print {
                                    table {
                                        display: block;
                                        width: 100%;
                                    }
                                }
                            </style>
                            <table class="table table-bordered">
                                <a class="btn btn-secondary btn-sm my-4 d-print-none" href="#"
                                    onclick="window.print()">Print</a>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $dt->invoice }}</td>
                                            <td>{{ $dt->barangs->nama_barang }}</td>
                                            <td>{{ $dt->customers->nama_customer }}</td>
                                            <td>{{ $dt->qty }}</td>
                                            <td>@currency($dt->harga)</td>
                                            <td>@currency($dt->subtotal)</td>
                                            <td>{{ $dt->tanggal }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6">Total</td>
                                        <td colspan="2">@currency($total)</td>
                                    </tr>

                                </tbody>
                            </table>
                            <!-- End Bordered Table -->




                        </div>
                    </div>
                @endisset

            </div>
        </div>
    </section>
@endsection

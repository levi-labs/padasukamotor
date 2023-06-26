@extends('layout.master')
@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
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
                <li class="breadcrumb-item"><a href="{{ url('daftar-barang-masuk') }}">Daftar Transaksi Berlangsugn</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">{{ $title }}</h5>


                        <style>
                            /* .datatable-dropdown {
                                                                                                                                                                                        font-size: 24px;
                                                                                                                                                                                    } */
                        </style>
                        <!-- Table with stripped rows -->
                        <table class="table datatable" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Supplier</th>
                                    <th scope="col">No Handphone</th>

                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->nama_customer }}</td>
                                        <td>{{ $dt->no_hp }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="{{ url('transaksi/' . $dt->id) }}">Buat
                                                Transaksi</a>
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-customer/' . $dt->id) }}">Edit Customer</a>
                                            {{-- <a class="btn btn-danger btn-sm" href="{{ url('delete-customer/' . $dt->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this item?');">Hapus
                                                Customer</a> --}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

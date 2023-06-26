@extends('layout.master')
@section('content')
    <div class="pagetitle">
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
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title }}</h5>
                        <a class="btn btn-primary btn-sm ms-2" href="{{ url('tambah-barang') }}"><i
                                class="bi bi-plus-lg"></i>Tambah</a>
                        <style>
                            .datatable-dropdown {
                                font-size: 14px;
                            }
                        </style>
                        <!-- Table with stripped rows -->
                        <table class="table datatable" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga</th>


                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->kode_barang }}</td>
                                        <td>{{ $dt->nama_barang }}</td>
                                        <td>{{ $dt->kategoris->nama_kategori }}</td>
                                        <td>{{ $dt->stock }}</td>
                                        <td> @currency($dt->harga)</td>
                                        <td>
                                            <a class="btn btn-info btn-sm"
                                                href="{{ url('detail-barang/' . $dt->id) }}">Detail</a>
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-barang/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="{{ url('delete-barang/' . $dt->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a>
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

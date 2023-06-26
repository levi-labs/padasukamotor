@extends('layout.master')
@section('content')
    <div class="pagetitle">
        <h1>{{ $title }} </h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
                        <a class="btn btn-primary btn-sm ms-2" href="{{ url('tambah-supplier') }}"><i
                                class="bi bi-plus-lg"></i>Tambah</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable text-sm" style="font-size: 12px;">
                            <thead>
                                <tr class="text-sm">
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">Kode Supplier</th>
                                    <th scope="col">Nama Supplier</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td>{{ $dt->kode_supplier }}</td>
                                        <td>{{ $dt->nama_supplier }}</td>
                                        <td>{{ $dt->no_hp }}</td>
                                        <td>{{ $dt->email }}</td>
                                        <td>{{ $dt->alamat }}</td>
                                        <td class="text-sm">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-supplier/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="{{ url('delete-supplier/' . $dt->id) }}"
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

@extends('layout.master')
@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/daftar-barang') }}">Daftar-Barang</a></li>
                <li class="breadcrumb-item">{{ $title }}</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row align-items-top">
            <div class="col-lg-12">



                <!-- Card with an image on left -->
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4 text-center align-middle mt-5">
                            @if ($barang->foto == null)
                                <img src="{{ asset('/assets/img/no-image.jpg') }}" class="img-fluid rounded-start"
                                    alt="...">
                            @else
                                <img src="{{ $barang->getFoto() }}" class="img-fluid rounded-start" alt="..."
                                    style="max-height: 200px;">
                            @endif

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <h6>Kode Barang</h6>
                                    </div>
                                    <div class="col-lg-9 col-md-8 label">{{ $barang->kode_barang }}</div>

                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <h6>Jumlah Barang</h6>
                                    </div>
                                    <div class="col-lg-9 col-md-8 label">{{ $barang->stock }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <h6>Satuan Barang</h6>
                                    </div>
                                    <div class="col-lg-9 col-md-8 label">{{ $barang->satuan }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <h6>Harga Barang</h6>
                                    </div>
                                    <div class="col-lg-9 col-md-8 label">

                                        @currency($barang->harga)</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <h6>Kategori Barang</h6>
                                    </div>
                                    <div class="col-lg-9 col-md-8 label">
                                        <div class="badge bg-success">{{ $barang->kategoris->nama_kategori }}</div>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-lg-3 col-md-4 label ">
                                        <h6>Barcode Barang</h6>
                                    </div>
                                    <div class="col-lg-9 col-md-8 label">
                                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($barang->kode_barang, 'C39+') }}"
                                            width="200" height="100" alt="{{ $barang->kode_barang }}">
                                    </div>
                                </div>
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card with an image on left -->

            </div>



        </div>
    </section>
@endsection

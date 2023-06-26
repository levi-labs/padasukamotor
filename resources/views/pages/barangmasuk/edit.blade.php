@extends('layout.master')
@section('content')
    <div class="pagetitle">
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

                <div class="card">
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
                        <form action="{{ url('update-barang-masuk/' . $barangMasuk->id) }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Supplier</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="supplier">
                                        <option selected disabled>Pilih Supplier</option>
                                        @foreach ($supplier as $spl)
                                            <option {{ $barangMasuk->supplier_id == $spl->id ? 'selected' : '' }}
                                                value="{{ $spl->id }}">{{ $spl->nama_supplier }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="barang">
                                        <option selected disabled>Pilih Barang</option>
                                        @foreach ($barang as $brg)
                                            <option {{ $barangMasuk->barang_id == $brg->id ? 'selected' : '' }}
                                                value="{{ $brg->id }}">{{ $brg->nama_barang }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Qty</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="qty" min="0"
                                        value="{{ $barangMasuk->qty }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="harga" min="0"
                                        value="{{ $barangMasuk->harga }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal"
                                        value="{{ $barangMasuk->tanggal }}">
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
                                    <a href="{{ url('daftar-barang-masuk') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                                {{-- <div class="col-sm-2 text-sm">

                                </div> --}}
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

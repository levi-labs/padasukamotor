@extends('layout.master')
@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('daftar-kategori') }}">Home</a></li>
                <li class="breadcrumb-item">Forms</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10 ">

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
                        <form action="{{ url('update-barang/' . $barang->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Kode Barang</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="kode_barang"
                                        value="{{ $barang->kode_barang }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_barang"
                                        value="{{ $barang->nama_barang }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Satuan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="satuan" value="{{ $barang->satuan }}">
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="jumlah" min="0"
                                        value="{{ $barang->stock }}">
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="harga" min="0"
                                        value="{{ $barang->harga }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="kategori">
                                        <option selected disabled>Pilih Kategori</option>
                                        @foreach ($kategori as $ktg)
                                            <option {{ $barang->kategori_id == $ktg->id ? 'selected' : '' }}
                                                value="{{ $ktg->id }}">{{ $ktg->nama_kategori }}</option>
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="formFile" name="foto">
                                    <span class="text-danger text-sm">{{ $barang->foto }}</span>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control">
                                </div>
                            </div> --}}




                            <div class="row mb-3">
                                {{-- <label class="col-sm-2 col-form-label">Submit Button</label> --}}
                                <div class="col-sm-10 text-sm">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

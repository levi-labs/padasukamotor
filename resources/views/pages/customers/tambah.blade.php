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
                        <form action="{{ url('post-customer') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Nama Customer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_customer">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">No Hp</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_hp">
                                </div>
                            </div>

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

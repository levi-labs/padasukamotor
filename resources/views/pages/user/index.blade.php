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
                        <a class="btn btn-primary btn-sm ms-2" href="{{ url('tambah-user') }}"><i
                                class="bi bi-plus-lg"></i>Tambah</a>

                        <!-- Table with stripped rows -->
                        <table class="table datatable text-sm" style="font-size: 12px;">
                            <thead>
                                <tr class="text-sm">
                                    {{-- <th scope="col">No</th> --}}
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Akses User</th>

                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $dt)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td>{{ $dt->username }}</td>
                                        <td>{{ $dt->email }}</td>
                                        <td>{{ $dt->no_hp }}</td>
                                        <td>{{ $dt->akses_user }}</td>
                                        <td class="text-sm">
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('edit-user/' . $dt->id) }}">Edit</a>
                                            <a class="btn btn-danger btn-sm" href="{{ url('delete-user/' . $dt->id) }}"
                                                onclick="return confirm('Are you sure you want to delete this item?');">Hapus</a>
                                            <a class="btn btn-info btn-sm " href="{{ url('reset-password/' . $dt->id) }}"
                                                onclick="return confirm('Are you sure you want to Reset Password this item?');">Reset
                                                Password</a>
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

@php
    function rupiah($angka)
    {
        $hasil_rupiah = 'Rp' . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
@endphp

@extends('base.admin')

@section('css')
@endsection

@section('js')
    
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class=" d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title fw-semibold">Manajemen Pengguna</h5>
                                </div>
                                <div class="col ">
                                    <button class="btn btn-primary float-end" data-bs-toggle="modal"
                                        data-bs-target="#addModal">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @if (session('error'))
                            <div class="alert alert-danger fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success fade show" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table id="table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Nomor Telpon</th>
                                    <th>Email</th>
                                    <th>Umur</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($persons as $person)
                                    <tr>
                                        <td>{{ $person->person_name }}</td>
                                        <td>{{ $person->person_phone }}</td>
                                        <td>{{ $person->person_email }}</td>
                                        <td>{{ $person->person_age }}</td>
                                        <td>{{ $person->person_address }}</td>
                                        <td>
                                            <button class="btn m-2 btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $person->person_id }}">Edit</button>
                                            <button class="btn m-2 btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $person->person_id }}">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Tambah Data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/tambah-user" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="person_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telpon</label>
                            <input type="text" name="person_phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="person_email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Umur</label>
                            <input type="text" name="person_age" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="person_address" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($persons as $person)
        <div class="modal fade" id="editModal{{ $person->person_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editModal{{ $person->person_id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModal{{ $person->person_id }}Label">Ubah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/ubah-user" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="hidden" name="person_id" value="{{$person->person_id}}">
                                <input type="text" name="person_name" value="{{$person->person_name}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Telpon</label>
                                <input type="text" name="person_phone" value="{{$person->person_phone}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" name="person_email" value="{{$person->person_email}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Umur</label>
                                <input type="text" name="person_age" value="{{$person->person_age}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <input type="text" name="person_address" value="{{$person->person_address}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="deleteModal{{ $person->person_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deleteModal{{ $person->person_id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModal{{ $person->person_id }}Label">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="/hapus-user/{{$person->person_id}}" class="btn btn-danger">Hapus</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

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
                                    <h5 class="card-title fw-semibold">Manajemen Wisata</h5>
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
                                    <th>Deskripsi</th>
                                    <th>Harga Minimal</th>
                                    <th>Harga Maksimal</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($wisatas as $wisata)
                                    <tr>
                                        <td>{{ $wisata->wisata_name }}</td>
                                        <td>{{ $wisata->wisata_description }}</td>
                                        <td>{{ $wisata->wisata_min_price }}</td>
                                        <td>{{ $wisata->wisata_max_price }}</td>
                                        <td>{{ $wisata->wisata_latitude }}</td>
                                        <td>{{ $wisata->wisata_longitude }}</td>
                                        <td><img class="img-fluid" src="{{ $wisata->wisata_picture }}" alt=""></td>
                                        <td>
                                            <button class="btn m-2 btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $wisata->wisata_id }}">Edit</button>
                                            <button class="btn m-2 btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $wisata->wisata_id }}">Hapus</button>
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
                <form action="/tambah-wisata" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="wisata_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="wisata_description" id="" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Latitude</label>
                            <input type="text" name="wisata_latitude" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Longitude</label>
                            <input type="text" name="wisata_longitude" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Minimal</label>
                            <input type="text" name="wisata_min_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Maksimal</label>
                            <input type="text" name="wisata_max_price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="wisata_picture" class="form-control" required>
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

    @foreach ($wisatas as $wisata)
        <div class="modal fade" id="editModal{{ $wisata->wisata_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="editModal{{ $wisata->wisata_id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModal{{ $wisata->wisata_id }}Label">Ubah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/ubah-wisata" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="hidden" name="wisata_id" value="{{$wisata->wisata_id}}">
                                <input type="text" name="wisata_name" value="{{$wisata->wisata_name}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="wisata_description" id="" cols="30" rows="10" class="form-control">{{$wisata->wisata_description}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Latitude</label>
                                <input type="text" name="wisata_latitude" value="{{$wisata->wisata_latitude}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Longitude</label>
                                <input type="text" name="wisata_longitude" value="{{$wisata->wisata_longitude}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Minimal</label>
                                <input type="text" name="wisata_min_price" value="{{$wisata->wisata_min_price}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Maksimal</label>
                                <input type="text" name="wisata_max_price" value="{{$wisata->wisata_min_price}}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" name="wisata_picture" class="form-control">
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
        
        <div class="modal fade" id="deleteModal{{ $wisata->wisata_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="deleteModal{{ $wisata->wisata_id }}Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModal{{ $wisata->wisata_id }}Label">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body">
                            anda yakin ingin menghapus data ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="/hapus-wisata/{{$wisata->wisata_id}}" class="btn btn-danger">Hapus</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

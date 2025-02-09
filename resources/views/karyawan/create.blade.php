@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Karyawan</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Karyawan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('karyawan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" class="form-control" required>
                            <option value="">Pilih Jabatan</option>
                            @foreach($jabatan as $j)
                                <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Tambah Karyawan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

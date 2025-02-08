@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jabatan</h2>
    <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Jabatan</label>
            <input type="text" name="nama" class="form-control" value="{{ $jabatan->nama }}" required>
        </div>

        <div class="mb-3">
            <label>Gaji Pokok</label>
            <input type="number" name="gaji_pokok" class="form-control" value="{{ $jabatan->gaji_pokok }}" required>
        </div>

        <div class="mb-3">
            <label>Tunjangan</label>
            <input type="number" name="tunjangan" class="form-control" value="{{ $jabatan->tunjangan }}">
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

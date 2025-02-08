@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jabatan</h2>
    <form action="{{ route('jabatan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Jabatan</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Gaji Pokok</label>
            <input type="number" name="gaji_pokok" class="form-control @error('gaji_pokok') is-invalid @enderror" value="{{ old('gaji_pokok') }}" required>
            @error('gaji_pokok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Tunjangan</label>
            <input type="number" name="tunjangan" class="form-control @error('tunjangan') is-invalid @enderror" value="{{ old('tunjangan') }}">
            @error('tunjangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

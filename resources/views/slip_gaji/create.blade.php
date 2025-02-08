@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Slip Gaji</h2>
    <form action="{{ route('slip-gaji.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Karyawan</label>
            <select name="karyawan_id" class="form-control" required>
                @foreach($karyawan as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }} - {{ $k->jabatan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Gajian</label>
            <input type="date" name="tanggal_gajian" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('slip-gaji.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

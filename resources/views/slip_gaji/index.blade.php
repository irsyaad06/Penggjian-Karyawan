@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Slip Gaji</h2>
    <a href="{{ route('slip-gaji.create') }}" class="btn btn-primary">Tambah Slip Gaji</a>

    @if(session('success'))
    <div class="alert alert-success mt-2">
        {{ session('success') }}
    </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Karyawan</th>
                <th>Periode</th>
                <th>Gaji Bersih</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slipGaji as $sg)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sg->karyawan->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($sg->tanggal_gajian)->translatedFormat('F Y') }}</td>

                <td>Rp {{ number_format($sg->gaji_bersih, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('slip-gaji.generatePDF', $sg->id) }}" class="btn btn-success btn-sm">Cetak PDF</a>
                    <form action="{{ route('slip-gaji.destroy', $sg->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus slip gaji ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
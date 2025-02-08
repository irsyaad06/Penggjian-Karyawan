@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manajemen Bonus dan Lembur</h1>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
    @endif

    <!-- Button Tambah Bonus & Lembur -->
    <div class="mb-3">
        <a href="{{ route('bonus_lembur.create') }}" class="btn btn-success">Tambah Bonus & Lembur</a>
    </div>

    <!-- Tabel untuk menampilkan daftar bonus dan lembur -->
    <div class="card">
        <div class="card-header">
            <h5>Daftar Bonus & Lembur</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Bonus</th>
                        <th>Lembur</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bonusLembur as $bl)
                    <tr>
                        <td>{{ $bl->karyawan->nama }}</td>
                        <td>{{ $bl->tahun }}</td>
                        <td>{{ $bl->bulan }}</td>
                        <td>{{ number_format($bl->bonus, 2) }}</td>
                        <td>{{ number_format($bl->lembur, 2) }}</td>
                        <td>{{ ucwords(str_replace('_', ' ', $bl->status_bayar)) }}</td>

                        <td>
                            <a href="{{ route('bonus_lembur.edit', $bl->id) }}" class="btn btn-warning btn-sm">Ubah</a>

                            <form method="POST" action="{{ route('bonus_lembur.destroy', $bl->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
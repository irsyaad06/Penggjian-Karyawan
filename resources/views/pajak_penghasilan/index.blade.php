@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Manajemen Pajak Penghasilan</h1>

        <!-- Alert Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button Tambah Pajak Penghasilan -->
        <div class="mb-3">
            <a href="{{ route('pajak_penghasilan.create') }}" class="btn btn-success">Tambah Pajak Penghasilan</a>
        </div>

        <!-- Tabel untuk menampilkan daftar pajak penghasilan -->
        <div class="card">
            <div class="card-header">
                <h5>Daftar Pajak Penghasilan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Karyawan</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Jumlah Pajak</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pajakPenghasilan as $pajak)
                            <tr>
                                <td>{{ $pajak->karyawan->nama }}</td>
                                <td>{{ $pajak->tahun }}</td>
                                <td>{{ $pajak->bulan }}</td>
                                <td>{{ number_format($pajak->jumlah_pajak, 2) }}</td>
                                <td>{{ ucfirst($pajak->status_pembayaran) }}</td>
                                <td>
                                    <a href="{{ route('pajak_penghasilan.edit', $pajak->id) }}" class="btn btn-warning btn-sm">Ubah</a>

                                    <form method="POST" action="{{ route('pajak_penghasilan.destroy', $pajak->id) }}" style="display:inline;">
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

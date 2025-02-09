@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Pajak Penghasilan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pajak_penghasilan.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Pajak Penghasilan</a>

        <div class="card">
            <div class="card-header">
                <h5>Data Pajak Penghasilan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>Jumlah Pajak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pajakPenghasilan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->karyawan->nama }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>Rp {{ number_format($item->jumlah_pajak, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('pajak_penghasilan.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('pajak_penghasilan.destroy', $item->id) }}" style="display:inline;">
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

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pembayaran Gaji</h1>

    <a href="{{ url('/pembayaran_gaji/create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>


    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">Data Pembayaran Gaji</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaranGaji as $index => $pembayaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pembayaran->karyawan->nama }}</td>
                        <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                        <td>
                            <span class="badge bg-{{ $pembayaran->status == 'selesai' ? 'success' : 'warning' }}">
                                {{ ucfirst($pembayaran->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('pembayaran_gaji.show', $pembayaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                            @if($pembayaran->status == 'pending')
                            <form action="{{ route('pembayaran_gaji.updateStatus', $pembayaran->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Selesaikan</button>
                            </form>
                            @endif
                            <form action="{{ route('pembayaran_gaji.destroy', $pembayaran->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
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
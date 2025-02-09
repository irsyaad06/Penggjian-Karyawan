@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Slip Gaji</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('slip_gaji.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Slip Gaji</a>

    <div class="card">
        <div class="card-header">
            <h5>Data Slip Gaji</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus</th>
                        <th>Lembur</th>
                        <th>Pajak</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slipGaji as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->karyawan->nama }}</td>
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->total_bonus, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->total_lembur, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->total_pajak, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->total_potongan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->jumlah_gaji, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('slip_gaji.show', $item->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>

                            <!-- ✅ PERBAIKAN: Ganti $slip menjadi $item -->
                            <a href="{{ route('slip_gaji.downloadPDF', $item->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-file-pdf"></i>
                            </a>

                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('slip_gaji.destroy', $item->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
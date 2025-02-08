@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manajemen Cuti</h1>

    <!-- Alert Sukses -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Form untuk menambah cuti -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Tambah Cuti</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('cuti.store') }}">
                @csrf
                <div class="form-group">
                    <label for="karyawan_id">Karyawan</label>
                    <select name="karyawan_id" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach($karyawan as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="jenis_cuti">Jenis Cuti</label>
                    <input type="text" name="jenis_cuti" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Tambah Cuti</button>
            </form>
        </div>
    </div>

    <!-- Tabel untuk menampilkan data cuti -->
    <div class="card">
        <div class="card-header">
            <h5>Daftar Cuti</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Jenis Cuti</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cuti as $c)
                    <tr>
                        <td>{{ $c->karyawan->nama }}</td>
                        <td>{{ $c->jenis_cuti }}</td>
                        <td>{{ $c->tanggal_mulai }}</td>
                        <td>{{ $c->tanggal_selesai }}</td>
                        <td>{{ ucfirst($c->status) }}</td>
                        <td>
                            <!-- Form untuk mengubah status cuti -->
                            <a href="{{ route('cuti.edit', $c->id) }}" class="btn btn-warning btn-sm">Ubah Status</a>

                            <!-- Form untuk menghapus cuti -->
                            <form method="POST" action="{{ route('cuti.destroy', $c->id) }}" style="display:inline;">
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
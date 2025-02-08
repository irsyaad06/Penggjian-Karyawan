@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ubah Status Cuti</h1>

        <div class="card">
            <div class="card-header">
                <h5>Ubah Status Cuti: {{ $cuti->karyawan->nama }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cuti.update', $cuti->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ $cuti->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ $cuti->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $cuti->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

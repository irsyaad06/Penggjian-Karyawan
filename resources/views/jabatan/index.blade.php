@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Jabatan</h2>
    <a href="{{ route('jabatan.create') }}" class="btn btn-primary">Tambah Jabatan</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jabatan as $j)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $j->nama }}</td>
                <td>Rp {{ number_format($j->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($j->tunjangan, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('jabatan.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jabatan.destroy', $j->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus jabatan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

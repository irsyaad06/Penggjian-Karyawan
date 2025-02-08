@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Bonus & Lembur</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Bonus & Lembur</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bonus_lembur.store') }}">
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
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>

                    <!-- Dropdown untuk Bulan -->
                    <div class="form-group mt-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control" required>
                            <option value="">Pilih Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bonus">Bonus</label>
                        <input type="number" step="0.01" name="bonus" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="lembur">Lembur</label>
                        <input type="number" step="0.01" name="lembur" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="status_bayar">Status Pembayaran</label>
                        <select name="status_bayar" class="form-control" required>
                            <option value="belum_bayar">Belum Bayar</option>
                            <option value="sudah_bayar">Sudah Bayar</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Tambah Bonus & Lembur</button>
                </form>
            </div>
        </div>
    </div>
@endsection

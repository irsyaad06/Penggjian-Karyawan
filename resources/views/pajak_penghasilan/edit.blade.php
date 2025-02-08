@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ubah Pajak Penghasilan</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Edit Pajak Penghasilan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pajak_penghasilan.update', $pajak->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="status_pembayaran">Status Pembayaran</label>
                        <select name="status_pembayaran" class="form-control" required>
                            <option value="belum_bayar" {{ $pajak->status_pembayaran == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                            <option value="sudah_bayar" {{ $pajak->status_pembayaran == 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pembayaran Gaji</h1>

    <form action="{{ route('pembayaran_gaji.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="karyawan" class="form-label">Karyawan</label>
            <select id="karyawan" name="karyawan_id" class="form-control">
                <option value="">Pilih Karyawan</option>
                @foreach($karyawan as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }} - {{ $k->jabatan->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="slip_gaji" class="form-label">Slip Gaji</label>
            <select id="slip_gaji" name="slip_gaji_id" class="form-control">
                <option value="">Pilih Slip Gaji</option>
                @foreach($slipGaji as $slip)
                    <option value="{{ $slip->id }}">Bulan: {{ $slip->bulan }}, Tahun: {{ $slip->tahun }} - Rp {{ number_format($slip->jumlah_gaji, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#karyawan').change(function() {
        let karyawanId = $(this).val();
        if (karyawanId) {
            $.ajax({
                url: "{{ route('pembayaran_gaji.create') }}",
                type: "GET",
                data: { karyawan_id: karyawanId },
                success: function(response) {
                    let slipGajiDropdown = $('#slip_gaji');
                    slipGajiDropdown.empty();
                    slipGajiDropdown.append('<option value="">Pilih Slip Gaji</option>');
                    response.slipGaji.forEach(function(slip) {
                        slipGajiDropdown.append(`<option value="${slip.id}">Bulan: ${slip.bulan}, Tahun: ${slip.tahun} - Rp ${new Intl.NumberFormat('id-ID').format(slip.jumlah_gaji)}</option>`);
                    });
                }
            });
        }
    });
});
</script>
@endsection

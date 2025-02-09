<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - {{ $slip->karyawan->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Slip Gaji</h2>

    <table>
        <tr>
            <th>Karyawan</th>
            <td>{{ $slip->karyawan->nama }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $slip->karyawan->jabatan->nama_jabatan }}</td>
        </tr>
        <tr>
            <th>Bulan</th>
            <td>{{ $slip->bulan }}</td>
        </tr>
        <tr>
            <th>Tahun</th>
            <td>{{ $slip->tahun }}</td>
        </tr>
        <tr>
            <th>Gaji Pokok</th>
            <td>Rp {{ number_format($slip->gaji_pokok, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Bonus</th>
            <td>Rp {{ number_format($slip->total_bonus, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Lembur</th>
            <td>Rp {{ number_format($slip->total_lembur, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Pajak</th>
            <td>Rp {{ number_format($slip->total_pajak, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Potongan</th>
            <td>Rp {{ number_format($slip->total_potongan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Gaji</th>
            <td><strong>Rp {{ number_format($slip->jumlah_gaji, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

</body>
</html>

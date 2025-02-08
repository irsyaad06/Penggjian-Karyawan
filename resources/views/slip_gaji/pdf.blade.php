<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Slip Gaji</h2>
        <p><strong>Nama Karyawan:</strong> {{ $slip->karyawan->nama }}</p>
        <p><strong>Jabatan:</strong> {{ $slip->karyawan->jabatan->nama }}</p>
        <p><strong>Periode Gaji:</strong>{{ \Carbon\Carbon::parse( $slip->tanggal_gajian)->translatedFormat('F Y') }}</p>




        <table>
            <tr>
                <th>Rincian</th>
                <th class="text-right">Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td class="text-right">Rp {{ number_format($gajiPokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td class="text-right">Rp {{ number_format($tunjangan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td class="text-right">Rp {{ number_format($slip->potonganBpjs, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Gaji Bersih</th>
                <th class="text-right">Rp {{ number_format($slip->gaji_bersih, 0, ',', '.') }}</th>
            </tr>
        </table>

        <p style="margin-top: 20px;">Slip gaji ini dihasilkan secara otomatis.</p>
    </div>
</body>

</html>
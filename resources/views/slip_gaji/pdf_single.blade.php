<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - {{ $slip->karyawan->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .container {
            width: 600px;
            margin: auto;
        }

        h2 {
            text-align: center;
        }

        .header {
            font-weight: bold;
        }

        .section {
            margin-top: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>SLIP GAJI</h2>

        <div class="header">
            PT. UNIKOM JAYA ABADI<br>
            Jl. Dipatiukur no. 112-116<br>
            Bandung
        </div>

        <div class="section">
            <table>
                <tr>
                    <td>Periode</td>
                    <td>: {{ $slip->bulan }} {{ $slip->tahun }}</td>
                </tr>
                <tr>
                    <td>Nama Karyawan</td>
                    <td>: {{ $slip->karyawan->nama }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>: {{ $slip->karyawan->jabatan->nama_jabatan }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">PENERIMAAN</div>
            <table>
                <tr>
                    <td>Gaji Pokok</td>
                    <td class="right">Rp {{ number_format($slip->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td class="right">Rp {{ number_format($slip->total_bonus, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Lembur</td>
                    <td class="right">Rp {{ number_format($slip->total_lembur, 0, ',', '.') }}</td>
                </tr>
                <tr class="bold">
                    <td>Total Penghasilan {{$slip->karyawan->nama}}</td>
                    <td class="right">Rp {{ number_format($slip->gaji_pokok + $slip->total_bonus + $slip->total_lembur, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="section-title">PENGURANGAN</div>
            <table>
                <tr>
                    <td>Pajak</td>
                    <td class="right">Rp {{ number_format($slip->total_pajak, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Potongan</td>
                    <td class="right">Rp {{ number_format($slip->total_potongan, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <table>
                <tr class="bold">
                    <td>TOTAL DITERIMA KARYAWAN</td>
                    <td class="right">Rp {{ number_format($slip->jumlah_gaji,0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
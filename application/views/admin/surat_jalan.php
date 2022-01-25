<!DOCTYPE html>
<html lang="en">

<?php foreach ($data as $dt) {
    $nomor = $dt->order_number;
    $pemesan = $dt->customer_name;
    $tamu = $dt->guest_name;
    $mobil = $dt->type;
    $noplat = $dt->plate_number;
    $driver = $dt->driver;
    $tujuan = $dt->destination;
    $alamatjemput = $dt->pickup;
    $waktujemput = $dt->pickup_date;
    $waktuselesai = $dt->return_date;
} ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
    <style>
        .text {
            font-family: Arial, sans-serif;
        }

        .center {
            text-align: center;
        }

        .tabel_barang {
            border: 2px solid black;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 12px;
        }

        .tabel_barang td {
            border: 1px solid black;
            padding: 4px 4px;
        }

        .input {
            border: 1px solid black;
            padding: 5px 5px;
        }
    </style>
</head>

<body>
    <div class="">
        <div style="float: left;">
            <img src="<?= base_url() ?>assets/img/logo_bigbenjaya.jpg" width="22%" alt="">
        </div>
        <div style="text-align: left;">
            <p class="text" style="font-size:17px;font-weight:normal;font-style:normal;text-transform:capitalize;margin:0cm;margin-top:0.2cm;">Jl. Srinindito Timur IV RT.03 RW.04</p>
            <p class="text" style="font-size:17px;font-weight:normal;font-style:normal;text-transform:capitalize;margin:0.1cm;">Semarang</p>
            <p class="text" style="font-size:17px;font-weight:normal;font-style:normal;text-transform:capitalize;margin:0.1cm;">Telp. 081 66 1368</p>
            <p class="text" style="font-size:17px;font-weight:normal;font-style:normal;text-transform:capitalize;margin:0cm;margin-right:1.5cm;text-align:right">Nomor : <?= $nomor ?></p>
        </div>
    </div>

    <hr style="border: 1px solid black;">
    <p class="text center" style="font-size:24px;font-weight:bold;font-style:normal;text-transform:uppercase;margin:0cm;margin-top:1rem;"><u>Surat Perintah Jalan</u></p>

    <!-- body -->
    <table class="text" style="font-size:16px;margin-top:1rem;" width="100%">
        <tr>
            <td width="35%" style="text-align: right;">Pemesan &nbsp;</td>
            <td width="75%" class="input"><?= $pemesan ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Nama Tamu &nbsp;</td>
            <td width="75%" class="input"><?= $tamu ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Mobil &nbsp;</td>
            <td width="75%" class="input"><?= $mobil ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">No.Pol &nbsp;</td>
            <td width="75%" class="input"><?= $noplat ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Nama Pengemudi &nbsp;</td>
            <td width="75%" class="input"><?= $driver ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Tujuan &nbsp;</td>
            <td width="75%" class="input"><?= $tujuan ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Alamat Jemput / Antar &nbsp;</td>
            <td width="75%" class="input"><?= $alamatjemput ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Waktu Penjemputan &nbsp;</td>
            <td width="75%" class="input"><?= $waktujemput ?></td>
        </tr>
        <tr>
            <td width="35%" style="text-align: right;">Rencana Selesai &nbsp;</td>
            <td width="75%" class="input"><?= $waktuselesai ?></td>
        </tr>
    </table>

    <p class="text" style="font-size:16px;font-weight:normal;font-style:normal;text-align:justify;margin:0cm;margin-left:0cm;margin-top:0.5cm;">REALISASI PELAYANAN</p>
    <table width="100%" class="tabel_barang" style="font-size:16px;">
        <thead>
            <tr class="center">
                <td rowspan="2">Tanggal</td>
                <td colspan="2">Waktu</td>
                <td rowspan="2">Tujuan</td>
                <td rowspan="2">Paraf Tamu</td>
            </tr>
            <tr class="center">
                <td>Mulai</td>
                <td>Selesai</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>

    <table width="50%" class="tabel_barang" style="font-size:16px;">
        <thead>
            <tr>
                <td>KETERANGAN</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <div style="clear:both"></div>
</body>

</html>
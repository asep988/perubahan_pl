<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Submit</title>

    <style type="text/css">
        @font-face {
            font-family: 'Arial';
            src: url({{ public_path('public/font/Arial.ttf') }});
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        footer {
            position: fixed;
            bottom: 10px;
            left: 0px;
            right: 0px;
            height: 100px;

            /** Extra personal styles **/
            text-align: center;
        }
    </style>
</head>

<body>
    <table border="0" align="center">
        <tr>
            <td>
                <center><img src="https://amdalnet.menlhk.go.id/perubahan_pl/img/pohon.PNG" width="80px"></center>
            </td>
        </tr>
        <tr>
            <td>
                <center>
                    <b>BUKTI SUBMIT PERMOHONAN PERUBAHAN SKKL</b><br>
                    <b>No. Registrasi: {{ $noreg }}</b><br>
                </center>
            </td>
        </tr>
    </table>

    <br><br>

    <table style="border: 1px solid black; border-collapse: collapse; width: 650px" align="center">
        <tr style="border: 1px solid black; border-collapse: collapse;" class="row">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Jenis Permohonan</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;">
                
                @if ($jenis_perubahan === 'perkep1')
                    Perubahan Kepemilikan
                @elseif ($jenis_perubahan === 'perkep2')
                    Perubahan Kepemilikan dan Integrasi Pertek/Rintek
                @else 
                    Integrasi Pertek/Rintek
                @endif
            </td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Nama Pelaku Usaha</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;">
                {{ $pelaku_usaha_baru }}</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Judul Usaha/Kegiatan</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;">{{ $nama_usaha_baru }}
            </td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Tanggal Dibuat</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;"> {{ $tgl_dibuat }}, {{ $jam_dibuat }}</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Tanggal Diperbarui</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;"> {{ $tgl_diperbarui }}, {{ $jam_diperbarui }}</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Jumlah Perubahan</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;"> {{ $jml_perubahan == null ? '0' : $jml_perubahan }}</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Nomor Verifikasi PTSP</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;"> {{ $nomor_validasi }}
            </td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Jumlah Data RKL</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;">
                <div class="float-left">{{ $jml_rkl }}, terakhir update: {{ $last_rkl }}</div>
            </td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; width: 150px;">Jumlah Data RPL</td>
            <td style="border: 1px solid black; border-collapse: collapse; padding-left: 8px;">
                <div class="float-left">{{ $jml_rpl }}, terakhir update: {{ $last_rpl }}</div>
            </td>
        </tr>
    </table>

    <footer style="font-size: 12px"> 
        <table style="border: 1px solid black; border-collapse: collapse; width: 650px" align="center">
               <tr style="padding-top:0px">
                    <td>1. </td>
                    <td style="padding-left: 10px">Dokumen ini sah, diterbitkan sistem Amdalnet berdasarkan data dari Pemrakarsa Pelaku Usaha, tersimpan dalam sistem Amdalnet dan menjadi tanggung jawab Pemrakarsa Pelaku Usaha.</td>
               </tr>
               <tr>
                    <td>2. </td>
                    <td style="padding-left: 10px">Dalam hal terjadi kekeliruan isi dokumen, maka akan dilakukan perbaikan sebagaimana mestinya.</td>
               </tr>
               <tr style="padding-bottom:0px">
                    <td style="padding-top: 20px">&nbsp;</td>
                    <td style="padding-left: 10px">Dicetak pada tanggal {{ $tgl_cetak }} WIB</td>
               </tr>
        </table>
        <table border="0" align="center">
            <tr>
                <td>
                    <center><img src="{{ public_path('img/logo-amdal.png') }}" width="80px"></center>
                </td>
            </tr>

        </table>
    </footer>
</body>

</html>

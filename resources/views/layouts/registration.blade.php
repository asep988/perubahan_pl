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
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                text-align: center;
                line-height: 35px;
            }
    </style>
</head>
<body>
    <table border="0" align="center">
        <tr>
            <td><center><img src="{{ public_path('img/pohon.png') }}" width="80px"></center></td>
        </tr>
        <tr>
            <td>
                <center>
                    <b>BUKTI SUBMIT DOKUMEN SKKL/PKPL</b><br>
                    <b>No. Registrasi: </b><br>
                </center>
            </td>
        </tr>
    </table>

    <br><br>

    <table style="border: 1px; border-color: black; width: 640px" align="center">
        <tr>
            <td>Jenis Permohonan</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
        <tr>
            <td>Nama Pelaku Usaha</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
        <tr>
            <td>Judul Usaha/Kegiatan</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
        <tr>
            <td>Tanggal Dibuat</td>
            <td>:</td>
            <td>&nbsp; Tanggal dan Jam menit</td>
        </tr>
        <tr>
            <td>Nomor Verifikasi PTSP</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
        <tr>
            <td>Jumlah Data RKL</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
        <tr>
            <td>Jumlah Data RPL</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
        <tr>
            <td>Jumlah Data UKLUPL</td>
            <td>:</td>
            <td>&nbsp; Test</td>
        </tr>
    </table>

    <footer>
        <table border="0" align="center">
            <tr>
                <td><center><img src="{{ public_path('img/logo-amdal.png') }}" width="80px"></center></td>
            </tr>
        </table>
    </footer>
</body>
</html>
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
                height: 60px; 

                /** Extra personal styles **/
                text-align: center;
                line-height: 45px;
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

    <table style="border: 1px solid black; border-collapse: collapse; width: 650px" align="center">
        <tr style="border: 1px solid black; border-collapse: collapse;" class="row">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;" >Jenis Permohonan</td>     
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>          
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Nama Pelaku Usaha</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Judul Usaha/Kegiatan</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Tanggal Dibuat</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Tanggal dan Jam menit</td>
        </tr>{{  }}
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Nomor Verifikasi PTSP</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Jumlah Data RKL</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Jumlah Data RPL</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>
        </tr>
        <tr style="border: 1px solid black; border-collapse: collapse;">
            <td style="border: 1px solid black; border-collapse: collapse; max-width: 80px;">Jumlah Data UKLUPL</td>
            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;&nbsp; Test</td>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PREVIEW DOKUMEN RPL</title>
    <style>
        body {
            font-family:"Bookman Old Style" !important;
        }
        ol {
        columns:2;
        font-size: 7pt !important;
        }
        p {
            font-size: 7pt !important;
        }
        span {
            font-size: 7pt !important;
        }
        ol > li.list_kurung::marker {
        content:counter(list-item) ")\2003";
        font-size: 7pt !important;
        }
        td {
            vertical-align: top;
            text-align: justify;
            font-size: 7pt !important;
        }
        tbody{
            font-size: 7pt !important;
        }
        tbody table{
            font-size: 7pt !important;
        }
        table{
            font-size: 7pt !important;
        }

        @page SectionLC {
            size:841.7pt 595.45pt;mso-page-orientation:landscape;margin:1.25in 1.0in 1.25in 1.0in;mso-header-margin:.5in;mso-footer-margin:.5in;mso-paper-source:0;
        }

        div.SectionLC {
            page:SectionLC;
        }
        .solid-table {
            border-collapse: collapse;
            width: 100%;
        }

        .solid-table th,
        .solid-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class=SectionLC>
        LAMPIRAN II<br>
        KEPUTUSAN MENTERI LINGKUNGAN HIDUP <br>
        DAN KEHUTANAN REPUBLIK INDONESIA <br>
        NOMOR <br>
        TENTANG KELAYAKAN LINGKUNGAN HIDUP KEGIATAN {{ strtoupper($skkl->nama_usaha_baru) }}
        OLEH {{ strtoupper($skkl->pelaku_usaha_baru) }}

        <br><br><br>
        <center>MATRIKS RENCANA PENGELOLAAN LINGKUNGAN HIDUP</center>
            <table class="solid-table" width="100%" border="1" rules="all" cellpadding="5" cellspacing="0" style="font-size: 7pt;">
                <thead>
                    <tr>
                        <th width="70px" rowspan="2" class="align-middle">No</th>
                        <th colspan="3">Dampak Lingkungan Yang Dipantau</th>
                        <th colspan="3">Bentuk Pemantauan Lingkungan Hidup</th>
                        <th colspan="3">Institusi Pemantauan Lingkungan Hidup</th>
                    </tr>
                    <tr>
                        <td>Jenis Dampak Yang Timbul(dapat di ambien dan dapat di sumbernya)</td>
                        <td>Indikator/Parameter</td>
                        <td>Sumber Dampak</td>
                        <td>Metode Pengumpulan dan Analisis Data</td>
                        <td>Lokasi Pemantauan Lingkungan Hidup</td>
                        <td>Waktu dan Frekuensi Pemantauan</td>
                        <td>Pelaksana</td>
                        <td>Pengawas</td>
                        <td>Penerima Laporan</td>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dampak Penting -->
                    <tr id="dampakpenting">
                        <td colspan="10"><b>DAMPAK PENTING YANG DIKELOLA</b></td>
                    </tr>
                    {!! $body !!}
                    <!-- Dampak Lainnya -->
                    <tr id="dampaklainnya">
                        <td colspan="10"><b>DAMPAK LAINNYA YANG DIKELOLA</b></td>
                    </tr>
                    {!! $bodyy !!}
                </tbody>
            </table>
        </div>
</body>
</html>

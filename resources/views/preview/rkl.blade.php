<!DOCTYPE html>
<html lang="en">

<head>
    <title>PREVIEW DOKUMEN RKL</title>
    <style>
        body {
            font-family: "Bookman Old Style" !important;
        }

        ol {
            columns: 2;
            font-size: 7pt !important;
        }

        p {
            font-size: 7pt !important;
        }

        span {
            font-size: 7pt !important;
        }

        ol>li.list_kurung::marker {
            content: counter(list-item) ")\2003";
            font-size: 7pt !important;
        }

        td {
            vertical-align: top;
            text-align: justify;
            font-size: 7pt !important;
        }

        tbody {
            font-size: 7pt !important;
        }

        tbody table {
            font-size: 7pt !important;
        }

        @page SectionLC {
            size: 841.7pt 595.45pt;
            mso-page-orientation: landscape;
            margin: 1.25in 1.0in 1.25in 1.0in;
            mso-header-margin: .5in;
            mso-footer-margin: .5in;
            mso-paper-source: 0;
        }

        div.SectionLC {
            page: SectionLC;
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
    <div class="SectionLC">
        LAMPIRAN II <br>
        KEPUTUSAN MENTERI LINGKUNGAN HIDUP <br>
        DAN KEHUTANAN REPUBLIK INDONESIA <br>
        NOMOR <br>
        TENTANG KELAYAKAN LINGKUNGAN HIDUP KEGIATAN {{ strtoupper($skkl->nama_usaha_baru) }}
        OLEH {{ strtoupper($skkl->pelaku_usaha_baru) }}

        <br><br><br>
        <center>MATRIKS RENCANA PENGELOLAAN LINGKUNGAN HIDUP<center>
            <br>
            <table class="solid-table" width="100%" border="1" rules="all" cellpadding="5" cellspacing="0"
                    style="font-size: 7pt;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dampak Lingkungan Yang Dikelola</th>
                            <th>Sumber Dampak</th>
                            <th>Indikator Keberhasilan Pengelolaan Lingkungan Hidup</th>
                            <th>Bentuk Pengelolaan Lingkungan Hidup</th>
                            <th>Lokasi Pengelolaan Lingkungan Hidup</th>
                            <th>Periode Pengelolaan Lingkungan Hidup</th>
                            <th>Institusi Pengelolaan Lingkungan Hidup</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 7pt;">
                        <!-- Dampak Penting -->
                        <tr id="dampakpenting">
                            <td colspan="8"><b>DAMPAK PENTING YANG DIKELOLA</b></td>
                        </tr>
                        {!! $body !!}
                        <!-- Dampak Lainnya -->
                        <tr id="dampaklainnya">
                            <td colspan="8"><b>DAMPAK LAINNYA YANG DIKELOLA</b></td>
                        </tr>
                        {!! $bodyy !!}
                    </tbody>
                </table>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Preview Document Ukl-Upl</title>
        <style>
            body {
                font-family: "Bookman Old Style";
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
            ol > li.list_kurung::marker {
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
            table {
                font-size: 7pt !important;
            }

            @page SectionLC {
                size: 841.7pt 595.45pt;
                mso-page-orientation: landscape;
                margin: 1.25in 1in 1.25in 1in;
                mso-header-margin: 0.5in;
                mso-footer-margin: 0.5in;
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
            LAMPIRAN I<br />
            KEPUTUSAN MENTERI LINGKUNGAN HIDUP <br />
            DAN KEHUTANAN REPUBLIK INDONESIA <br />NOMOR <br />
            TENTANG PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN
            HIDUP {{ strtoupper($pkplh->nama_usaha_baru) }}  OLEH
            {{ strtoupper($pkplh->pelaku_usaha_baru) }}
            <br /><br /><br />
            <center>
                MATRIKS UPAYA PENGELOLAAN DAN PEMANTAUAN LINGKUNGAN HIDUP
                (UKL-UPL)
            </center>

            <table
                width="100%"
                border="1"
                rules="all"
                cellpadding="5"
                cellspacing="0"
                style="font-size: 7pt"
                class="solid-table"
            >
                <thead>
                    <tr>
                        <th width="70px" rowspan="2" class="align-middle">
                            No
                        </th>
                        <th colspan="3"></th>
                        <th colspan="3">
                            Standar Pengelolaan Lingkungan Hidup
                        </th>
                        <th colspan="3">Standar Pemantauan Lingkungan Hidup</th>
                        <th width="70px" rowspan="2" class="align-middle">
                            Institusi Pengelolaan dan Pemantauan Lingkungan
                            Hidup
                        </th>
                        <th width="70px" rowspan="2" class="align-middle">
                            Keterangan
                        </th>
                    </tr>
                    <tr>
                        <td>Sumber Dampak</td>
                        <td>Jenis Dampak</td>
                        <td>Besaran Dampak</td>
                        <td>Bentuk</td>
                        <td>Lokasi</td>
                        <td>Periode</td>
                        <td>Bentuk</td>
                        <td>Lokasi</td>
                        <td>Periode</td>
                    </tr>
                </thead>
                <tbody>
                    {!! $body !!}
                </tbody>
            </table>
        </div>
    </body>
</html>

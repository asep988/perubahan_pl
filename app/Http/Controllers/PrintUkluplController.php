<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Uklupl;
use App\Pkplh;

class PrintUkluplController extends Controller
{
    public function showdata($data_uklupl, $no, $tahap)
    {
        $body="";
        if (count($data_uklupl) > 0) {
            $body ='
                <tr>
                    <td colspan="12"><strong>'.$tahap.'</strong></td>
                </tr>';
            }
        foreach ($data_uklupl as $data) {
            $no++;
            $body .='
            <tr>
                <td align="center"> '.$no.'</td>
                <td>
                    '.$data->sumber_dampak.'
                </td>
                <td>
                    '.$data->jenis_dampak.'
                </td>
                <td>
                    '.$data->besaran_dampak.'
                </td>
                <td>
                    '.$data->bentuk_pengelolaan.'
                </td>
                <td>
                    '.$data->lokasi_pengelolaan.'
                </td>
                <td>
                    '.$data->periode_pengelolaan.'
                </td>
                <td>
                    '.$data->bentuk_pemantauan.'
                </td>
                <td>
                    '.$data->lokasi_pemantauan.'
                </td>
                <td>
                    '.$data->periode_pemantauan.'
                </td>
                <td>
                    '.$data->institusi.'
                </td>
                <td>
                    '.$data->keterangan.'
                </td>
            </tr>';
        }     
        return $body;
    }

    public function download($id_pkplh)
    {
        $pkplh=Pkplh::find($id_pkplh);
        //phpword
        $uklupl_prakons = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'desc')->get();
        $uklupl_konstruksi = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'desc')->get();
        $uklupl_operasi = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Operasi')->orderBy('id', 'desc')->get();
        $uklupl_pasca = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Pasca Oprerasi')->orderBy('id', 'desc')->get();

        $headers = array(

            "Content-type" => "text/html",

            "Content-Disposition" => "attachment;Filename=UKL-UPL_$pkplh->nama_usaha_baru.doc"

        );

        $body = '<html>
                <head><meta charset="utf-8"></head>
                <body>';

        $body .= '<style>
                    body {
                        font-family:"Bookman Old Style,serif";
                    }
                    ol {
                    columns:2;
                    }
                    ol > li.list_kurung::marker {
                    content:counter(list-item) ")\2003";
                    }
                    td {
                        vertical-align: top;
                        text-align: justify;
                    }
                </style>';


        $body .='<body>

        LAMPIRAN I<br>
						KEPUTUSAN MENTRI LINGKUNGAN HIDUP <br>
						DAN KEHUTANAN REPUBLIK INDONESIA <br>
						NOMOR <br>
						TENTANG PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP '. strtoupper($pkplh->nama_usaha_baru).'
						OLEH '.strtoupper($pkplh->pelaku_usaha_baru).'
                    <br><br><br>

                <center> MATRIKS UPAYA PENGELOLAAN DAN PEMANTAUAN LINGKUNGAN HIDUP (UKL-UPL)</center>';

        $body .='<table width="100%" border="1" rules="all" cellpadding="5" cellspacing="0" style="font-size: 6pt;">
		    <thead>
                <tr>
                    <th width="70px" rowspan="2" class="align-middle">No</th>
                    <th colspan="3"></th>
                    <th colspan="3">Standar Pengelolaan Lingkungan Hidup</th>
                    <th colspan="3">Standar Pemantauan Lingkungan Hidup</th>
                    <th width="70px" rowspan="2" class="align-middle">Institusi Pengelolaan dan Pemantauan Lingkungan Hidup</th>
                    <th width="70px" rowspan="2" class="align-middle">Keterangan</th>
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
		<tbody>';
	
        $no = 0;
        $body .= $this->showdata($uklupl_prakons, $no, 'Pra Konstruksi');
        $no += count($uklupl_prakons);

        $body .= $this->showdata($uklupl_konstruksi, $no, 'Konstruksi');
        $no += count($uklupl_konstruksi);

        $body .= $this->showdata($uklupl_operasi, $no, 'Operasi');
        $no += count($uklupl_operasi);
        
        $body .= $this->showdata($uklupl_pasca, $no, 'Pasca Operasi');
        $no += count($uklupl_pasca);
       
        $body .= '</tbody></table>
            </body>
            </html>';

        return \Response::make($body, 200, $headers);
    }
}

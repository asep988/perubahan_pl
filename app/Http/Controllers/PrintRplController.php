<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rpl;
use App\Skkl;
use Illuminate\Contracts\Session\Session;

// use FacadePdf;

class PrintRplController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function showdata($data_rpl, $no, $tahap)
    {
        $body="";
        if (count($data_rpl) > 0) {
            $body ='
                <tr>
                    <td colspan="10"><strong>'.$tahap.'</strong></td>
                </tr>';
            }
        foreach ($data_rpl as $data) {
            $no++;
            $body .='
            <tr>
                <td align="center"> '.$no.'</td>
                <td>
                    '.$data->jenis_dampak.'
                </td>
                <td>
                    '.$data->indikator.'
                </td>
                <td>
                    '.$data->sumber_dampak.'
                </td>
                <td>
                    '.$data->metode.'
                </td>
                <td>
                    '.$data->lokasi.'
                </td>
                <td>
                    '.$data->waktu.'
                </td>
                <td>
                    '.$data->pelaksana.'
                </td>
                <td>
                    '.$data->pengawas.'
                </td>
                <td>
                    '.$data->penerima.'
                </td>
            </tr>';
        }     
        return $body;
    }

    public function download($id_skkl)
    {
        $skkl=Skkl::find($id_skkl);
        //phpword
        $rpl_penting_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'desc')->get();
        $rpl_penting_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'desc')->get();
        $rpl_penting_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Operasi')->orderBy('id', 'desc')->get();
        $rpl_penting_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Pasca Oprerasi')->orderBy('id', 'desc')->get();

        $rpl_lainnya_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'desc')->get();
        $rpl_lainnya_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'desc')->get();
        $rpl_lainnya_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Operasi')->orderBy('id', 'desc')->get();
        $rpl_lainnya_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Pasca Oprerasi')->orderBy('id', 'desc')->get();

        $headers = array(

            "Content-type" => "text/html",

            "Content-Disposition" => "attachment;Filename=RPL_$skkl->nama_usaha_baru.doc"

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
                <center>MATRIKS RENCANA PENGELOLAAN LINGKUNGAN HIDUP<center>';

        $body .='<table width="100%" border="1" rules="all" cellpadding="5" cellspacing="0" style="font-size: 6pt;">
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
			<tr id="dampakpenting">
				<td colspan="10"><b>DAMPAK PENTING YANG DIKELOLA</b></td>
			</tr>';

        $no = 0;
        $body .= $this->showdata($rpl_penting_prakons, $no, 'Pra Konstruksi');
        $no += count($rpl_penting_prakons);

        $body .= $this->showdata($rpl_penting_konstruksi, $no, 'Konstruksi');
        $no += count($rpl_penting_konstruksi);

        $body .= $this->showdata($rpl_penting_operasi, $no, 'Operasi');
        $no += count($rpl_penting_operasi);
        
        $body .= $this->showdata($rpl_penting_pasca, $no, 'Pasca Operasi');
        $no += count($rpl_penting_pasca);
        
        
        //========= DAMPAK LAINNYA =============
        $body .= '<tr id="dampaklainnya">
            <td colspan="10"><b>DAMPAK LAINNYA YANG DIKELOLA</b></td>
        </tr>';

        $no = 0;
        $body .= $this->showdata($rpl_lainnya_prakons, $no, 'Pra Konstruksi');
        $no += count($rpl_lainnya_prakons);

        $body .= $this->showdata($rpl_lainnya_konstruksi, $no, 'Konstruksi');
        $no += count($rpl_lainnya_konstruksi);

        $body .= $this->showdata($rpl_lainnya_operasi, $no, 'Operasi');
        $no += count($rpl_lainnya_operasi);
        
        $body .= $this->showdata($rpl_lainnya_pasca, $no, 'Pasca Operasi');
        $no += count($rpl_lainnya_pasca);

       
        $body .= '</tbody></table>
            </body>
            </html>';

        return \Response::make($body, 200, $headers);
    }

    public function preview($id)
    {
        // $skkl = Skkl::find($id);
        // return view('operator.preview', compact('skkl'));
    }
}

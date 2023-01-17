<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rkl;
use App\Skkl;
use Illuminate\Contracts\Session\Session;

// use FacadePdf;

class PrintRklController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function showdata($data_rkl, $no, $tahap)
    {
        $body="";
        if (count($data_rkl) > 0) {
            $body ='
                <tr>
                    <td colspan="8"><strong>'.$tahap.'</strong></td>
                </tr>';
            }
        foreach ($data_rkl as $data) {
            $no++;
            $body .='
            <tr>
                <td align="center"> '.$no.'</td>
                <td>
                    '.$data->dampak_dikelola.'
                </td>
                <td>
                    '.$data->sumber_dampak.'
                </td>
                <td>
                    '.$data->indikator.'
                </td>
                <td>
                    '.$data->bentuk_pengelolaan.'
                </td>
                <td>
                    '.$data->lokasi.'
                </td>
                <td>
                    '.$data->periode.'
                </td>
                <td>
                    '.$data->institusi.'
                </td>
            </tr>';
        }     
        return $body;
    }

    public function download($id_skkl)
    {
        $skkl=Skkl::find($id_skkl);
        //phpword
        $rkl_penting_prakons = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'desc')->get();
        $rkl_penting_konstruksi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'desc')->get();
        $rkl_penting_operasi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Operasi')->orderBy('id', 'desc')->get();
        $rkl_penting_pasca = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Pasca Oprerasi')->orderBy('id', 'desc')->get();

        $rkl_lainnya_prakons = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'desc')->get();
        $rkl_lainnya_konstruksi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'desc')->get();
        $rkl_lainnya_operasi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Operasi')->orderBy('id', 'desc')->get();
        $rkl_lainnya_pasca = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Pasca Oprerasi')->orderBy('id', 'desc')->get();

        $headers = array(

            "Content-type" => "text/html",

            "Content-Disposition" => "attachment;Filename=RKL_$skkl->pelaku_usaha_baru.doc"

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
		<tbody>
			<tr id="dampakpenting">
				<td colspan="8"><b>DAMPAK PENTING YANG DIKELOLA</b></td>
			</tr>';

        $no = 0;
        $body .= $this->showdata($rkl_penting_prakons, $no, 'Pra Konstruksi');
        $no += count($rkl_penting_prakons);

        $body .= $this->showdata($rkl_penting_konstruksi, $no, 'Konstruksi');
        $no += count($rkl_penting_konstruksi);

        $body .= $this->showdata($rkl_penting_operasi, $no, 'Operasi');
        $no += count($rkl_penting_operasi);
        
        $body .= $this->showdata($rkl_penting_pasca, $no, 'Pasca Operasi');
        $no += count($rkl_penting_pasca);
        
        
        //========= DAMPAK LAINNYA =============
        $body .= '<tr id="dampakpenting">
            <td colspan="8"><b>DAMPAK LAINNYA YANG DIKELOLA</b></td>
        </tr>';

        $no = 0;
        $body .= $this->showdata($rkl_lainnya_prakons, $no, 'Pra Konstruksi');
        $no += count($rkl_lainnya_prakons);

        $body .= $this->showdata($rkl_lainnya_konstruksi, $no, 'Konstruksi');
        $no += count($rkl_lainnya_konstruksi);

        $body .= $this->showdata($rkl_lainnya_operasi, $no, 'Operasi');
        $no += count($rkl_lainnya_operasi);
        
        $body .= $this->showdata($rkl_lainnya_pasca, $no, 'Pasca Operasi');
        $no += count($rkl_lainnya_pasca);

       
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

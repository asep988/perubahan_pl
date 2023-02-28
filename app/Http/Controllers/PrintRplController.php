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
        $rpl_penting_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_penting_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_penting_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Operasi')->orderBy('id', 'asc')->get();
        $rpl_penting_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan','Pasca Operasi')->orderBy('id', 'asc')->get();

        $rpl_lainnya_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Operasi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan','Pasca Operasi')->orderBy('id', 'asc')->get();

        $headers = array(
            "Content-type" => "application/vnd.msword",
            "Content-Disposition" => "attachment;Filename=RPL_$skkl->pelaku_usaha_baru.doc",
            "Cache-Control"=> "no-cache;must-revalidate"
        );

        $body = '<html>
                <head>
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
                </head>';

        $body .= '<body>';

        $body .='
        <div class=SectionLC>
        LAMPIRAN II<br>
        KEPUTUSAN MENTERI LINGKUNGAN HIDUP <br>
        DAN KEHUTANAN REPUBLIK INDONESIA <br>
        NOMOR <br>
        TENTANG KELAYAKAN LINGKUNGAN HIDUP KEGIATAN '. strtoupper($skkl->nama_usaha_baru).'
        OLEH '.strtoupper($skkl->pelaku_usaha_baru).'

    <br><br><br>
                <center>MATRIKS RENCANA PENGELOLAAN LINGKUNGAN HIDUP<center>';

        $body .='<table width="100%" border="1" rules="all" cellpadding="5" cellspacing="0" style="font-size: 7pt;" class="solid-table">
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
        </div>
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rkl;
use App\rpl;
use App\Skkl;
use App\Pkplh;
use App\Uklupl;

class PreviewController extends Controller
{
    // RKL
    public function showdata_rkl($data_rkl, $no, $tahap)
    {
        $body = "";
        if (count($data_rkl) > 0) {
            $body = '
                <tr>
                    <td colspan="8"><strong>' . $tahap . '</strong></td>
                </tr>';
        }
        foreach ($data_rkl as $data) {
            $no++;
            $body .= '
            <tr>
                <td align="center"> ' . $no . '</td>
                <td>
                    ' . $data->dampak_dikelola . '
                </td>
                <td>
                    ' . $data->sumber_dampak . '
                </td>
                <td>
                    ' . $data->indikator . '
                </td>
                <td>
                    ' . $data->bentuk_pengelolaan . '
                </td>
                <td>
                    ' . $data->lokasi . '
                </td>
                <td>
                    ' . $data->periode . '
                </td>
                <td>
                    ' . $data->institusi . '
                </td>
            </tr>';
        }
        return $body;
    }

    public function preview_rkl($id_skkl)
    {
        $skkl=Skkl::find($id_skkl);
        //
        $rkl_penting_prakons = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_penting_konstruksi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_penting_operasi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rkl_penting_pasca = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pasca Operasi')->orderBy('id', 'asc')->get();

        $rkl_lainnya_prakons = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_lainnya_konstruksi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_lainnya_operasi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rkl_lainnya_pasca = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pasca Operasi')->orderBy('id', 'asc')->get();

        // dampak {{ Pent }}ing
        $body = '';
        $no = 0;
        $body .= $this->showdata_rkl($rkl_penting_prakons, $no, 'Pra Konstruksi');
        $no += count($rkl_penting_prakons);

        $body .= $this->showdata_rkl($rkl_penting_konstruksi, $no, 'Konstruksi');
        $no += count($rkl_penting_konstruksi);

        $body .= $this->showdata_rkl($rkl_penting_operasi, $no, 'Operasi');
        $no += count($rkl_penting_operasi);

        $body .= $this->showdata_rkl($rkl_penting_pasca, $no, 'Pasca Operasi');
        $no += count($rkl_penting_pasca);

        // dampak lainnnya
        $bodyy = '';
        $no = 0;
        $bodyy .= $this->showdata_rkl($rkl_lainnya_prakons, $no, 'Pra Konstruksi');
        $no += count($rkl_lainnya_prakons);

        $bodyy .= $this->showdata_rkl($rkl_lainnya_konstruksi, $no, 'Konstruksi');
        $no += count($rkl_lainnya_konstruksi);

        $bodyy .= $this->showdata_rkl($rkl_lainnya_operasi, $no, 'Operasi');
        $no += count($rkl_lainnya_operasi);

        $bodyy .= $this->showdata_rkl($rkl_lainnya_pasca, $no, 'Pasca Operasi');
        $no += count($rkl_lainnya_pasca);

        return view('preview.rkl', compact('body', 'bodyy', 'skkl'));
        // return $bodyy;
    }

    // RPL

    public function showdata_rpl($data_rpl, $no, $tahap)
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

    public function preview_rpl($id_skkl)
    {
        $skkl=Skkl::find($id_skkl);
        //
        $rpl_penting_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_penting_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_penting_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rpl_penting_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pasca Operasi')->orderBy('id', 'asc')->get();

        $rpl_lainnya_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pasca Operasi')->orderBy('id', 'asc')->get();

        // Dampak Penting
        $body = '';
        $no = 0;
        $body .= $this->showdata_rpl($rpl_penting_prakons, $no, 'Pra Konstruksi');
        $no += count($rpl_penting_prakons);

        $body .= $this->showdata_rpl($rpl_penting_konstruksi, $no, 'Konstruksi');
        $no += count($rpl_penting_konstruksi);

        $body .= $this->showdata_rpl($rpl_penting_operasi, $no, 'Operasi');
        $no += count($rpl_penting_operasi);

        $body .= $this->showdata_rpl($rpl_penting_pasca, $no, 'Pasca Operasi');
        $no += count($rpl_penting_pasca);


        // Dampak Lainnya
        $bodyy = '';
        $no = 0;
        $bodyy .= $this->showdata_rpl($rpl_lainnya_prakons, $no, 'Pra Konstruksi');
        $no += count($rpl_lainnya_prakons);

        $bodyy .= $this->showdata_rpl($rpl_lainnya_konstruksi, $no, 'Konstruksi');
        $no += count($rpl_lainnya_konstruksi);

        $bodyy .= $this->showdata_rpl($rpl_lainnya_operasi, $no, 'Operasi');
        $no += count($rpl_lainnya_operasi);

        $bodyy .= $this->showdata_rpl($rpl_lainnya_pasca, $no, 'Pasca Operasi');
        $no += count($rpl_lainnya_pasca);

        return view('preview.rpl', compact('skkl', 'body', 'bodyy'));
        // return $bodyy;
    }

    // UKL-UPL

    public function showdata_uklupl($data_uklupl, $no, $tahap)
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

    public function preview_uklupl($id_pkplh)
    {
        $pkplh=Pkplh::find($id_pkplh);
        //
        $uklupl_prakons = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Pra Konstruksi')->orderBy('id', 'desc')->get();
        $uklupl_konstruksi = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Konstruksi')->orderBy('id', 'desc')->get();
        $uklupl_operasi = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Operasi')->orderBy('id', 'desc')->get();
        $uklupl_pasca = Uklupl::where('id_pkplh', $id_pkplh)->where('tahap_kegiatan','Pasca Operasi')->orderBy('id', 'desc')->get();

        // Dampak Penting
        $body = '';
        $no = 0;
        $body .= $this->showdata_uklupl($uklupl_prakons, $no, 'Pra Konstruksi');
        $no += count($uklupl_prakons);

        $body .= $this->showdata_uklupl($uklupl_konstruksi, $no, 'Konstruksi');
        $no += count($uklupl_konstruksi);

        $body .= $this->showdata_uklupl($uklupl_operasi, $no, 'Operasi');
        $no += count($uklupl_operasi);

        $body .= $this->showdata_uklupl($uklupl_pasca, $no, 'Pasca Operasi');
        $no += count($uklupl_pasca);


        return view('preview.uklupl', compact('pkplh', 'body'));
        // return $bodyy;
    } 
}

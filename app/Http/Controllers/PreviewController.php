<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function preview_rkl($id_skkl)
    {
        $skkl=Skkl::find($id_skkl);
        //
        $rkl_penting_prakons = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_penting_konstruksi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_penting_operasi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rkl_penting_pasca = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pasca Oprerasi')->orderBy('id', 'asc')->get();

        $rkl_lainnya_prakons = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_lainnya_konstruksi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rkl_lainnya_operasi = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rkl_lainnya_pasca = rkl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pasca Oprerasi')->orderBy('id', 'asc')->get();

        return view('preview.rkl', compact('skkl', 'rkl_penting_prakons', 'rkl_penting_konstruksi', 'rkl_penting_operasi', 'rkl_penting_pasca',
        'rkl_lainnya_prakons', 'rkl_lainnya_konstruksi', 'rkl_lainnya_operasi', 'rkl_lainnya_pasca'));
    }

    public function preview_rpl($id_skkl)
    {
        $skkl=Skkl::find($id_skkl);
        //
        $rpl_penting_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_penting_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_penting_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rpl_penting_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Penting')->where('tahap_kegiatan', 'Pasca Oprerasi')->orderBy('id', 'asc')->get();

        $rpl_lainnya_prakons = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pra Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_konstruksi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Konstruksi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_operasi = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Operasi')->orderBy('id', 'asc')->get();
        $rpl_lainnya_pasca = rpl::where('id_skkl', $id_skkl)->where('jenis_dph', 'Lainnya')->where('tahap_kegiatan', 'Pasca Oprerasi')->orderBy('id', 'asc')->get();

        return view('preview.rpl', compact('skkl', 'rpl_penting_prakons', 'rpl_penting_konstruksi', 'rpl_penting_operasi', 'rpl_penting_pasca',
        'rpl_lainnya_prakons', 'rpl_lainnya_konstruksi', 'rpl_lainnya_operasi', 'rpl_lainnya_pasca'));
    }
}

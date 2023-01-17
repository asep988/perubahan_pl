<?php

namespace App\Http\Controllers;

use App\il_skkl;
use App\region;
use Illuminate\Http\Request;
use App\rkl;
use App\Skkl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RklController extends Controller
{
	public function create($id)
	{
		$batas = 5;
        $jumlah_rkl = rkl::where('id_skkl', $id)->count();
		$id_skkl = $id;
		$data_rkl = rkl::where('id_skkl', $id)->orderBy('id', 'desc')->get();

        return view('rkl', compact('data_rkl', 'jumlah_rkl', 'id_skkl'));
		// return view('rkl');
	}

	public function store_rkl(Request $request)
	{
		// $kabkota = implode(", ", $request->kabupaten_kota);
		// $prov = implode(", ", $request->provinsi);

		$id_user = Auth::user()->id;

		$rkl = new rkl;
		//$skkl->user_id 		=   $id_user;
		// $skkl->pelaku_usaha =   $request->pelaku_usaha;
		// $skkl->nama_usaha	=	$request->nama_usaha;
		// $skkl->jenis_usaha	=	$request->jenis_usaha;

		$rkl->id_skkl				=	$request->id_skkl;
		$rkl->dampak_dikelola		=	$request->dampak_dikelola;
		$rkl->sumber_dampak			=	$request->sumber_dampak;
		$rkl->indikator				=	$request->indikator;
		$rkl->bentuk_pengelolaan	=	$request->bentuk_pengelolaan;
		$rkl->lokasi				=	$request->lokasi;
		$rkl->periode				=	$request->periode;
		$rkl->institusi				=	$request->institusi;
		$rkl->jenis_dph				=	$request->jenis_dph;
		$rkl->tahap_kegiatan		=	$request->tahap_kegiatan;
		
		//savedatabase
		$rkl->save();

		
        return back()->with('pesan', 'Data berhasil diinput');
	}

	public function delete($id)
	{
		$rkl = rkl::find($id);
        $rkl->delete();
        return back()->with('pesan', 'Data RKL-RPL Berhasil di Hapus');
	}

	public function ubah($id){
        $rkl = rkl::find($id);
        return view('rkl_edit', compact('rkl'));
    }

	public function update(Request $request, $id){
        $rkl = rkl::find($id);
		$skkl = Skkl::find($id);
        $rkl->id_skkl				=	$request->id_skkl;
		$rkl->dampak_dikelola		=	$request->dampak_dikelola;
		$rkl->sumber_dampak			=	$request->sumber_dampak;
		$rkl->indikator				=	$request->indikator;
		$rkl->bentuk_pengelolaan	=	$request->bentuk_pengelolaan;		
		$rkl->lokasi				=	$request->lokasi;
		$rkl->periode				=	$request->periode; 
		$rkl->institusi				=	$request->institusi;
		$rkl->jenis_dph				=	$request->jenis_dph;
		$rkl->tahap_kegiatan		=	$request->tahap_kegiatan;
        $rkl->update();
        return redirect()->route('rkl.create', $rkl->id_skkl)->with('pesan', 'Data RKL Berhasil di Update');
	}

	
}
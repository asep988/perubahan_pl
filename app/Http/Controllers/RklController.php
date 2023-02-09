<?php

namespace App\Http\Controllers;

use App\il_skkl;
use App\Imports\Rkl as ImportsRkl;
use App\region;
use Illuminate\Http\Request;
use App\rkl;
use App\Skkl;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class RklController extends Controller
{
	public function create($id)
	{
		$id_skkl = $id;
		$data_rkl = rkl::where('id_skkl', $id)->orderBy('id', 'desc')->get();

        return view('home.rkl.index', compact('data_rkl', 'id_skkl'));
	}

	public function store_rkl(Request $request)
	{
		$rkl = new rkl;
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
        return view('home.rkl.edit', compact('rkl'));
    }

	public function update(Request $request, $id){
        $rkl = rkl::find($id);
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

    public function import(Request $request, $id)
    {
        Excel::import(new ImportsRkl($id), $request->file);

        return back()->with('pesan', 'Import Success');
    }

}

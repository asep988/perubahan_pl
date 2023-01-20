<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rpl;
use App\Skkl;
use Illuminate\Support\Facades\Auth;

class RplController extends Controller
{
    public function create($id) //Pemrakarsa
    {
		$id_skkl = $id;
		$data_rpl = rpl::where('id_skkl', $id)->orderBy('id', 'desc')->get();

        return view('home.rpl.index', compact('data_rpl', 'id_skkl'));
    }

    public function store_rpl(Request $request) //Pemrakarsa
	{
		$rpl = new rpl;
		$rpl->tahap_kegiatan		=	$request->tahap_kegiatan;
		$rpl->jenis_dph				=	$request->jenis_dph;
		$rpl->id_skkl				=	$request->id_skkl;
		$rpl->jenis_dampak          =	$request->jenis_dampak;
		$rpl->indikator		        =	$request->indikator;
		$rpl->sumber_dampak			=	$request->sumber_dampak;
		$rpl->metode				=	$request->metode;
		$rpl->lokasi	            =	$request->lokasi;
		$rpl->waktu				    =	$request->waktu;
		$rpl->pelaksana				=	$request->pelaksana;
		$rpl->pengawas				=	$request->pengawas;
		$rpl->penerima				=	$request->penerima;
		$rpl->save();
		
        return back()->with('pesan', 'Data berhasil diinput');
	}

	public function delete($id) //Pemrakarsa
	{
		$rpl = rpl::find($id);
        $rpl->delete();
        return back()->with('pesan', 'Data RKL-RPL Berhasil di Hapus');
	}

	public function ubah($id) //Pemrakarsa
	{
        $rpl = rpl::find($id);
        return view('home.rpl.edit', compact('rpl'));
    }

	public function update(Request $request, $id) //Pemrakarsa
	{
        $rpl = rpl::find($id);

        $rpl->id_skkl				=	$request->id_skkl;
		$rpl->indikator		        =	$request->indikator;
		$rpl->sumber_dampak			=	$request->sumber_dampak;
		$rpl->metode				=	$request->metode;
		$rpl->lokasi	            =	$request->lokasi;
		$rpl->waktu				    =	$request->waktu;
		$rpl->pelaksana				=	$request->pelaksana;
		$rpl->pengawas				=	$request->pengawas;
		$rpl->penerima				=	$request->penerima;
        $rpl->update();

        return redirect()->route('rpl.create')->with('pesan', 'Data RKL Berhasil di Update');
	}
}
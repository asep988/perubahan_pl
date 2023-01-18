<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rpl;
use App\Skkl;
use Illuminate\Support\Facades\Auth;

class RplController extends Controller
{
    public function create($id)
    {
        $batas = 5;
        $jumlah_rpl = rpl::where('id_skkl', $id)->count();
		$id_skkl = $id;
		$data_rpl = rpl::where('id_skkl', $id)->orderBy('id', 'desc')->paginate($batas);

        $no = $batas * ($data_rpl->currentpage() - 1);
        return view('rpl', compact('data_rpl', 'no', 'jumlah_rpl', 'id_skkl'));
    }

    public function store_rpl(Request $request)
	{
		// $kabkota = implode(", ", $request->kabupaten_kota);
		// $prov = implode(", ", $request->provinsi);

		$id_user = Auth::user()->id;

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

		//savedatabase
		$rpl->save();

		
        return back()->with('pesan', 'Data berhasil diinput');
	}

	public function delete($id)
	{
		$rpl = rpl::find($id);
        $rpl->delete();
        return back()->with('pesan', 'Data RKL-RPL Berhasil di Hapus');
	}

	public function ubah($id){
        $rpl = rpl::find($id);
        return view('rpl_edit', compact('rpl'));
    }

	public function update(Request $request, $id){
        $rpl = rpl::find($id);
		$skkl = Skkl::find($id);

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
        return redirect('/Pemrakarsa/rpl/create/'.$rpl->id_skkl	)->with('pesan', 'Data RKL Berhasil di Update');
	}
}
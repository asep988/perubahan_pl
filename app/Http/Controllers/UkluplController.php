<?php

namespace App\Http\Controllers;

use App\Pkplh;
use App\Uklupl;
use Illuminate\Http\Request;

class UkluplController extends Controller
{
    public function create($id)
    {   
        $id_pkplh = $id;
		$data_uklupl = Uklupl::where('id_pkplh', $id)->orderBy('id', 'desc')->get();

        return view('home.uklupl.index', compact('data_uklupl', 'id_pkplh'));
    }

    public function store(Request $request, $id)
    {
        $uklupl = new Uklupl;
		$uklupl->id_pkplh				=	$id;
		$uklupl->sumber_dampak		    =	$request->sumber_dampak;
		$uklupl->jenis_dampak		    =	$request->jenis_dampak;
		$uklupl->besaran_dampak		    =	$request->besaran_dampak;
		$uklupl->bentuk_pengelolaan		=	$request->bentuk_pengelolaan;
		$uklupl->lokasi_pengelolaan		=	$request->lokasi_pengelolaan;
		$uklupl->periode_pengelolaan	=	$request->periode_pengelolaan;
		$uklupl->bentuk_pemantauan		=	$request->bentuk_pemantauan;
		$uklupl->lokasi_pemantauan		=	$request->lokasi_pemantauan;
		$uklupl->periode_pemantauan		=	$request->periode_pemantauan;
		$uklupl->institusi		    =	$request->institusi;
		$uklupl->keterangan		    =	$request->keterangan;
		$uklupl->save();
		
        return back()->with('pesan', 'Data berhasil diinput'); 
    }

    public function ubah($id)
    {
        $uklupl = Uklupl::find($id);

        return view('home.uklupl.edit', compact('uklupl'));
    }

    public function update(Request $request, $id)
    {
        $uklupl = Uklupl::find($id);
		$uklupl->sumber_dampak		    =	$request->sumber_dampak;
		$uklupl->jenis_dampak		    =	$request->jenis_dampak;
		$uklupl->besaran_dampak		    =	$request->besaran_dampak;
		$uklupl->bentuk_pengelolaan		=	$request->bentuk_pengelolaan;
		$uklupl->lokasi_pengelolaan		=	$request->lokasi_pengelolaan;
		$uklupl->periode_pengelolaan	=	$request->periode_pengelolaan;
		$uklupl->bentuk_pemantauan		=	$request->bentuk_pemantauan;
		$uklupl->lokasi_pemantauan		=	$request->lokasi_pemantauan;
		$uklupl->periode_pemantauan		=	$request->periode_pemantauan;
		$uklupl->institusi		        =	$request->institusi;
		$uklupl->keterangan		        =	$request->keterangan;
		$uklupl->save();

        return redirect()->route('uklupl.create')->with('pesan', 'Data berhasil diperbarui!');
    }

    public function delete($id) //Pemrakarsa
	{
		$uklupl = Uklupl::find($id);
        $uklupl->delete();
        return back()->with('pesan', 'Data Berhasil dihapus !!');
	}
    
}

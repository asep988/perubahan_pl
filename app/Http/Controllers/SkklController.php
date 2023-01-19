<?php

namespace App\Http\Controllers;

use App\il_skkl;
use App\region;
use Illuminate\Http\Request;
use App\Skkl;
use App\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;

class SkklController extends Controller
{
	public function create() //Pemrakarsa
	{
		$provinces = region::where('regency', "")->get();
		$regencies = region::where('regency', '!=', "")
		->where('district', "")
		->get();

		$email = Auth::user()->email;

		return view('home.skkl.form', compact('regencies', 'provinces'));
	}

	public function store(Request $request) //Pemrakarsa
	{
		$request->validate([
			'pelaku_usaha' => 'required',
			'nama_usaha' => 'required',
			'jenis_usaha' => 'required',
			'penanggung' => 'required',
			'nib' => 'required',
			'knli' => 'required',
			'jabatan' => 'required',
			'alamat' => 'required',
			'lokasi' => 'required',
			'pelaku_usaha_baru' => 'required',
			'nama_usaha_baru' => 'required',
			'jenis_usaha_baru' => 'required',
			'penanggung_baru' => 'required',
			'nib_baru' => 'required',
			'knli_baru' => 'required',
			'jabatan_baru' => 'required',
			'alamat_baru' => 'required',
			'lokasi_baru' => 'required',
			'kabupaten_kota' => 'required',
			'provinsi' => 'required',
			'link_drive' => 'required',
			'nomor_pl' => 'required',
			'tgl_pl' => 'required',
			'perihal_surat' => 'required',
			'ruang_lingkup' => 'required',
			'jenis_izin' => 'required',
			'pejabat' => 'required',
			'nomor_sk' => 'required',
			'tgl_surat' => 'required',
			'perihal' => 'required'
		]);

		$id_user = Auth::user()->id;

		$skkl = new Skkl;
		$skkl->user_id 		=   $id_user;
		$skkl->pelaku_usaha =   $request->pelaku_usaha;
		$skkl->nama_usaha	=	$request->nama_usaha;
		$skkl->jenis_usaha	=	$request->jenis_usaha;
		$skkl->penanggung	=	$request->penanggung;
		$skkl->nib			=	$request->nib;
		$skkl->knli			=	$request->knli;
		$skkl->jabatan		=	$request->jabatan;
		$skkl->alamat		=	$request->alamat;
		$skkl->lokasi		=	$request->lokasi;
		$skkl->pelaku_usaha_baru =   $request->pelaku_usaha_baru;
		$skkl->nama_usaha_baru	=	$request->nama_usaha_baru;
		$skkl->jenis_usaha_baru	=	$request->jenis_usaha_baru;
		$skkl->penanggung_baru	=	$request->penanggung_baru;
		$skkl->nib_baru			=	$request->nib_baru;
		$skkl->knli_baru		=	$request->knli_baru;
		$skkl->jabatan_baru		=	$request->jabatan_baru;
		$skkl->alamat_baru		=	$request->alamat_baru;
		$skkl->lokasi_baru		=	$request->lokasi_baru;
		
		$skkl->kabupaten_kota	=	$request->kabupaten_kota;
		$skkl->provinsi			=	$request->provinsi; 
		$skkl->link_drive		=	$request->link_drive;

		$skkl->nomor_pl		=	$request->nomor_pl;
		$skkl->tgl_pl		=	$request->tgl_pl;
		$skkl->perihal		=	$request->perihal_surat;
		$skkl->ruang_lingkup	= $request->ruang_lingkup;
		$skkl->status = "Belum";
		$skkl->save();

		$late = Skkl::orderBy('id', 'DESC')->take(1)->get();
		foreach ($late as $latest) {
			$skkl_id = $latest->id;
		}
		
		for ($i = 0; $i < count($request->jenis_izin); $i++) {
			$il_skkl = new il_skkl;
			$il_skkl->id_skkl = $skkl_id;
			$il_skkl->jenis_sk = $request->jenis_izin[$i];
			$il_skkl->menerbitkan = $request->pejabat[$i];
			$il_skkl->nomor_surat = $request->nomor_sk[$i];
			$il_skkl->tgl_surat = $request->tgl_surat[$i];
			$il_skkl->perihal_surat = $request->perihal[$i];
			$il_skkl->save();
		}

        return redirect()->route('pemrakarsa.index')->with('pesan', 'Data berhasil diinput');
	}

	public function review($id) //Pemrakarsa
	{
		$data_skkl = Skkl::find($id);
		$il_skkl = il_skkl::where('id_skkl', $id)->get();

		return view('home.skkl.review', compact('data_skkl', 'il_skkl'));
	}

	public function edit($id) //Pemrakarsa
	{
		$provinces = region::where('regency', "")->get();
		$regencies = region::where('regency', '!=', "")
		->where('district', "")
		->get();
		$skkl = Skkl::find($id);
		$il_skkl = il_skkl::where('id_skkl', $id)->get();
		$selected_provinces = $skkl->provinsi;
		$selected_kabupaten_kota = $skkl->kabupaten_kota;
		$jum = count($il_skkl);

		return view('home.skkl.edit', compact('provinces', 'regencies', 'skkl', 'jum', 'il_skkl', 'selected_provinces', 'selected_kabupaten_kota'));
	}

	public function update(Request $request, $id) //Pemrakarsa
	{
		$request->validate([
			'pelaku_usaha' => 'required',
			'nama_usaha' => 'required',
			'jenis_usaha' => 'required',
			'penanggung' => 'required',
			'nib' => 'required',
			'knli' => 'required',
			'jabatan' => 'required',
			'alamat' => 'required',
			'lokasi' => 'required',
			'pelaku_usaha_baru' => 'required',
			'nama_usaha_baru' => 'required',
			'jenis_usaha_baru' => 'required',
			'penanggung_baru' => 'required',
			'nib_baru' => 'required',
			'knli_baru' => 'required',
			'jabatan_baru' => 'required',
			'alamat_baru' => 'required',
			'lokasi_baru' => 'required',
			'kabupaten_kota' => 'required',
			'provinsi' => 'required',
			'link_drive' => 'required',
			'nomor_pl' => 'required',
			'tgl_pl' => 'required',
			'perihal_surat' => 'required',
			'ruang_lingkup' => 'required',
			'jenis_izin' => 'required',
			'pejabat' => 'required',
			'nomor_sk' => 'required',
			'tgl_surat' => 'required',
			'perihal' => 'required'
		]);

		$skkl = Skkl::find($id);
		$skkl->pelaku_usaha =   $request->pelaku_usaha;
		$skkl->nama_usaha	=	$request->nama_usaha;
		$skkl->jenis_usaha	=	$request->jenis_usaha;
		$skkl->penanggung	=	$request->penanggung;
		$skkl->nib			=	$request->nib;
		$skkl->knli			=	$request->knli;
		$skkl->jabatan		=	$request->jabatan;
		$skkl->alamat		=	$request->alamat;
		$skkl->lokasi		=	$request->lokasi;
		$skkl->pelaku_usaha_baru =   $request->pelaku_usaha_baru;
		$skkl->nama_usaha_baru	=	$request->nama_usaha_baru;
		$skkl->jenis_usaha_baru	=	$request->jenis_usaha_baru;
		$skkl->penanggung_baru	=	$request->penanggung_baru;
		$skkl->nib_baru			=	$request->nib_baru;
		$skkl->knli_baru		=	$request->knli_baru;
		$skkl->jabatan_baru		=	$request->jabatan_baru;
		$skkl->alamat_baru		=	$request->alamat_baru;
		$skkl->lokasi_baru		=	$request->lokasi_baru;
		
		$skkl->kabupaten_kota	=	$request->kabupaten_kota;
		$skkl->provinsi			=	$request->provinsi; 
		$skkl->link_drive		=	$request->link_drive;

		$skkl->nomor_pl		=	$request->nomor_pl;
		$skkl->tgl_pl		=	$request->tgl_pl;
		$skkl->perihal		=	$request->perihal_surat;
		$skkl->ruang_lingkup	= $request->ruang_lingkup;
		$skkl->status = "Belum";
		$skkl->update();

		il_skkl::where('id_skkl', $id)->delete();
		for ($i = 0; $i < count($request->jenis_izin); $i++) {
			$il_skkl = new il_skkl;
			$il_skkl->id_skkl = $id;
			$il_skkl->jenis_sk = $request->jenis_izin[$i];
			$il_skkl->menerbitkan = $request->pejabat[$i];
			$il_skkl->nomor_surat = $request->nomor_sk[$i];
			$il_skkl->tgl_surat = $request->tgl_surat[$i];
			$il_skkl->perihal_surat = $request->perihal[$i];
			$il_skkl->save();
		}

		return redirect()->route('pemrakarsa.index')->with('pesan', 'Data berhasil diperbarui');
	}

	public function download($id)
	{
		$data_skkl = Skkl::find($id);
        $il_skkl = il_skkl::where('id_skkl', $id)->get();

		$phpWord = new \PhpOffice\PhpWord\PhpWord();
		$section = $phpWord->addSection();
		$report = view('operator.skkl.preview', compact('data_skkl', 'il_skkl'))->render();

		\PhpOffice\PhpWord\Shared\Html::addHtml($section, $report, true);
	}
}

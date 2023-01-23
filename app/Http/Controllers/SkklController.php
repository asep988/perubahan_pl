<?php

namespace App\Http\Controllers;

use App\Skkl;
use App\User;
use App\region;
use App\il_skkl;
use App\initiator;
use App\Pertek_skkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
		$initiator = initiator::where('email', $email)->get();

		return view('home.skkl.form', compact('regencies', 'provinces', 'initiator'));
	}

	public function store(Request $request) //Pemrakarsa
	{
		$id_user = Auth::user()->id;

		DB::beginTransaction();
		$skkl = new Skkl;
		$skkl->user_id 				=   $id_user;
		$skkl->jenis_perubahan 		=   $request->jenis_perubahan;
		$skkl->pelaku_usaha 		=   $request->pelaku_usaha;
		$skkl->penanggung			=	$request->penanggung;
		$skkl->jabatan				=	$request->jabatan;
		$skkl->alamat				=	$request->alamat;
		$skkl->pelaku_usaha_baru 	=   $request->pelaku_usaha_baru;
		$skkl->nama_usaha_baru		=	$request->nama_usaha_baru;
		$skkl->penanggung_baru		=	$request->penanggung_baru;
		$skkl->nib_baru				=	$request->nib_baru;
		$skkl->jabatan_baru			=	$request->jabatan_baru;
		$skkl->alamat_baru			=	$request->alamat_baru;
		$skkl->lokasi_baru			=	$request->lokasi_baru;
		$skkl->nama_kbli			=	$request->nama_kbli;
		$skkl->kbli_baru			=	$request->nomor_kbli;

		$skkl->provinsi				=	$request->provinsi; 
		$skkl->kabupaten_kota		=	$request->kabupaten_kota;
		$skkl->region				=	$request->region;
		$skkl->link_drive			=	$request->link_drive;
		$skkl->nomor_pl				=	$request->nomor_pl;
		$skkl->tgl_pl				=	$request->tgl_pl;
		$skkl->perihal				=	$request->perihal_surat;
		$skkl->pejabat_pl			=	$request->pejabat_pl;
		$skkl->nomor_validasi		=	$request->nomor_validasi;
		$skkl->tgl_validasi			=	$request->tgl_validasi;
		$skkl->jenis_peraturan		=	$request->jenis_peraturan;
		$skkl->pejabat_daerah		=	$request->pejabat_daerah;
		$skkl->nomor_peraturan		=	$request->nomor_peraturan;
		$skkl->perihal_peraturan	=	$request->perihal_peraturan;
		$skkl->ruang_lingkup		= 	$request->ruang_lingkup;
		$skkl->pertek				= 	$request->pertek;
		$skkl->status 				= 	"Belum";
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
		
		for ($i = 0; $i < count($request->pertek); $i++) {
			$pertek_skkl = new Pertek_skkl;
			$pertek_skkl->id_skkl = $skkl_id;
			$pertek_skkl->pertek = $request->pertek[0];
			$pertek_skkl->surat_pertek = $request->surat_pertek[0];
			$pertek_skkl->nomor_pertek = $request->nomor_pertek[0];
			$pertek_skkl->tgl_pertek = $request->tgl_pertek[0];
			$pertek_skkl->perihal_pertek = $request->perihal_pertek[0];
			$pertek_skkl->save();
		}
		DB::commit();

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

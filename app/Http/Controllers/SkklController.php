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
use Illuminate\Support\Facades\Storage;
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
		$request->validate([
			'rintek_upload' => 'nullable|max:5120',
			'rintek_limbah_upload' => 'nullable|max:5120'
		]);

		if (is_array($request->kabupaten_kota)) {
			$kabkota = $request->kabupaten_kota;
		} else {
			$kabkota = array();
			$kabkota[] = $request->kabupaten_kota;
		}

		if (is_array($request->provinsi)) {
			$provinsi = $request->provinsi;
		} else {
			$provinsi = array();
			$provinsi[] = $request->provinsi;
		}
		if (is_array($request->region)) {
			$region = $request->region;
		} else {
			$region = array();
			$region[] = $request->region;
		}

		if (is_array($request->nama_kbli)) {
			$nama_kbli = $request->nama_kbli;
		} else {
			$nama_kbli = array();
			$nama_kbli[] = $request->nama_kbli;
		}

		if (is_array($request->nomor_kbli)) {
			$nomor_kbli = $request->nomor_kbli;
		} else {
			$nomor_kbli = array();
			$nomor_kbli[] = $request->nomor_kbli;
		}

		if (is_array($request->pertek)) {
			$pertek = $request->pertek;
		} else {
			$pertek = array();
			$pertek[] = $request->pertek;
		}

		if (is_array($request->jenis_peraturan)) {
			$jenis_peraturan = $request->jenis_peraturan;
		} else {
			$jenis_peraturan = array();
			$jenis_peraturan[] = $request->jenis_peraturan;
		}

		if (is_array($request->pejabat_daerah)) {
			$pejabat_daerah = $request->pejabat_daerah;
		} else {
			$pejabat_daerah = array();
			$pejabat_daerah[] = $request->pejabat_daerah;
		}

		if (is_array($request->nomor_peraturan)) {
			$nomor_peraturan = $request->nomor_peraturan;
		} else {
			$nomor_peraturan = array();
			$nomor_peraturan[] = $request->nomor_peraturan;
		}

		if (is_array($request->perihal_peraturan)) {
			$perihal_peraturan = $request->perihal_peraturan;
		} else {
			$perihal_peraturan = array();
			$perihal_peraturan[] = $request->perihal_peraturan;
		}

		if ($request->rintek_upload) {
			$file1 = $request->file('rintek_upload');
			$format1 = $file1->getClientOriginalExtension();
			$fileName1 = time() . '_rintek.' . $format1; //Variabel yang menampung nama file
			$file1->storeAs('files/skkl/rintek', $fileName1); //Simpan ke Storage
		} else {
			$fileName1 = null;
		}

		if ($request->rintek_limbah_upload) {
			$file2 = $request->file('rintek_limbah_upload');
			$format2 = $file2->getClientOriginalExtension();
			$fileName2 = time() . '_rintek_limbah.' . $format2; //Variabel yang menampung nama file
			$file2->storeAs('files/skkl/rintek', $fileName2); //Simpan ke Storage
		} else {
			$fileName2 = null;
		}

		DB::beginTransaction();
		$skkl = new Skkl;
		$skkl->user_id 				=   $id_user;
		$skkl->jenis_perubahan 		=   $request->jenis_perubahan;

		if ($request->jenis_perubahan != "perkep3") {
			$skkl->pelaku_usaha 	=   $request->pelaku_usaha;
			$skkl->penanggung		=	$request->penanggung;
			$skkl->jabatan			=	$request->jabatan;
			$skkl->alamat			=	$request->alamat;
		}

		$skkl->pelaku_usaha_baru 	=   $request->pelaku_usaha_baru;
		$skkl->nama_usaha_baru		=	$request->nama_usaha_baru;
		$skkl->penanggung_baru		=	$request->penanggung_baru;
		$skkl->nib_baru				=	$request->nib_baru;
		$skkl->jabatan_baru			=	$request->jabatan_baru;
		$skkl->alamat_baru			=	$request->alamat_baru;
		$skkl->lokasi_baru			=	$request->lokasi_baru;
		$skkl->nama_kbli			=	$nama_kbli;
		$skkl->kbli_baru			=	$nomor_kbli;
		$skkl->rintek_upload		=	$fileName1;
		$skkl->rintek_limbah_upload	=	$fileName2;

		$skkl->provinsi				=	$provinsi; 
		$skkl->kabupaten_kota		=	$kabkota;
		$skkl->region				=	$region;
		$skkl->link_drive			=	$request->link_drive;
		$skkl->pic_pemohon			=	$request->pic_pemohon;
		$skkl->no_hp_pic			=	$request->no_hp_pic;
		$skkl->nomor_pl				=	$request->nomor_pl;
		$skkl->tgl_pl				=	$request->tgl_pl;
		$skkl->perihal				=	$request->perihal_surat;
		$skkl->pejabat_pl			=	$request->pejabat_pl;
		$skkl->nomor_validasi		=	$request->nomor_validasi;
		$skkl->tgl_validasi			=	$request->tgl_validasi;
		$skkl->jenis_peraturan		=	$jenis_peraturan;
		$skkl->pejabat_daerah		=	$pejabat_daerah;
		$skkl->nomor_peraturan		=	$nomor_peraturan;
		$skkl->perihal_peraturan	=	$perihal_peraturan;
		$skkl->ruang_lingkup		= 	$request->ruang_lingkup;
		$skkl->pertek				= 	$pertek;
		$skkl->pend_tek				= 	$request->pend_tek;
		$skkl->pend_sos				= 	$request->pend_sos;
		$skkl->pend_institut		= 	$request->pend_institut;
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
		
		if ($request->jenis_perubahan != "perkep1") {
			for ($i = 0; $i < count($request->judul_pertek); $i++) {
				$pertek_skkl = new Pertek_skkl;
				$pertek_skkl->id_skkl = $skkl_id;
				$pertek_skkl->pertek = $request->pertek[$i];
				$pertek_skkl->judul_pertek = $request->judul_pertek[$i];
				$pertek_skkl->surat_pertek = $request->surat_pertek[$i];
				$pertek_skkl->nomor_pertek = $request->nomor_pertek[$i];
				$pertek_skkl->tgl_pertek = $request->tgl_pertek[$i];
				$pertek_skkl->perihal_pertek = $request->perihal_pertek[$i];
				$pertek_skkl->save();
			}
		}
		DB::commit();

        return redirect()->route('pemrakarsa.index')->with('pesan', 'Data berhasil diinput');
	}

	public function review($id) //Pemrakarsa
	{
		$data_skkl = Skkl::find($id);
		$il_skkl = il_skkl::where('id_skkl', $id)->get();
		$pertek_skkl = Pertek_skkl::where('id_skkl', $id)->get();

		return view('home.skkl.review', compact('data_skkl', 'il_skkl', 'pertek_skkl'));
	}

	public function edit($id) //Pemrakarsa
	{
		$email = Auth::user()->email;
		$initiator = initiator::where('email', $email)->get();
		$provinces = region::where('regency', "")->get();
		$regencies = region::where('regency', '!=', "")
		->where('district', "")
		->get();

		$skkl = Skkl::find($id);
		$il_skkl = il_skkl::where('id_skkl', $id)->get();
		$pertek_skkl = Pertek_skkl::where('id_skkl', $id)->get();

		$selected_provinces = $skkl->provinsi;
		$selected_kabupaten_kota = $skkl->kabupaten_kota;
		$jum = count($il_skkl);

		return view('home.skkl.edit', compact('provinces', 'regencies', 'skkl', 'jum', 'il_skkl', 'initiator', 'selected_provinces', 'selected_kabupaten_kota', 'pertek_skkl'));
	}

	public function update(Request $request, $id) //Pemrakarsa
	{
		$id_user = Auth::user()->id;
		$request->validate([
			'rintek_upload' => 'nullable|max:5120',
			'rintek_limbah_upload' => 'nullable|max:5120'
		]);

		if (is_array($request->kabupaten_kota)) {
			$kabkota = $request->kabupaten_kota;
		} else {
			$kabkota = array();
			$kabkota[] = $request->kabupaten_kota;
		}

		if (is_array($request->provinsi)) {
			$provinsi = $request->provinsi;
		} else {
			$provinsi = array();
			$provinsi[] = $request->provinsi;
		}
		if (is_array($request->region)) {
			$region = $request->region;
		} else {
			$region = array();
			$region[] = $request->region;
		}

		if (is_array($request->nama_kbli)) {
			$nama_kbli = $request->nama_kbli;
		} else {
			$nama_kbli = array();
			$nama_kbli[] = $request->nama_kbli;
		}

		if (is_array($request->nomor_kbli)) {
			$nomor_kbli = $request->nomor_kbli;
		} else {
			$nomor_kbli = array();
			$nomor_kbli[] = $request->nomor_kbli;
		}

		if (is_array($request->pertek)) {
			$pertek = $request->pertek;
		} else {
			$pertek = array();
			$pertek[] = $request->pertek;
		}

		if (is_array($request->jenis_peraturan)) {
			$jenis_peraturan = $request->jenis_peraturan;
		} else {
			$jenis_peraturan = array();
			$jenis_peraturan[] = $request->jenis_peraturan;
		}

		if (is_array($request->pejabat_daerah)) {
			$pejabat_daerah = $request->pejabat_daerah;
		} else {
			$pejabat_daerah = array();
			$pejabat_daerah[] = $request->pejabat_daerah;
		}

		if (is_array($request->nomor_peraturan)) {
			$nomor_peraturan = $request->nomor_peraturan;
		} else {
			$nomor_peraturan = array();
			$nomor_peraturan[] = $request->nomor_peraturan;
		}

		if (is_array($request->perihal_peraturan)) {
			$perihal_peraturan = $request->perihal_peraturan;
		} else {
			$perihal_peraturan = array();
			$perihal_peraturan[] = $request->perihal_peraturan;
		}

		$data = Skkl::find($id);

		if ($request->rintek_upload) {
			$destination = 'files/skkl/rintek/' . $data->rintek_upload;
			if ($destination) {
				Storage::delete($destination);
			}

			$file1 = $request->file('rintek_upload');
			$format1 = $file1->getClientOriginalExtension();
			$fileName1 = time() . '_rintek.' . $format1; //Variabel yang menampung nama file
			$file1->storeAs('files/skkl/rintek', $fileName1); //Simpan ke Storage
		} else {
			$fileName1 = null;
		}

		if ($request->rintek_limbah_upload) {
			$destination = 'files/skkl/rintek/' . $data->rintek_limbah_upload;
			if ($destination) {
				Storage::delete($destination);
			}

			$file2 = $request->file('rintek_limbah_upload');
			$format2 = $file2->getClientOriginalExtension();
			$fileName2 = time() . '_rintek_limbah.' . $format2; //Variabel yang menampung nama file
			$file2->storeAs('files/skkl/rintek', $fileName2); //Simpan ke Storage
		} else {
			$fileName2 = null;
		}

		DB::beginTransaction();
		$skkl = Skkl::find($id);
		$skkl->user_id 				=   $id_user;
		$skkl->jenis_perubahan 		=   $request->jenis_perubahan;
		
		if ($request->jenis_perubahan != "perkep3") {
			$skkl->pelaku_usaha 	=   $request->pelaku_usaha;
			$skkl->penanggung		=	$request->penanggung;
			$skkl->jabatan			=	$request->jabatan;
			$skkl->alamat			=	$request->alamat;
		}

		$skkl->pelaku_usaha_baru 	=   $request->pelaku_usaha_baru;
		$skkl->nama_usaha_baru		=	$request->nama_usaha_baru;
		$skkl->penanggung_baru		=	$request->penanggung_baru;
		$skkl->nib_baru				=	$request->nib_baru;
		$skkl->jabatan_baru			=	$request->jabatan_baru;
		$skkl->alamat_baru			=	$request->alamat_baru;
		$skkl->lokasi_baru			=	$request->lokasi_baru;
		$skkl->nama_kbli			=	$nama_kbli;
		$skkl->kbli_baru			=	$nomor_kbli;
		$skkl->rintek_upload		=	$fileName1;
		$skkl->rintek_limbah_upload	=	$fileName2;

		$skkl->provinsi				=	$provinsi; 
		$skkl->kabupaten_kota		=	$kabkota;
		$skkl->region				=	$region;
		$skkl->link_drive			=	$request->link_drive;
		$skkl->pic_pemohon			=	$request->pic_pemohon;
		$skkl->no_hp_pic			=	$request->no_hp_pic;
		$skkl->nomor_pl				=	$request->nomor_pl;
		$skkl->tgl_pl				=	$request->tgl_pl;
		$skkl->perihal				=	$request->perihal_surat;
		$skkl->pejabat_pl			=	$request->pejabat_pl;
		$skkl->nomor_validasi		=	$request->nomor_validasi;
		$skkl->tgl_validasi			=	$request->tgl_validasi;
		$skkl->jenis_peraturan		=	$jenis_peraturan;
		$skkl->pejabat_daerah		=	$pejabat_daerah;
		$skkl->nomor_peraturan		=	$nomor_peraturan;
		$skkl->perihal_peraturan	=	$perihal_peraturan;
		$skkl->ruang_lingkup		= 	$request->ruang_lingkup;
		$skkl->pertek				= 	$pertek;
		$skkl->pend_tek				= 	$request->pend_tek;
		$skkl->pend_sos				= 	$request->pend_sos;
		$skkl->pend_institut		= 	$request->pend_institut;
		$skkl->status 				= 	"Belum";
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

		if ($request->jenis_perubahan != 'perkep1') {
			Pertek_skkl::where('id_skkl', $id)->delete();
			for ($i = 0; $i < count($request->judul_pertek); $i++) {
				$pertek_skkl = new Pertek_skkl;
				$pertek_skkl->id_skkl = $id;
				$pertek_skkl->pertek = $request->pertek[$i];
				$pertek_skkl->judul_pertek = $request->judul_pertek[$i];
				$pertek_skkl->surat_pertek = $request->surat_pertek[$i];
				$pertek_skkl->nomor_pertek = $request->nomor_pertek[$i];
				$pertek_skkl->tgl_pertek = $request->tgl_pertek[$i];
				$pertek_skkl->perihal_pertek = $request->perihal_pertek[$i];
				$pertek_skkl->save();
			}
		}
		DB::commit();

		return redirect()->route('pemrakarsa.index')->with('pesan', 'Data berhasil diperbarui');
	}

	public function download_lampiranI($id)
	{
		$skkl = Skkl::find($id);
		$il_skkl = il_skkl::where('id_skkl', $id)->get();

		$headers = array(
			"Content-type" => "text/html",

			"Content-Disposition" => "attachment; Filename=LampiranI_$skkl->pelaku_usaha_baru.doc"
		);

		$body = '
		<style>
			body {
				font-family:"Bookman Old Style,serif";
			}
		</style>';
		$body .='
			<table>
				<tr>
					<td>
						LAMPIRAN I <br>
						KEPUTUSAN MENTRI LINGKUNGAN HIDUP <br>
						DAN KEHUTANAN REPUBLIK INDONESIA <br>
						NOMOR <br>
						TENTANG KELAYAKAN LINGKUNGAN HIDUP LEGIATAN '. strtoupper($skkl->nama_usaha_baru).' 
						OLEH '.strtoupper($skkl->pelaku_usaha_baru).'
					</td>
					<br><br>
					PENDEKATAN PENGELOLAAN LINGKUNGAN
					<br><br>
					<ol typr="A">
						<li>
							Pendekatan Teknologi<br>
							<p style="text-align: justify; text-justify: inter-word;">'.$skkl->pend_tek.'</p>
						</li>
						<li>
							Pendekatan Sosial dan Ekonomi<br>
							<p style="text-align: justify; text-justify: inter-word;">'.$skkl->pend_sos.'</p>
						</li>
						<li>
							Pendekatan Institusi
							<p style="text-align: justify; text-justify: inter-word;">'.$skkl->pend_institut.'</p>
						</li>
					</ol>
				</tr>';
		$body .='
			</table>';
		$body .='
			<table>
			<tr>
				<td width="50%">&nbsp;</td>
				<td width="50%">
					<table>       
						<tr>
							<td colspan="2">MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
							<br><br><br><br><br><br>
							SITI NURBAYA
							</td>
						</tr>       
					</table>
				</td>
			</tr>';
		$body .='
			</table>';

			return \Response::make($body, 200, $headers);
	}

	public function download_pertek(Request $request ,$id)
	{
		$skkl = Skkl::find($id);
		$pertek = Pertek_skkl::where('id_skkl', $id)->get();

		$data = array();
		foreach ($pertek as $row) {
			$data[] = $row->pertek;
		}

		if ($request->pertek == "pertek1") {
			$isi = "Persetujuan Teknis Pemenuhan Baku Mutu Air Limbah";
			$index = array_search('pertek1', $data);
			$roman = 3 + $index;
		}
		if ($request->pertek == "pertek2") {
			$isi = "Persetujuan Teknis Pemenuhan Baku Mutu Emisi";
			$index = array_search('pertek2', $data);
			$roman = 3 + $index;
		}
		if ($request->pertek == "pertek3") {
			$isi = "Persetujuan Teknis Di Bidang Pengelolaan Limbah B3";
			$index = array_search('pertek3', $data);
			$roman = 3 + $index;
		}
		if ($request->pertek == "pertek4") {
			$isi = "Persetujuan Teknis Andalalin";
			$index = array_search('pertek4', $data);
			$roman = 3 + $index;
		}
		if ($request->pertek == "pertek5") {
			$isi = "Persetujuan Teknis Dokumen Rincian Teknis";
			$index = array_search('pertek5', $data);
			$roman = 3 + $index;
		}

		$headers = array(
			"Content-type" => "text/html",

			"Content-Disposition" => "attachment; Filename=Pertek_$skkl->pelaku_usaha_baru.doc"
		);

		$body = '
		<style>
			body {
				font-family:"Bookman Old Style,serif";
			}
		</style>';
		$body .='
			<table>
				<tr>
					<td>
						LAMPIRAN '. integerToRoman($roman) .' <br>
						KEPUTUSAN MENTRI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA <br>
						NOMOR <br>
						TENTANG KELAYAKAN LINGKUNGAN HIDUP KEGIATAN '.strtoupper($skkl->nama_usaha_baru).' 
						OLEH '. strtoupper($skkl->pelaku_usaha_baru).'
					</td>
				</tr>
					<br><br><br>
				<tr>
					<td>
						'. strtoupper($isi) .' UNTUK '.strtoupper($pertek[$index]->judul_pertek).'
					</td>
				</tr>
					<br><br>
				<tr>
					<td>
						Berdasarkan Surat '.ucfirst($pertek[$index]->surat_pertek).'
						Nomor: '.strtoupper($pertek[$index]->nomor_pertek).'
						tanggal '. tgl_indo($pertek[$index]->tgl_pertek).'
						tentang '.ucfirst($pertek[$index]->perihal_pertek).';
					</td>
				</tr>';
		$body .='
			</table>';
		$body .='
			<table>
			<tr>
				<td width="50%">&nbsp;</td>
				<td width="50%">
					<table>       
						<tr>
							<td colspan="2">MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
							<br><br><br><br><br><br>
							SITI NURBAYA
							</td>
						</tr>       
					</table>
				</td>
			</tr>';
		$body .='
			</table>';

			return \Response::make($body, 200, $headers);
	}

	public function download_rintek($id)
	{
		$skkl = Skkl::find($id);
		$il_skkl = il_skkl::where('id_skkl', $id)->get();
		$pertek = Pertek_skkl::where('id_skkl', $id)->get();
		$roman = 2 + count($pertek);

		$headers = array(
			"Content-type" => "text/html",

			"Content-Disposition" => "attachment; Filename=Rintek_$skkl->pelaku_usaha_baru.doc"
		);

		$body = '
		<style>
			body {
				font-family:"Bookman Old Style,serif";
			}
		</style>';
		$body .='
			<table>
				<tr>
					<td>
						LAMPIRAN ' . integerToRoman($roman) . ' <br>
						KEPUTUSAN MENTRI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA <br>
						NOMOR <br>
						TENTANG KELAYAKAN LINGKUNGAN HIDUP KEGIATAN '.strtoupper($skkl->nama_usaha_baru).' 
						OLEH '. strtoupper($skkl->pelaku_usaha_baru).'
					</td>
				</tr>
					<br><br><br>
				<tr>
					<td>
						<b>RINCIAN TEKNIS PENYIMPANAN LIMBAH B3</b>
					</td>
				</tr>
					<br><br>
				<tr>
					<td>
						
					</td>
				</tr>';
		$body .='
			</table>';
		$body .='
			<table>
			<tr>
				<td width="50%">&nbsp;</td>
				<td width="50%">
					<table>       
						<tr>
							<td colspan="2">MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
							<br><br><br><br><br><br>
							SITI NURBAYA
							</td>
						</tr>       
					</table>
				</td>
			</tr>';
		$body .='
			</table>';

			return \Response::make($body, 200, $headers);
	}

}
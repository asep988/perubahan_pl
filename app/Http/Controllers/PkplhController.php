<?php

namespace App\Http\Controllers;

use App\User;
use App\Pkplh;
use App\region;
use App\il_pkplh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class PkplhController extends Controller
{
    public function index()
    {
        $user_id =  Auth::user()->id;
        $data_pkplh = Pkplh::where('user_id',$user_id)->orderBy('updated_at', 'desc')->get();

        return view('home.pkplh.index', compact('data_pkplh'));
    }

    public function create()
	{
		$provinces = region::where('regency', "")->get();
		$regencies = region::where('regency', '!=', "")
		->where('district', "")
		->get();

		$email = Auth::user()->email;

		return view('home.pkplh.form', compact('regencies', 'provinces'));
	}

	public function store(Request $request)
	{
		$request->validate([
			'pelaku_usaha' => 'required',
			'nama_usaha' => 'required',
			'jenis_usaha' => 'required',
			'penanggung' => 'required',
			'nib' => 'required',
			'kbli' => 'required',
			'jabatan' => 'required',
			'alamat' => 'required',
			'lokasi' => 'required',
			'pelaku_usaha_baru' => 'required',
			'nama_usaha_baru' => 'required',
			'jenis_usaha_baru' => 'required',
			'penanggung_baru' => 'required',
			'nib_baru' => 'required',
			'kbli_baru' => 'required',
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

		// $kabkota = implode(", ", $request->kabupaten_kota);
		// $prov = implode(", ", $request->provinsi);
		$id_user = Auth::user()->id;

		// return $kabkota;
		$pkplh = new Pkplh;
		$pkplh->user_id 		    =   $id_user;
		$pkplh->pelaku_usaha        =   $request->pelaku_usaha;
		$pkplh->nama_usaha	        =	$request->nama_usaha;
		$pkplh->jenis_usaha	        =	$request->jenis_usaha;
		$pkplh->penanggung	        =	$request->penanggung;
		$pkplh->nib			        =	$request->nib;
		$pkplh->kbli			    =	$request->kbli;
		$pkplh->jabatan		        =	$request->jabatan;
		$pkplh->alamat		        =	$request->alamat;
		$pkplh->lokasi		        =	$request->lokasi;
		$pkplh->pelaku_usaha_baru   =   $request->pelaku_usaha_baru;
		$pkplh->nama_usaha_baru	    =	$request->nama_usaha_baru;
		$pkplh->jenis_usaha_baru	=	$request->jenis_usaha_baru;
		$pkplh->penanggung_baru	    =	$request->penanggung_baru;
		$pkplh->nib_baru			=	$request->nib_baru;
		$pkplh->kbli_baru		    =	$request->kbli_baru;
		$pkplh->jabatan_baru		=	$request->jabatan_baru;
		$pkplh->alamat_baru		    =	$request->alamat_baru;
		$pkplh->lokasi_baru		    =	$request->lokasi_baru;
		
		$pkplh->kabupaten_kota	    =	$request->kabupaten_kota;
		$pkplh->provinsi			=	$request->provinsi; 
		$pkplh->link_drive		    =	$request->link_drive;

		$pkplh->nomor_pl		    =	$request->nomor_pl;
		$pkplh->tgl_pl		        =	$request->tgl_pl;
		$pkplh->perihal		        =	$request->perihal_surat;
		$pkplh->ruang_lingkup	    = $request->ruang_lingkup;
		$pkplh->status              = "Belum";
		$pkplh->save();

		$late = Pkplh::orderBy('id', 'DESC')->take(1)->get();
		foreach ($late as $latest) {
			$pkplh_id = $latest->id;
		}
		
		for ($i = 0; $i < count($request->jenis_izin); $i++) {
			$il_pkplh = new il_pkplh;
			$il_pkplh->id_pkplh = $pkplh_id;
			$il_pkplh->jenis_sk = $request->jenis_izin[$i];
			$il_pkplh->menerbitkan = $request->pejabat[$i];
			$il_pkplh->nomor_surat = $request->nomor_sk[$i];
			$il_pkplh->tgl_surat = $request->tgl_surat[$i];
			$il_pkplh->perihal_surat = $request->perihal[$i];
			$il_pkplh->save();
		}

        return redirect()->route('pkplh.index')->with('pesan', 'Data berhasil diinput');
	}

	public function review($id)
	{
		$data_pkplh = Pkplh::find($id);
		$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();

		return view('home.pkplh.review', compact('data_pkplh', 'il_pkplh'));
	}

	//OPERATOR
	public function operatorIndex()
	{
		$data_pkplh = Pkplh::orderBy('updated_at', 'DESC')->get();

		return view('operator.pkplh.index', compact('data_pkplh'));
	}

	public function uploadFile(Request $request)
	{
		$request->validate([
            'file' => 'required|mimes:pdf|max:5120',
            'status' => 'required'
        ]);

        if ($request->status == "draft") {
            $status = "Belum";
        } else {
            $status = "Selesai";
        }

        $id = $request->id_pkplh;
        $pkplh_id = Pkplh::find($id);

        $destination = 'files/pkplh/' . $pkplh_id->file;
        if ($destination) {
            Storage::delete($destination);
        }

        $file = $request->file('file');
        $format = $file->getClientOriginalExtension();
        $fileName = time() . '_pkplh.' . $format; //Variabel yang menampung nama file
        $file->storeAs('files/pkplh', $fileName); //Simpan ke Storage

        Pkplh::find($id)->update([
            'status' => $status,
            'file' => $fileName
        ]);

        return back()->with('message', 'PDF berhasil diupload!');
	}

	public function destroyFile($id)
    {
        $pkplh = Pkplh::find($id);
        $destination = 'files/pkplh/' . $pkplh->file;
        if ($destination) {
            Storage::delete($destination);
        }

        $pkplh->update([
            'file' => null
        ]);

        return back()->with('message', 'PDF berhasil dihapus!');
    }

	public function edit($id) //Pemrakarsa
	{
		$provinces = region::where('regency', "")->get();
		$regencies = region::where('regency', '!=', "")
		->where('district', "")
		->get();
		$pkplh = Pkplh::find($id);
		$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();
		$selected_provinces = $pkplh->provinsi;
		$selected_kabupaten_kota = $pkplh->kabupaten_kota;
		$jum = count($il_pkplh);

		return view('home.pkplh.edit', compact('provinces', 'regencies', 'pkplh', 'jum', 'il_pkplh', 'selected_provinces', 'selected_kabupaten_kota'));
	}

	public function update(Request $request, $id) //Pemrakarsa
	{
		$request->validate([
			'pelaku_usaha' => 'required',
			'nama_usaha' => 'required',
			'jenis_usaha' => 'required',
			'penanggung' => 'required',
			'nib' => 'required',
			'kbli' => 'required',
			'jabatan' => 'required',
			'alamat' => 'required',
			'lokasi' => 'required',
			'pelaku_usaha_baru' => 'required',
			'nama_usaha_baru' => 'required',
			'jenis_usaha_baru' => 'required',
			'penanggung_baru' => 'required',
			'nib_baru' => 'required',
			'kbli_baru' => 'required',
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

		$pkplh = Pkplh::find($id);
		$pkplh->pelaku_usaha =   $request->pelaku_usaha;
		$pkplh->nama_usaha	=	$request->nama_usaha;
		$pkplh->jenis_usaha	=	$request->jenis_usaha;
		$pkplh->penanggung	=	$request->penanggung;
		$pkplh->nib			=	$request->nib;
		$pkplh->kbli		=	$request->kbli;
		$pkplh->jabatan		=	$request->jabatan;
		$pkplh->alamat		=	$request->alamat;
		$pkplh->lokasi		=	$request->lokasi;
		//menjadi
		$pkplh->pelaku_usaha_baru =   $request->pelaku_usaha_baru;
		$pkplh->nama_usaha_baru	=	$request->nama_usaha_baru;
		$pkplh->jenis_usaha_baru	=	$request->jenis_usaha_baru;
		$pkplh->penanggung_baru	=	$request->penanggung_baru;
		$pkplh->nib_baru			=	$request->nib_baru;
		$pkplh->kbli_baru		=	$request->kbli_baru;
		$pkplh->jabatan_baru		=	$request->jabatan_baru;
		$pkplh->alamat_baru		=	$request->alamat_baru;
		$pkplh->lokasi_baru		=	$request->lokasi_baru;
		
		$pkplh->kabupaten_kota	=	$request->kabupaten_kota;
		$pkplh->provinsi			=	$request->provinsi; 
		$pkplh->link_drive		=	$request->link_drive;

		$pkplh->nomor_pl		=	$request->nomor_pl;
		$pkplh->tgl_pl		=	$request->tgl_pl;
		$pkplh->perihal		=	$request->perihal_surat;
		$pkplh->ruang_lingkup	= $request->ruang_lingkup;
		$pkplh->status = "Belum";
		$pkplh->update();

		il_pkplh::where('id_pkplh', $id)->delete();
		for ($i = 0; $i < count($request->jenis_izin); $i++) {
			$il_pkplh = new il_pkplh;
			$il_pkplh->id_pkplh = $id;
			$il_pkplh->jenis_sk = $request->jenis_izin[$i];
			$il_pkplh->menerbitkan = $request->pejabat[$i];
			$il_pkplh->nomor_surat = $request->nomor_sk[$i];
			$il_pkplh->tgl_surat = $request->tgl_surat[$i];
			$il_pkplh->perihal_surat = $request->perihal[$i];
			$il_pkplh->save();
		}

		return redirect()->route('pkplh.index')->with('pesan', 'Data berhasil diperbarui');
	}

	public function operatorPreview($id) //OPERATOR
	{
		$data_pkplh = Pkplh::find($id);
		$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();

		return view('operator.pkplh.preview', compact('data_pkplh', 'il_pkplh'));
	}

	public function download($id)
    {
        //phpword

        $pkplh = Pkplh::find($id);
        $il_pkplh = il_pkplh::where('id_pkplh', $id)->get();
        $kabkota = implode(", ", $pkplh->kabupaten_kota);
        $prov = implode(", ", $pkplh->provinsi);

        $loopkk1 = "";
        for ($i = 0; $i < count($pkplh->kabupaten_kota); $i++) {
            $loopkk1 .= "<li>Bupati/Walikota " . ucwords(strtolower($pkplh->kabupaten_kota[$i])) . "</li>";
        }

        $loopprov1 = "";
        for ($i = 0; $i < count($pkplh->provinsi); $i++) {
            $loopprov1 .= "<li>Gubernur " . ucwords(strtolower($pkplh->provinsi[$i])) . "</li>";
        }

        $loopkk2 = "";
        for ($i = 0; $i < count($pkplh->kabupaten_kota); $i++) {
            $loopkk2 .= "<li>Bupati/Walikota " . ucwords(strtolower($pkplh->kabupaten_kota[$i])) . " melalui Kepala Dinas Lingkungan Hidup Kabupaten/Kota " . ucwords(strtolower($pkplh->kabupaten_kota[$i])) . "</li>";
        }

        $loopprov2 = "";
        for ($i = 0; $i < count($pkplh->provinsi); $i++) {
            $loopprov2 .= "<li>Gubernur " . ucwords(strtolower($pkplh->provinsi[$i])) . " melalui Kepala Dinas Lingkungan Hidup Provinsi " . ucwords(strtolower($pkplh->provinsi[$i])) . "</li>";
        }

        $il_dkk = "";
        for ($i = 0; $i < count($il_pkplh); $i++) {
            $il_dkk .= "<li>" . $il_pkplh[$i]->jenis_sk . " " . $il_pkplh[$i]->menerbitkan . " Nomor " . $il_pkplh[$i]->nomor_surat . " tanggal " . date("d m Y", strtotime($il_pkplh[$i]->tgl_surat)) . " tentang " . $il_pkplh[$i]->perihal_surat . "</li>";
        }

        $headers = array(

            "Content-type" => "text/html",

            "Content-Disposition" => "attachment;Filename=PKPLH_$pkplh->pelaku_usaha_baru.doc"

        );

        $body = '
        <style>
            body {
                font-family:"Bookman Old Style,serif";
            }
            ol {
            columns:2;
            }
            ol > li.list_kurung::marker {
            content:counter(list-item) ")\2003";
            }
            td {
                vertical-align: top;
                text-align: justify;
            }
        </style>';

        $body .=
        'LAMPIRAN ...
        <br><br><br><br>
        <table width="100%">
            <tr>
    <td colspan="3" width="100%">
        <center>KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN<br>REPUBLIK INDONESIA<br> 
            NOMOR .....<br><br>TENTANG<br><br>
            PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN<br>
            HIDUP USAHA DAN/ATAU KEGIATAN' . \strtoupper($pkplh->nama_usaha_baru) .
                ' DI ' . strtoupper($kabkota) . ' OLEH '. strtoupper($pkplh->pelaku_usaha_baru) . ' <br><br>
            DENGAN RAHMAT TUHAN YANG MAHA ESA<br><br>MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
        <center>    
    </td>
    </tr>
    <tr>
    <td width="30%">
        Menimbang
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        <ol style="list-style-type: lower-alpha;">
            <li>bahwa berdasarkan ketentuan:</li>
                <ol>
                    <li class="list_kurung">Pasal 3 ayat (1): Persetujuan Lingkungan wajib dimiliki oleh setiap Usaha dan/atau Kegiatan yang memiliki Dampak Penting atau tidak penting terhadap lingkungan;</li>
                    <li class="list_kurung">Pasal 3 ayat (2): Persetujuan Lingkungan diberikan kepada Pelaku Usaha atau Instansi Pemerintah;</li>
                    <li class="list_kurung">Pasal 3 ayat (3): Persetujuan Lingkungan menjadi prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah;</li>
                    <li class="list_kurung">Pasal 3 ayat (4): Persetujuan Lingkungan dilakukan melalui penyusunan Amdal dan uji kelayakan Amdal;</li>
                    <li class="list_kurung">Pasal 64 ayat (1) : Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup merupakan: a. bentuk persetujuan Lingkungan Hidup; dan b. prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah</li>
                    <li class="list_kurung">Pasal 89 ayat (1) : Penanggungjawab Usaha dan/atau Kegiatan wajib melakukan perubahan Persetujuan Lingkungan apabila Usaha dan/atau Kegiatannya yang telah memperoleh surat Keputusan Kelayakan Lingkungan Hidup atau persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup direncanakan untuk dilakukan perubahan;</li>
                    <li class="list_kurung">Pasal 89 ayat (2) : Perubahan Persetujuan Lingkungan dilakukan melalui: a. perubahan Persetujuan Lingkungan dengan kewajiban menyusun dokumen lingkungan hidup baru; atau b. perubahan Persetujuan Lingkungan tanpa disertai kewajiban menyusun dokumen lingkungan hidup baru;</li>
                </ol>
            <li>bahwa ' . $pkplh->jabatan . ' melalui surat Nomor: ' . $pkplh->nomor_pl . ' Tanggal ' . $pkplh->tgl_pl . ' perihal ' . $pkplh->perihal . ' mengajukan permohonan perubahan persetujuan lingkungan kepada Menteri Lingkungan Hidup dan Kehutanan;</li>
            <li>bahwa terhadap permohonan sebagaimana dimaksud dalam huruf b, penanggung jawab usaha dan/atau kegiatan telah memiliki persetujuan lingkungan berdasarkan:<br>
            <ol>' . $il_dkk . '</ol></li>
            <li>berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a sampai dengan huruf c, perlu menetapkan Keputusan Menteri Lingkungan Hidup dan Kehutanan Republik Indonesia Tentang Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup Usaha dan/atau Kegiatan ' . $pkplh->nama_usaha_baru . ' di ' . ucwords(strtolower($kabkota)) . ' Provinsi ' . ucwords(strtolower($prov)) . ' oleh ' . $pkplh->pelaku_usaha_baru . '</li>
        </ol>
    </td>
    </tr>
    <tr>
    <td width="30%" >
*       Mengingat
    </td>
    <td width="5%"> :</td>
    <td width="65%">
    <ol>
        <li>Undang-Undang Nomor 32 Tahun 2009 tentang Perlindungan dan 
            Pengelolaan Lingkungan Hidup (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 140, Tambahan Lembaran Negara Republik Indonesia Nomor 5059) sebagaimana telah diubah dengan Peraturan Pemerintah Pengganti Undang-Undang Nomor 2 Tahun 2022 Tentang Cipta Kerja (Lembaran Negara Republik Indonesia Tahun 2022 Nomor 238);</li>
        <li>Peraturan Pemerintah Nomor 5 Tahun 2021 tentang Penyelenggaraan 
            Perizinan Berusaha Berbasis Risiko (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 15, Tambahan Lembaran Negara Republik Indonesia Nomor 6617);</li>
        <li>Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Perlindungan 
            Pengelolaan Lingkungan Hidup (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 32, Tambahan Lembaran Negara Republik Indonesia Nomor 6634);</li>
        <li>Peraturan Presiden Nomor 68 Tahun 2019 tentang Organisasi 
            Kementerian Negara (Lembaran Negara Republik Indonesia Tahun 2019 Nomor 203), sebagaimana telah diubah dengan Peraturan Presiden Nomor 32 Tahun 2021 tentang Perubahan atas Peraturan Presiden Nomor 68 Tahun 2019 (Lembaran Negara Republik Indonesia Nomor 106);</li>
        <li>Peraturan Presiden Nomor 92 Tahun 2020 tentang Kementerian 
            Lingkungan Hidup dan Kehutanan (Lembaran Negara Republik Indonesia Tahun 2020 Nomor 209);</li>
        <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 4 Tahun 
            2021 tentang Daftar Usaha dan/atau Kegiatan yang Wajib Memiliki AMDAL, UKL-UPL atau SPPL (Berita Negara Republik Indonesia Tahun 2021 Nomor 267);</li>
        <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 5 Tahun 
            2021 tentang Tata Cara Penerbitan Persetujuan Teknis dan Surat Kelayakan Operasional Bidang Pengendalian Pencemaran Lingkungan (Berita Negara Republik Indonesia Tahun 2021 Nomor 268);</li>
        <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 6 Tahun 
            2021 tentang Tata Cara Persyaratan Pengelolaan Limbah Berbahaya dan Beracun (Berita Negara Republik Indonesia Tahun 2021 Nomor 294);</li>
        <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 15 Tahun 
            2021 tentang Organisasi dan Tata Kerja Kementerian Lingkungan Hidup dan Kehutanan (Berita Negara Republik Indonesia Tahun 2021 Nomor 756);</li>
        <li>Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 19 Tahun 
            2021 tentang Tata Cara Pengelolaan Limbah Non Bahan Berbahaya dan Beracun (Berita Negara Republik Indonesia Tahun 2021 Nomor 1214);</li>
        <li>Keputusan Menteri Lingkungan Hidup dan Kehutanan Nomor: SK.1206/
            Menlhk/Setjen/Kum.1/12/2021 tentang Penunjukan Pejabat Penerbit Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup kepada Direktur Jenderal Planologi Kehutanan dan Tata Lingkungan.</li>
    </ol>
    </td>
    </tr>
    <tr>
    <td width="30%" >
        Memperhatikan
    </td>
    <td width="5%"> :</td>
    <td width="65%">Surat Nomor: ' . $pkplh->nomor_pl . ' Tanggal ' . $pkplh->tgl_pl . ' perihal ' . $pkplh->perihal . ' yang telah diterima PTSP KLHK pada tanggal ...
    </td>
    </tr>   
    <tr>
    <td colspan="3"><br><center>MEMUTUSKAN:</center><br></td>
    </tr>
    <tr>
    <td width="30%" >
        Menetapkan
    </td>
    <td width="5%"> :</td>
    <td width="65%">
    KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA TENTANG PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP USAHA DAN/ATAU KEGIATAN ' . strtoupper($pkplh->nama_usaha) . ' DI ' . strtoupper($kabkota) . ' PROVINSI ' . strtoupper($prov) . ' OLEH ' . strtoupper($pkplh->pelaku_usaha_baru) . '
    </td>
    </tr>   
    <tr>
    <td width="30%">
*       KESATU
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Penanggung jawab Usaha dan/atau Kegiatan ini adalah:
        <table>
            <tr>
                <td width="20px">1.</td>
                <td width="40%" style="text-align: left;">Nama Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td width= "50%">' . ucfirst($pkplh->pelaku_usaha) . '</td>
            </tr>
            <tr>
                <td>2.</td>
                <td style="text-align: left;">Nomor Induk Berusaha</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->jenis_usaha) . '</td>
            </tr>
            <tr>
                <td>3.</td>
                <td style="text-align: left;">Jenis Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->penanggung) . '</td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Penanggung Jawab Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->nib) . '</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Jabatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->knli) . '</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Alamat Kantor/ Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->jabatan) . '</td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Lokasi Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->alamat) . '</td>
            </tr>
        <br>
        </table>
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KEDUA
    </td>
    <td width="5%"> :</td>
    <td width="65%">Ruang lingkup dalam persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup ini, meliputi:
        ' . ucfirst($pkplh->ruang_lingkup) . '.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KETIGA
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Penanggung Jawab Usaha dan/atau Kegiatan wajib memenuhi komitmen Persetujuan Teknis sebelum operasi terkait dengan lingkup Persetujuan Teknis.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEEMPAT
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Izin Pembuangan Air Limbah yang telah dimiliki dan masih berlaku setelah 2 Februari 2021 serta tidak ada perubahan dipersamakan sebagai Persetujuan Teknis;
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KELIMA
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Apabila dalam pelaksanaan usaha dan/atau kegiatan timbul dampak lingkungan hidup di luar dari dampak yang dikelola sebagaimana dimaksud dalam Lampiran Keputusan ini, Penanggung jawab Usaha dan/atau Kegiatan wajib melaporkan kepada instansi sebagaimana dimaksud dalam Diktum KEEMPAT angka 14 paling lama 30 (tiga puluh) hari kerja sejak diketahuinya timbulan dampak lingkungan hidup di luar dampak yang wajib dikelola.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KEENAM
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Dalam pelaksanaan Keputusan ini, Menteri menugaskan Pejabat Pengawas Lingkungan Hidup (PPLH) untuk melakukan pengawasan.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KETUJUH
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Pengawasan sebagaimana dimaksud dalam Diktum KEENAM dilaksanakan sesuai dengan ketentuan peraturan perundang-undangan paling sedikit 2 (dua) kali dalam 1 (satu) tahun.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KEDELAPAN
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Dalam hal berdasarkan hasil pengawasan sebagaimana dimaksud dalam Diktum KETUJUH ditemukan pelanggaran, Penanggung jawab Usaha dan/atau Kegiatan dikenakan sanksi sesuai dengan ketentuan peraturan perundang-undangan.
    </td>
    </tr>';

    $body .= '<tr>
    <td width="30%">
*       KESEMBILAN
    </td>
    <td width="5%"> :</td>
    <td width="65%">Penanggung jawab Usaha dan/atau Kegiatan wajib mengajukan 
        permohonan perubahan Persetujuan Lingkungan apabila terjadi perubahan atas rencana usaha dan/atau kegiatannya dan/atau oleh sebab lain sesuai dengan kriteria perubahan yang tercantum dalam Pasal 89 Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KESEPULUH
    </td>
    <td width="5%"> :</td>
    <td width="65%">Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan 
        Hidup ini merupakan Persetujuan Lingkungan dan prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KESEBELAS
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Dengan ditetapkannya keputusan ini, maka
        <ol>' . $il_dkk . '</ol>
        dinyatakan tetap berlaku sepanjang tidak diubah dan merupakan bagian yang tidak terpisahkan dari Keputusan ini.
    </td>
    </tr>
    <tr>
    <td width="30%">
*       KEDUA BELAS
    </td>
    <td width="5%"> :</td>
    <td width="65%">
        Keputusan ini mulai berlaku pada tanggal ditetapkan dan berakhir bersamaan dengan berakhirnya Perizinan Berusaha atau Persetujuan Pemerintah.
    </td>
    </tr>
    <tr>
    </table>';

    $body .= '<table width="100%">
    <tr>
    <td width="50%">&nbsp;</td>
    <td width="50%">
        <table>
            <tr>
                <td>Ditetapkan di Jakarta</td>
            </tr>       
            <tr>
                <td>pada tanggal</td>
            </tr>       
            <tr>
                <td colspan="2">a.n. MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA<br>
                PLT. DIREKTORAT JENDRAL PLANOLOGI<br>
                KEHUTANAN DAN TATA LINGKUNGAN,
                <br><br><br><br><br><br>
                RUANDHA AGUNG SUGARDIMAN<br>
                NIP 19620301 198802 1 001
                </td>
            </tr>       
        </table>
    </td>
    </tr>';


    $body .= '<tr>
    <td colspan="2" width="100%">
        Tembusan Yth.: <br>
        <ol>
            <li>Menteri Lingkungan Hidup dan Kehutanan;</li> '
        . $loopprov1 .
        ' <li>Sekretaris Jendral Kementrian Lingkungan Hidup dan Kehutanan;</li>
            <li>Direktur Jendral Penegakan Hukum Lingkungan Hidup dan Kehutanan;</li> '
        . $loopkk1 .
        '<li>Pelaku Usaha ' . $pkplh->pelaku_usaha_baru . ';</li>
        </ol>
    </td>
    </tr>';

    $body .= '</table>';

        return \Response::make($body, 200, $headers);
    }

    public function download_pertek($id)
		{
            $pkplh = Pkplh::find($id);
			$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();

			$headers = array(
				"Content-type" => "text/html",

				"Content-Disposition" => "attachment; Filename=pertek_$pkplh->pelaku_usaha_baru.doc"
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
							LAMPIRAN ...<br>
							KEPUTUSAN MENTRI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA <br>
							NOMOR <br>
							TENTANG<br>
                            PERSETUJUAN PERNYATAAN KESANGGUPAN  PENGELOLAAN LINGKUNGAN HIDUP KEGIATAN '.strtoupper($pkplh->nama_usaha_baru).' 
							OLEH '. strtoupper($pkplh->pelaku_usaha_baru).'
						</td>
                    </tr>
						<br><br><br>
                    <tr>
                        <td>
                            ..... UNTUK '.strtoupper($pkplh->judul_pertek).'
						</td>
					</tr>
                        <br><br>
                    <tr>
                        <td>
                            Berdasarkan Surat '.ucfirst($pkplh->surat_pertek).'
                            Nomor: '.strtoupper($pkplh->nomor_pertek).'
                            tanggal '.strtoupper($pkplh->tgl_pertek).'
                            tentang '.ucfirst($pkplh->perihal_pertek).';
                        </td>
                    </tr>';
			$body .='
				</table>';
			$body .-'
            <table width="100%">
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td width="50%">
                        <table>
                            <tr>
                                <td>Ditetapkan di Jakarta</td>
                            </tr>       
                            <tr>
                                <td>pada tanggal</td>
                            </tr>       
                            <tr>
                                <td colspan="2">a.n. MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA<br>
                                PLT. DIREKTORAT JENDRAL PLANOLOGI<br>
                                KEHUTANAN DAN TATA LINGKUNGAN,
                                <br><br><br><br><br><br>
                                RUANDHA AGUNG SUGARDIMAN<br>
                                NIP 19620301 198802 1 001
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
							LAMPIRAN ... <br>
							KEPUTUSAN MENTRI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA <br>
							NOMOR <br>
							TENTANG <br>
                            PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP KEGIATAN '.strtoupper($skkl->nama_usaha_baru).' 
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
                            <i>(silahkan copy isi Rincian dari file Doc yang di upload Pemrakarsa)</i>
                        </td>
                    </tr>';
			$body .='
				</table>';
			$body .-'
				<table>
				<tr>
					<td width="50%">&nbsp;</td>
					<td width="50%">
						<table>       
                            <tr>
                                <td colspan="2">a.n. MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA<br>
                                    PLT. DIREKTORAT JENDRAL PLANOLOGI<br>
                                    KEHUTANAN DAN TATA LINGKUNGAN,
                                <br><br><br><br><br><br>
                                    RUANDHA AGUNG SUGARDIMAN<br>
                                    NIP 19620301 198802 1 001
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

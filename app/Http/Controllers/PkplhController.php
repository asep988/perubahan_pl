<?php

namespace App\Http\Controllers;

use App\Chat_pkplh;
use il;
use App\User;
use App\Pkplh;
use App\region;
use App\Uklupl;
use App\il_pkplh;
use App\initiator;
use Carbon\Carbon;
use App\Pertek_pkplh;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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
		$initiator = initiator::where('email', $email)->get();

		return view('home.pkplh.form', compact('regencies', 'provinces', 'initiator'));
	}

	public function store(Request $request)
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
			$pertek = array_values(array_unique($request->pertek));
		} else {
			$pertek = array();
			$pertek[] = $request->pertek;
		}

        if (in_array("pertek5", $pertek)) {
			$request->validate([
				'rintek_upload' => 'required',
			]);
		} else if (in_array("pertek6", $pertek)) {
			$request->validate([
				'rintek_limbah_upload' => 'required'
			]);
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
			$fileName1 = time() . rand(0,100) . '_rintek.' . $format1; //Variabel yang menampung nama file
			$file1->storeAs('files/pkplh/rintek', $fileName1); //Simpan ke Storage
		} else {
			$fileName1 = null;
		}

		if ($request->rintek_limbah_upload) {
			$file2 = $request->file('rintek_limbah_upload');
			$format2 = $file2->getClientOriginalExtension();
			$fileName2 = time() . rand(0,100) . '_rintek_limbah.' . $format2; //Variabel yang menampung nama file
			$file2->storeAs('files/pkplh/rintek', $fileName2); //Simpan ke Storage
		} else {
			$fileName2 = null;
		}

        $hash = hash_hmac('sha256', $request->nama_usaha_baru . rand(0,100), 'PKPLH');
		$regist = "B" . substr($hash, 0, 14);

		DB::beginTransaction();
		$pkplh = new Pkplh;
		$pkplh->user_id 				=   $id_user;
		$pkplh->jenis_perubahan 		=   $request->jenis_perubahan;

		if ($request->jenis_perubahan != "perkep3") {
			$pkplh->pelaku_usaha 	    =   $request->pelaku_usaha;
			$pkplh->penanggung		    =	$request->penanggung;
			$pkplh->jabatan			    =	$request->jabatan;
			$pkplh->alamat			    =	$request->alamat;
		}

		$pkplh->pelaku_usaha_baru 	    =   $request->pelaku_usaha_baru;
		$pkplh->nama_usaha_baru		    =	$request->nama_usaha_baru;
		$pkplh->penanggung_baru		    =	$request->penanggung_baru;
		$pkplh->nib_baru				=	$request->nib_baru;
		$pkplh->jabatan_baru			=	$request->jabatan_baru;
		$pkplh->alamat_baru			    =	$request->alamat_baru;
		$pkplh->lokasi_baru			    =	$request->lokasi_baru;
		$pkplh->nama_kbli			    =	$nama_kbli;
		$pkplh->kbli_baru			    =	$nomor_kbli;
		$pkplh->rintek_upload		    =	$fileName1;
		$pkplh->rintek_limbah_upload	=	$fileName2;
		$pkplh->noreg               	=	$regist;

		$pkplh->provinsi				=	$provinsi;
		$pkplh->kabupaten_kota	    	=	$kabkota;
		$pkplh->region			    	=	$region;
		$pkplh->link_drive		    	=	$request->link_drive;
		$pkplh->pic_pemohon		    	=	$request->pic_pemohon;
		$pkplh->no_hp_pic		    	=	$request->no_hp_pic;
		$pkplh->nomor_pl				=	$request->nomor_pl;
		$pkplh->tgl_pl			    	=	$request->tgl_pl;
		$pkplh->perihal			    	=	$request->perihal_surat;
		$pkplh->pejabat_pl		    	=	$request->pejabat_pl;
		$pkplh->nomor_validasi		    =	$request->nomor_validasi;
		$pkplh->tgl_validasi			=	$request->tgl_validasi;
		$pkplh->jenis_peraturan	    	=	$jenis_peraturan;
		$pkplh->pejabat_daerah	    	=	$pejabat_daerah;
		$pkplh->nomor_peraturan		    =	$nomor_peraturan;
		$pkplh->perihal_peraturan	    =	$perihal_peraturan;
		$pkplh->ruang_lingkup		    = 	$request->ruang_lingkup;
		$pkplh->pertek				    = 	$pertek;
		$pkplh->status 				    = 	"Belum";
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

		if ($request->jenis_perubahan != "perkep1" && $request->surat_pertek != null) {
			for ($i = 0; $i < count($request->surat_pertek); $i++) {
				$pertek_pkplh = new Pertek_pkplh;
				$pertek_pkplh->id_pkplh = $pkplh_id;
				$pertek_pkplh->pertek = $request->pertek[$i];
				// $pertek_pkplh->judul_pertek = $request->judul_pertek[$i];
				$pertek_pkplh->surat_pertek = $request->surat_pertek[$i];
				$pertek_pkplh->nomor_pertek = $request->nomor_pertek[$i];
				$pertek_pkplh->tgl_pertek = $request->tgl_pertek[$i];
				$pertek_pkplh->perihal_pertek = $request->perihal_pertek[$i];
				$pertek_pkplh->save();
			}
		}
		DB::commit();

        return redirect()->route('pkplh.index')->with('pesan', 'Data berhasil diinput');
	}

	public function review($id)
	{
		$data_pkplh = Pkplh::find($id);
		$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();
		$pertek_pkplh = Pertek_pkplh::where('id_pkplh', $id)->get();

		return view('home.pkplh.review', compact('data_pkplh', 'il_pkplh', 'pertek_pkplh'));
	}

	//OPERATOR
	public function operatorIndex()
	{
		$data_pkplh = Pkplh::orderBy('created_at', 'DESC')
        ->where('nama_operator', Auth::user()->name)
        ->get();

        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

		return view('operator.pkplh.index', compact('data_pkplh', 'pemrakarsa'));
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
		$email = Auth::user()->email;
		$initiator = initiator::where('email', $email)->get();
		$provinces = region::where('regency', "")->get();
		$regencies = region::where('regency', '!=', "")
		->where('district', "")
		->get();

		$pkplh = Pkplh::find($id);
		$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();
		$pertek_pkplh = Pertek_pkplh::where('id_pkplh', $id)->get();

		$selected_provinces = $pkplh->provinsi;
		$selected_kabupaten_kota = $pkplh->kabupaten_kota;
		$jum = count($il_pkplh);

		return view('home.pkplh.edit', compact('provinces', 'initiator', 'regencies', 'pkplh', 'jum', 'il_pkplh', 'selected_provinces', 'selected_kabupaten_kota', 'pertek_pkplh'));
	}

	public function update(Request $request, $id) //Pemrakarsa
	{
        // return $request->all();
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
			$pertek = array_values(array_unique($request->pertek));
		} else {
			$pertek = array();
			$pertek[] = $request->pertek;
		}

        if (in_array("pertek5", $pertek)) {
			$request->validate([
				'rintek_upload' => 'required',
			]);
		} else if (in_array("pertek6", $pertek)) {
			$request->validate([
				'rintek_limbah_upload' => 'required'
			]);
		}

		if (is_array($request->jenis_peraturan)) {
			$jenis_peraturan = $request->jenis_peraturan;
		} else {{{  }}
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

		$data = Pkplh::find($id);

		if ($request->rintek_upload) {
			$destination = 'files/pkplh/rintek/' . $data->rintek_upload;
			if ($destination) {
				Storage::delete($destination);
			}

			$file1 = $request->file('rintek_upload');
			$format1 = $file1->getClientOriginalExtension();
			$fileName1 = time() . rand(0,100) . '_rintek.' . $format1; //Variabel yang menampung nama file
			$file1->storeAs('files/pkplh/rintek', $fileName1); //Simpan ke Storage
		} else {
			$fileName1 = null;
		}

		if ($request->rintek_limbah_upload) {
			$destination = 'files/pkplh/rintek/' . $data->rintek_limbah_upload;
			if ($destination) {
				Storage::delete($destination);
			}

			$file2 = $request->file('rintek_limbah_upload');
			$format2 = $file2->getClientOriginalExtension();
			$fileName2 = time() . rand(0,100) . '_rintek_limbah.' . $format2; //Variabel yang menampung nama file
			$file2->storeAs('files/pkplh/rintek', $fileName2); //Simpan ke Storage
		} else {
			$fileName2 = null;
		}

		DB::beginTransaction();
		$pkplh = Pkplh::find($id);
		$pkplh->user_id 				=   $id_user;
		$pkplh->jenis_perubahan 		=   $request->jenis_perubahan;

		if ($request->jenis_perubahan != "perkep3") {
			$pkplh->pelaku_usaha 	=   $request->pelaku_usaha;
			$pkplh->penanggung		=	$request->penanggung;
			$pkplh->jabatan			=	$request->jabatan;
			$pkplh->alamat			=	$request->alamat;
		}

		$pkplh->pelaku_usaha_baru 	=   $request->pelaku_usaha_baru;
		$pkplh->nama_usaha_baru		=	$request->nama_usaha_baru;
		$pkplh->penanggung_baru		=	$request->penanggung_baru;
		$pkplh->nib_baru			=	$request->nib_baru;
		$pkplh->jabatan_baru		=	$request->jabatan_baru;
		$pkplh->alamat_baru			=	$request->alamat_baru;
		$pkplh->lokasi_baru			=	$request->lokasi_baru;
		$pkplh->nama_kbli			=	$nama_kbli;
		$pkplh->kbli_baru			=	$nomor_kbli;
		$pkplh->rintek_upload		=	$fileName1;
		$pkplh->rintek_limbah_upload=	$fileName2;

		$pkplh->provinsi			=	$provinsi;
		$pkplh->kabupaten_kota		=	$kabkota;
		$pkplh->region				=	$region;
		$pkplh->link_drive			=	$request->link_drive;
		$pkplh->pic_pemohon			=	$request->pic_pemohon;
		$pkplh->no_hp_pic			=	$request->no_hp_pic;
		$pkplh->nomor_pl			=	$request->nomor_pl;
		$pkplh->tgl_pl				=	$request->tgl_pl;
		$pkplh->perihal				=	$request->perihal_surat;
		$pkplh->pejabat_pl			=	$request->pejabat_pl;
		$pkplh->nomor_validasi		=	$request->nomor_validasi;
		$pkplh->tgl_validasi		=	$request->tgl_validasi;
		$pkplh->jenis_peraturan		=	$jenis_peraturan;
		$pkplh->pejabat_daerah		=	$pejabat_daerah;
		$pkplh->nomor_peraturan		=	$nomor_peraturan;
		$pkplh->perihal_peraturan	=	$perihal_peraturan;
		$pkplh->ruang_lingkup		= 	$request->ruang_lingkup;
		$pkplh->pertek				= 	$pertek;
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

		if ($request->jenis_perubahan != "perkep1" && $request->surat_pertek != null) {
			Pertek_pkplh::where('id_pkplh', $id)->delete();
			for ($i = 0; $i < count($request->surat_pertek); $i++) {
				$pertek_pkplh = new Pertek_pkplh;
				$pertek_pkplh->id_pkplh = $id;
				$pertek_pkplh->pertek = $request->pertek[$i];
				// $pertek_pkplh->judul_pertek = $request->judul_pertek[$i];
				$pertek_pkplh->surat_pertek = $request->surat_pertek[$i];
				$pertek_pkplh->nomor_pertek = $request->nomor_pertek[$i];
				$pertek_pkplh->tgl_pertek = $request->tgl_pertek[$i];
				$pertek_pkplh->perihal_pertek = $request->perihal_pertek[$i];
				$pertek_pkplh->save();
			}
		}
		DB::commit();

		return redirect()->route('pkplh.index')->with('pesan', 'Data berhasil diperbarui');
	}

	public function operatorPreview($id) //OPERATOR
	{
		$data_pkplh = Pkplh::find($id);
		$il_pkplh = il_pkplh::where('id_pkplh', $id)->get();
        $pertek_pkplh = Pertek_pkplh::where('id_pkplh', $id)->get();

		return view('operator.pkplh.preview', compact('data_pkplh', 'il_pkplh', 'pertek_pkplh'));
	}

    public function batal(Request $request, $id)
	{
		Pkplh::find($id)->update([
			'status' => "Batal",
			'note' => $request->note
		]);

		return back()->with('message', 'Permohonan berhasil dibatalkan!');
	}

    public function regist($id)
	{
		$pkplh = Pkplh::find($id);
		$now = tgl_indo2(Carbon::now()->format('d-m-Y'));
		$time = Carbon::now()->format('H:i:s');
		$tgl_dibuat = tgl_indo2($pkplh->created_at->format('d-m-Y'));

		$data = [
			'tgl_cetak' => $now . ", " . $time,
			'noreg' => $pkplh->noreg,
			'pelaku_usaha_baru' => $pkplh->pelaku_usaha_baru,
			'nama_usaha_baru' =>  $pkplh->nama_usaha_baru,
			'nomor_validasi' =>  $pkplh->nomor_validasi,
			'tgl_dibuat' =>  $tgl_dibuat,
			'jenis_perubahan' =>  $pkplh->jenis_perubahan,
			'jml_uklupl' => Uklupl::where('id_pkplh', $pkplh->id)->get()->count(),
		];

		$pdf = Pdf::loadView('layouts.regist_pkplh', $data);
        return $pdf->stream();
	}

	public function download($id)
    {
        //phpword

        $pkplh = Pkplh::find($id);
        $il_pkplh = il_pkplh::where('id_pkplh', $id)->get();
        $pertek_pkplh = Pertek_pkplh::where('id_pkplh', $id)->get();
        $kabkota = implode(", ", $pkplh->kabupaten_kota);
        $prov = implode(", ", $pkplh->provinsi);

        $pertek = "";
        for ($i = 0; $i < count($pkplh->pertek); $i++) {
            if ($pkplh->pertek[$i] == "pertek1") {
                $pertek .= "<li>Persetujuan Teknis Pemenuhan Baku Mutu Air Limbah yang merupakan pengelolaan dan pemantauan lingkungan hidup ke dalam Persetujuan Lingkungan;</li>";
            }
            if ($pkplh->pertek[$i] == "pertek2") {
                $pertek .= "<li>Persetujuan Teknis Pemenuhan Baku Mutu Emisi yang merupakan pengelolaan dan pemantauan lingkungan hidup ke dalam Persetujuan Lingkungan;</li>";
            }
            if ($pkplh->pertek[$i] == "pertek3") {
                $pertek .= "<li>Persetujuan Teknis Di Bidang Pengelolaan Limbah B3 yang merupakan penglolaan dan pemantauan lingkungan hidup ke dalam Persetujuan Lingkungan;</li>";
            }
            if ($pkplh->pertek[$i] == "pertek4") {
                $pertek .= "<li>Persetujuan Teknis Andalalin yang merupakan penglolaan dan pemantauan lingkungan hidup ke dalam Persetujuan Lingkungan;</li>";
            }
            if ($pkplh->pertek[$i] == "pertek5") {
                $pertek .= "<li>Persetujuan Teknis Dokumen Rincian Teknis yang merupakan penglolaan dan pemantauan lingkungan hidup ke dalam Persetujuan Lingkungan;</li>";
            }
        }

        $dasper = "";
        for ($i = 0; $i < count($pkplh->jenis_peraturan); $i++) {
            $dasper = '<li>'. $pkplh->jenis_peraturan[$i] . ' ' . $pkplh->pejabat_daerah[$i] . ' Nomor ' . $pkplh->nomor_peraturan[$i] . ' tentang ' . $pkplh->perihal_peraturan[$i] . '</li>';
        }

        $perkep = "";
        if ($pkplh->jenis_perubahan == "perkep1") {
            $perkep .= "bahwa terdapat perubahan kepemilikan " . $pkplh->nama_usaha_baru ." oleh " . $pkplh->pelaku_usaha_baru . " berdasarkan <ol start='1'>" . $dasper .  "</ol>";
        } elseif ($pkplh->jenis_perubahan == "perkep2") {
            $perkep .= "bahwa terdapat perubahan kepemilikan " . $pkplh->nama_usaha_baru ." oleh " . $pkplh->pelaku_usaha_baru . " berdasarkan <ol>" . $dasper .  "</ol> <br>
            dan perubahan pengelolaan dan pemantauan oleh " . $pkplh->pelaku_usaha_baru . " akan mengintegrasikan: <ol start='1'>" . $pertek . "</ol>";
        } else {
            $perkep .= "bahwa terdapat perubahan pengelolaan dan pemantauan " . $pkplh->pelaku_usaha_baru . " akan mengintegrasikan: <ol>" . $pertek . "</ol>";
        }

        $loopkbli = "";
        for ($i = 0; $i < count($pkplh->nama_kbli); $i++){
            $loopkbli .= "<li>" . ucwords($pkplh->nama_kbli[$i]) . " (Kode KBLI:".$pkplh->kbli_baru[$i]."; </li>";
        }

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
            $il_dkk .= "<li>" . $il_pkplh[$i]->jenis_sk . " " . $il_pkplh[$i]->menerbitkan . " Nomor " . $il_pkplh[$i]->nomor_surat . " tanggal " . tgl_indo($il_pkplh[$i]->tgl_surat) . " tentang " . $il_pkplh[$i]->perihal_surat . "</li>";
        }

        $abjad = count($pkplh->provinsi) + count($pkplh->kabupaten_kota) + 0;

        if ($pkplh->jenis_perubahan != 'perkep1'){
            $pkplh_isi = "<li>mematuhi dan melaksanakan syarat-syarat teknis sesuai:<ol type='a'>";
            $roman = 2;
            for ($i = 0; $i < count($pkplh->pertek); $i++) {
                if ($pkplh->pertek[$i] == "pertek1") {
                    $pkplh_isi .= "<li>Lampiran ". integerToRoman($roman) ." Persetujuan Teknis Pemenuhan Baku Mutu Air Limbah;</li>";
                }
                if ($pkplh->pertek[$i] == "pertek2") {
                    $pkplh_isi .= "<li>Lampiran ". integerToRoman($roman) ." Persetujuan Teknis Pemenuhan Baku Mutu Emisi;</li>";
                }
                if ($pkplh->pertek[$i] == "pertek3") {
                    $pkplh_isi .= "<li>Lampiran ". integerToRoman($roman) ." Persetujuan Teknis Di Bidang Pengelolaan Limbah B3;</li>";
                }
                if ($pkplh->pertek[$i] == "pertek4") {
                    $pkplh_isi .= "<li>Lampiran ". integerToRoman($roman) ." Persetujuan Teknis Andalalin;</li>";
                }
                if ($pkplh->pertek[$i] == "pertek5") {
                    $pkplh_isi .= "<li>Lampiran ". integerToRoman($roman) ." Persetujuan Teknis Dokumen Rincian Teknis;</li>";
                }
                $roman++;
            }
            $pkplh_isi .= "</ol></li>";
        } else {
            $pkplh_isi = "";
        }

        $headers = array(

            "Content-type" => "text/html",

            "Content-Disposition" => "attachment;Filename=PKPLH_" . $pkplh->pelaku_usaha_baru . ".doc"

        );

        $body = '
        <style>
            body {
                font-family:"Bookman Old Style !important";
                font-size: 12pt !important;
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
            ol > li.sub_list:before {
                content : counters(item, ".") "";
                counter-incerment:item
            }
            .ruli {
                font-family:"Bookman Old Style !important";
                font-size: 10pt !important;
                width: 30% !important;
            }
            .ruli table {
                font-family:"Bookman Old Style !important";
                font-size: 10pt !important;
                width: 30% !important;
            }
        </style>';

        $body .=
        '<br><br><br><br>
        <table width="100%">
            <tr>
    <td colspan="3" width="100%">
        <center>KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN<br>REPUBLIK INDONESIA<br>
            NOMOR .....<br><br>TENTANG<br><br>
            PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN<br>
            HIDUP KEGIATAN ' . strtoupper($pkplh->nama_usaha_baru) .
            ' OLEH '. strtoupper($pkplh->pelaku_usaha_baru) . ' <br><br>
            DENGAN RAHMAT TUHAN YANG MAHA ESA<br><br>MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA,
        <center>
    </td>
    </tr>
    <tr>
    <td width="30%">
        Menimbang
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        <ol style="list-style-type: lower-alpha;">
            <li>bahwa berdasarkan ketentuan:</li>
                <ol type="a">
                    <li>Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup, ditetapkan:</li>
                        <ol>
                            <li class="list_kurung"> Pasal 3:
                                <ol>
                                    <li class="list_kurung"> ayat (1): Persetujuan Lingkungan wajib dimiliki oleh setiap Usaha dan/atau Kegiatan yang memiliki Dampak Penting atau tidak penting terhadap lingkungan;</li>
                                    <li class="list_kurung"> ayat (2): Persetujuan Lingkungan diberikan kepada Pelaku Usaha atau Instansi Pemerintah;</li>
                                    <li class="list_kurung"> ayat (3): Persetujuan Lingkungan menjadi prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah;</li>
                                    <li class="list_kurung"> ayat (4): Persetujuan Lingkungan dilakukan melalui penyusunan Amdal dan uji kelayakan Amdal;</li>
                                </ol>
                            </li>
                            <li class="list_kurung">Pasal 64 ayat (1) : Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup merupakan: a. bentuk persetujuan Lingkungan Hidup; dan b. prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah</li>
                            <li class="list_kurung">Pasal 89 ayat (1) : Penanggungjawab Usaha dan/atau Kegiatan wajib melakukan perubahan Persetujuan Lingkungan apabila Usaha dan/atau Kegiatannya yang telah memperoleh surat Keputusan Kelayakan Lingkungan Hidup atau persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup direncanakan untuk dilakukan perubahan;</li>
                            <li class="list_kurung">Pasal 89 ayat (2) : Perubahan Persetujuan Lingkungan dilakukan melalui: a. perubahan Persetujuan Lingkungan dengan kewajiban menyusun dokumen lingkungan hidup baru; atau b. perubahan Persetujuan Lingkungan tanpa disertai kewajiban menyusun dokumen lingkungan hidup baru;</li>
                        </ol>
                    <li>Pasal 5 ayat (1) Peraturan Menteri Lingkungan Hidup dan Kehutanan Nomor 4 Tahun 2021 tentang Daftar Usaha dan/atau Kegiatan yang Wajib Memiliki Analisis Mengenai Dampak Lingkungan Hidup, Upaya Pengelolaan Lingkungan Hidup dan Upaya Pemantauan Lingkungan Hidup atau Surat Pernyataan Kesanggupan Pengelolaan dan Pemantauan Lingkungan Hidup, UKL-UPL wajib dimiliki bagi Usaha dan/atau Kegiatan yang tidak memiliki Dampak Penting terhadap lingkungan hidup;</li>
                </ol>
            <li>bahwa kegiatan '. ucfirst($pkplh->nama_usaha_baru) .' oleh '. ucfirst($pkplh->pelaku_usaha_baru) .' telah memiliki dokumen lingkungan hidup yang telah disetujui berdasarkan:<br>
                <ol>'. $il_dkk .'</ol>
            </li>
            <li>
            Bahwa '. $pkplh->jabatan_baru .' melalui surat Nomor: '. $pkplh->nomor_pl .', Tanggal '. tgl_indo($pkplh->tgl_pl) .' Perihal '. $pkplh->perihal .', mengajukan permohonan perubahan persetujuan lingkungan kepada Menteri Lingkungan Hidup;
            </li>
            <li>
                bahwa '. ucfirst($pkplh->pelaku_usaha_baru) .' sesuai Nomor '. $pkplh->nomor_pl  .'
                tanggal '. tgl_indo($pkplh->tgl_pl) .' perihal '. $pkplh->perihal.' menyampaikan permohonan perubahan Persetujuan Lingkungan;
            </li>
            <li>
                bahwa berdasarkan hasil verifikasi administrasi sesuai Nomor '. $pkplh->nomor_validasi .' tanggal '. tgl_indo($pkplh->tgl_validasi) .',
                permohonan sebagaimana dimaksud pada huduf d, dinyatakan lengkap secara administratif:
            </li>
            <li>
                berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a sampai dengan huruf e, perlu menetapkan Keputusan Menteri Lingkungan Hidup dan Kehutanan Republik Indonesia tentang Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup Kegiatan '. $pkplh->nama_usaha_baru .' oleh '. $pkplh->pelaku_usaha_baru .'
            </li>
        </ol>
    </td>
    </tr>
    <tr>
    <td width="30%" >
        Mengingat
    </td>
    <td width="2%"> :</td>
    <td width="68%">
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
    <td width="2%"> :</td>
    <td width="68%">
        Risalah Pengolahan Data (RPD) Penerbitan Persetujuan Pernyataan Kesanggupan
        Pengelolaan Lingkungan Hidup Kegiatan '. $pkplh->nama_usaha_baru .' oleh '. $pkplh->pelaku_usaha_baru .'
        Nomor: '. $pkplh->nomor_rpd .' tanggal '. $pkplh->tgl_rpd .'
    </td>
    </tr>
    <tr>
    <td colspan="3"><br><center>MEMUTUSKAN:</center><br></td>
    </tr>
    <tr>
    <td width="30%" >
        Menetapkan
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        KEPUTUSAN MENTERI LINGKUNGAN HIDUP DAN KEHUTANAN TENTANG
        PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN
        HIDUP KEGIATAN '. strtoupper($pkplh->nama_usaha_baru) .' OLEH '. strtoupper($pkplh->pelaku_usaha_baru) .'.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KESATU
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Penanggung jawab Usaha dan/atau Kegiatan ini adalah:
        <table>
            <tr>
                <td width="20px">1.</td>
                <td width="40%" style="text-align: left;">Nama Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td width= "50%">' . strtoupper($pkplh->pelaku_usaha_baru) . '</td>
            </tr>
            <tr>
                <td>2.</td>
                <td style="text-align: left;">Nomor Induk Berusaha</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->nib_baru) . '</td>
            </tr>
            <tr>
                <td>3.</td>
                <td style="text-align: left;">Jenis Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td><ul>' .$loopkbli.'
                </ul></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Penanggung Jawab Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->penanggung_baru) . '</td>
            </tr>
            <tr>
                <td>5.</td>
                <td>Jabatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->jabatan_baru) . '</td>
            </tr>
            <tr>
                <td>6.</td>
                <td>Alamat Kantor/ Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->alamat_baru) . '</td>
            </tr>
            <tr>
                <td>7.</td>
                <td>Lokasi Usaha dan/atau Kegiatan</td>
                <td>:</td>
                <td>' . ucfirst($pkplh->lokasi_baru) . '</td>
            </tr>
        <br>
        </table>
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEDUA
    </td>
    <td width="2%"> :</td>
    <td width="68%">Ruang lingkup dalam persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup ini, meliputi:
        <div class="ruli">'
            . ucfirst($pkplh->ruang_lingkup) . '
        </div>
    </td>
    </tr>
    <tr>
    <td width="30%">
        KETIGA
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Penanggung Jawab Usaha dan/atau Kegiatan wajib memenuhi komitmen Persetujuan Teknis sebelum operasi terkait dengan lingkup Persetujuan Teknis.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEEMPAT
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Dalam melaksanakan kegiatan sebagaimana dimaksud dalam Diktum KEDUA, Penanggung Jawab Usaha dan/atau Kegiatan wajib:
        <ol>
            <li>
                melakukan pengelolaan dan pemantauan dampak lingkungan hidup sebagaimana tercantum dalam Lampiran I Keputusan ini;
            </li>
                '. $pkplh_isi .'
            <li>
                mematuhi ketentuan peraturan perundang-undangan di bidang Perlindungan dan Pengelolaan Lingkungan Hidup;
            </li>
            <li>
                melakukan koordinasi dengan instansi pusat maupun daerah, berkaitan dengan pelaksanaan kegiatan ini;
            </li>
            <li>
            	mengupayakan pengurangan, penggunaan kembali, dan daur ulang terhadap limbah-limbah yang dihasilkan;
            </li>
            <li>
                melakukan pengelolaan limbah non B3 sesuai rincian pengelolaan yang termuat dalam dokumen UKL-UPL;
            </li>
            <li>
                melaksanakan ketentuan pelaksanaan kegiatan sesuai dengan <i>Standard Operating Procedure</i> (SOP);
            </li>
            <li>
                melakukan perbaikan secara terus-menerus terhadap kehandalan teknologi yang digunakan dalam rangka meminimalisasi dampak yang diakibatkan dari rencana kegiatan ini
            </li>
            <li>
                melakukan sosialisasi kegiatan kepada pemerintah daerah, tokoh masyarakat, dan masyarakat setempat sebelum kegiatan pengembangan dilakukan;
            </li>
            <li>
                mendokumentasikan seluruh kegiatan pengelolaan lingkungan yang dilakukan terkait dengan kegiatan tersebut;
            </li>
            <li>
                memenuhi kewajiban pada Persetujuan Teknis pasca verifikasi pemenuhan baku mutu Lingkungan Hidup, Pengelolaan Limbah B3, dan/atau Analisis Mengenai Dampak Lalu Lintas;
            </li>
            <li>
                menyiapkan dana penjaminan untuk pemulihan fungsi Lingkungan Hidup sesuai dengan ketentuan peraturan perundang-undangan;
            </li>
            <li>
                melakukan audit lingkungan pada tahapan pasca operasi untuk memastikan kewajiban telah dilaksanakan dalam rangka pengakhiran kewajiban pengelolaan dan pemantauan lingkungan hidup dan/atau kewajiban lain yang ditetapkan oleh Menteri, Gubernur, Bupati/Wali Kota sesuai dengan kewenangannya berdasarkan kepentingan perlindungan dan pengelolaan lingkungan hidup;
            </li>
            <li>
                menyusun laporan pelaksanaan kewajiban sebagaimana dimaksud pada angka 1 (satu) sampai dengan angka 10 (sepuluh), paling sedikit 1 (satu) kali setiap 6 (enam) bulan selama usaha atau kegiatan berlangsung dan menyampaikan kepada:
                <ol type="a">
                    <li>
                        Menteri Lingkungan Hidup dan Kehutanan Republik Indonesia melalui Direktorat Jenderal Penegakan Hukum Lingkungan Hidup dan Kehutanan;
                    </li>
                        ' . $loopprov2 .
                            $loopkk2 .
                '</ol>
                    dengan tembusan kepada kepala instansi yang membidangi selain huruf a sampai huruf '. strtolower(num2alpha($abjad)) .' di atas, sebagaimana tercantum dalam kolom institusi pengelolaan lingkungan hidup atau institusi pemantauan lingkungan hidup.
            </li>
        </ol>
    </td>
    </tr>
    <tr>
    <td width="30%">
        KELIMA
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Terhadap izin-izin PPLH atau Persetujuan Teknis atau Rincian Teknis sebagaimana tersebut Diktum KEEMPAT angka 2 yang terdapat perubahan di dalamnya, wajib melakukan pembaruan Persetujuan Teknis dan/atau Rincian Teknis, dan melakukan perubahan Persetujuan Lingkungan sesuai dengan ketentuan peraturan perundang-undangan
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEENAM
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Dalam pelaksanaan Keputusan ini, Menteri menugaskan Pejabat Pengawas Lingkungan Hidup (PPLH) untuk melakukan pengawasan.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KETUJUH
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Pengawasan sebagaimana dimaksud dalam Diktum KEENAM dilaksanakan sesuai dengan ketentuan peraturan perundang-undangan paling sedikit 2 (dua) kali dalam 1 (satu) tahun.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEDELAPAN
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Dalam hal berdasarkan hasil pengawasan sebagaimana dimaksud dalam Diktum KETUJUH ditemukan pelanggaran, Penanggung jawab Usaha dan/atau Kegiatan dikenakan sanksi sesuai dengan ketentuan peraturan perundang-undangan.
    </td>
    </tr>';

    $body .= '<tr>
    <td width="30%">
        KESEMBILAN
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Penanggung Jawab Usaha dan/atau Kegiatan wajib mengajukan permohonan perubahan Persetujuan Lingkungan apabila terjadi perubahan atas rencana Usaha dan/atau Kegiatannya dan/atau oleh sebab lain sesuai dengan kriteria perubahan yang tercantum dalam Pasal 89 Peraturan Pemerintah Nomor 22 Tahun 2021 tentang Penyelenggaraan Perlindungan dan Pengelolaan Lingkungan Hidup.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KESEPULUH
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Segala data dan informasi sebagaimana dimaksud dalam keputusan ini menjadi tanggungjawab penanggungjawab usaha dan/atau kegiatan.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KESEBELAS
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Dalam hal berdasarkan hasil pengawasan, ditemukan ketidaksesuaian data dan informasi sebagaimana dimaksud dalam Diktum KESEBELAS, penanggungjawab usaha dan/atau kegiatan dikenakan sanksi sesuai peraturan perundang-undangan.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEDUA BELAS
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Persetujuan Pernyataan Kesanggupan Pengelolaan Lingkungan Hidup ini merupakan Persetujuan Lingkungan dan prasyarat penerbitan Perizinan Berusaha atau Persetujuan Pemerintah.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KETIGA BELAS
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Dengan ditetapkannya Keputusan ini, maka:
        <ol>'. $il_dkk .'</ol>
        dinyatakan tetap berlaku sepanjang tidak diubah dengan keputusan ini dan merupakan bagian yang tidak terpisahkan dari keputusan ini.
    </td>
    </tr>
    <tr>
    <td width="30%">
        KEEMPAT BELAS
    </td>
    <td width="2%"> :</td>
    <td width="68%">
        Keputusan ini mulai berlaku pada tanggal ditetapkan dan berakhir bersamaan dengan berakhirnya Perizinan Berusaha atau Persetujuan Pemerintah.
    </td>
    </tr>
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

    public function download_pertek(Request $request ,$id)
	{
		$pkplh = Pkplh::find($id);
		$pertek = Pertek_pkplh::where('id_pkplh', $id)->get();

		$data = array();
		foreach ($pertek as $row) {
			$data[] = $row->pertek;
		}

		$data = array_values(array_unique($data));

        $pertek_isi = "";
        $roman = 0;
		for ($i = 0; $i < count($pertek); $i++) {
			if ($request->pertek == $pertek[$i]->pertek) {
                if ($pertek[$i]->pertek == "pertek1") {
                    $isi = "Persetujuan Teknis Pemenuhan Baku Mutu Air Limbah";
                } else if ($pertek[$i]->pertek == "pertek2") {
                    $isi = "Persetujuan Teknis Pemenuhan Baku Mutu Emisi";
                } else if ($pertek[$i]->pertek == "pertek3") {
                    $isi = "Persetujuan Teknis Di Bidang Pengelolaan Limbah B3";
                } else if ($pertek[$i]->pertek == "pertek4") {
                    $isi = "Persetujuan Teknis Andalalin";
                } else if ($pertek[$i]->pertek == "pertek5") {
                    $isi = "Persetujuan Teknis Dokumen Rincian Reknis";
                }
				$index = array_search($pertek[$i]->pertek, $data);
				$roman = 2 + $index;
				$pertek_isi .= '<li>Surat/Izin/Keputusan '.ucfirst($pertek[$i]->surat_pertek).'
				Nomor: '.strtoupper($pertek[$i]->nomor_pertek).'
				tanggal '. tgl_indo($pertek[$i]->tgl_pertek).'
				tentang '.ucfirst($pertek[$i]->perihal_pertek).';</li>';
			}
		}

		$headers = array(
			"Content-type" => "text/html",

			"Content-Disposition" => "attachment; Filename=Pertek_$pkplh->pelaku_usaha_baru.doc"
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
						TENTANG PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP KEGIATAN '.strtoupper($pkplh->nama_usaha_baru).'
						OLEH '. strtoupper($pkplh->pelaku_usaha_baru).'
					</td>
				</tr>
					<br><br><br>
                <tr>
					<td>
						'. strtoupper($isi) .'
					</td>
				</tr>
					<br><br>
				<tr>
					<td>
						Berdasarkan: <br>
					</td>
				</tr>
				<tr>
					<td>
						<ol>
							'. $pertek_isi .'
						</ol>
					</td>
				</tr>';
		$body .='
			</table>';
		$body .='
			<table>
			<tr>
				<td width="40%">&nbsp;</td>
				<td width="60%">
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

	public function download_rintek($id)
	{
		$pkplh = Pkplh::find($id);
        $pertek = Pertek_pkplh::where('id_pkplh', $id)->get();
        $roman = 2 + count($pertek);

		$headers = array(
			"Content-type" => "text/html",

			"Content-Disposition" => "attachment; Filename=Rintek_$pkplh->pelaku_usaha_baru.doc"
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
						LAMPIRAN ' . integerToRoman($roman) .' <br>
						KEPUTUSAN MENTRI LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA <br>
						NOMOR <br>
						TENTANG PERSETUJUAN PERNYATAAN KESANGGUPAN PENGELOLAAN LINGKUNGAN HIDUP KEGIATAN '.strtoupper($pkplh->nama_usaha_baru).'
						OLEH '. strtoupper($pkplh->pelaku_usaha_baru).'
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
				<td width="40%">&nbsp;</td>
				<td width="60%">
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

    public function chat($id)
	{
		$data = Pkplh::find($id);
		$chat = Chat_pkplh::where('id_pkplh', $data->id)->orderBy('created_at')->get();
		$role = $this->level();

		if (count($chat) == 0) {
			$chat = null;
		}

		return view('layouts.chat_pkplh', compact('data', 'chat', 'role'));
	}

	public function chatCreate(Request $request, $id)
	{
		if ($request->role == 'Pemrakarsa') {
			$nama = Auth::user()->name;
		} else {
			$nama = 'PJM';
		}

		$chat = new Chat_pkplh;
		$chat->id_pkplh = $id;
		$chat->nama = $nama;
		$chat->chat = $request->chat;
		$chat->sender = $request->role;
		$chat->notif = 0;
		$chat->save();

		return redirect()->back();
	}

	public function chatUpdate(Request $request, $id)
	{
		if ($request->role == 'Pemrakarsa') {
			$nama = Auth::user()->name;
		} else {
			$nama = 'PJM';
		}

		$chat = Chat_pkplh::find($id);
		$chat->nama = $nama;
		$chat->chat = $request->chat;
		$chat->sender = $request->role;
		$chat->update();

		if ($request->role == 'Operator') {
			return redirect()->route('pkplh.operator.chat', $chat->id_pkplh);
		} else {
			return redirect()->route('pkplh.chat', $chat->id_pkplh);
		}
	}

    public function notifUpdate($id)
	{
		$chat = Chat_pkplh::find($id);
        $chat->notif = 1;
		$chat->update();

		$role = $this->level();

		if ($role == 'Operator') {
			return redirect()->route('pkplh.operator.chat', $chat->id_pkplh);
		} else {
			return redirect()->route('pkplh.chat', $chat->id_pkplh);
		}
	}
}

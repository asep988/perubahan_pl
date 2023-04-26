<?php

namespace App\Http\Controllers;

use App\Exports\PkplhExport;
use App\Exports\SkklExport;
use App\Pkplh;
use Illuminate\Http\Request;
use App\Skkl;
use App\User;
use App\Pertek_skkl;
use App\Pertek_pkplh;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class SekretariatController extends Controller
{
    public function index()
    {
        $data_skkl = Skkl::orderBy('tgl_validasi', 'ASC')->get();
        $operators = User::join('tuk_secretary_members', 'users.email', 'tuk_secretary_members.email')
		->join('feasibility_test_teams', 'tuk_secretary_members.id_feasibility_test_team', 'feasibility_test_teams.id')
		->where('feasibility_test_teams.authority', 'Pusat')
        ->where('tuk_secretary_members.institution', 'like', '%PDLUK%')
		->select('users.name')
        ->orderBy('users.name', 'ASC')
		->get();

        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $pertek_skkl = Pertek_skkl::join('skkl', 'pertek_skkl.id_skkl', 'skkl.id')
        ->select('pertek_skkl.id_skkl', 'pertek_skkl.pertek', 'pertek_skkl.surat_pertek')
        ->orderBy('pertek_skkl.id', 'asc')->get();

        return view('sekretariat.skkl.index', compact('data_skkl', 'operators', 'pemrakarsa', 'pertek_skkl'));
    }

    public function datatableSkkl()
    {
        $limit = request('length');
        $start = request('start');
        $search = request('search');
        $total = Skkl::get();
        
        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $data = Skkl::select(
            'id',
            'noreg',
            'created_at',
            'user_id',
            'nama_usaha_baru',
            'status',
            'pic_pemohon',
            'no_hp_pic',
            'nama_operator',
            'jenis_perubahan',
            'nomor_validasi',
            'tgl_validasi',
            'perihal',
            'tgl_rpd',
            'count',
            'pelaku_usaha',
            'note',
            'pertek',
        );

        if ($search['value'] != '') {
            $data->where('id', 'like', '%' . $search['value'] . '%')
            ->orWhere('noreg', 'like', '%' . $search['value'] . '%')
            ->orWhere('nama_usaha_baru', 'like', '%' . $search['value'] . '%')
            ->orWhere('status', 'like', '%' . $search['value'] . '%')
            ->orWhere('pic_pemohon', 'like', '%' . $search['value'] . '%')
            ->orWhere('no_hp_pic', 'like', '%' . $search['value'] . '%')
            ->orWhere('nama_operator', 'like', '%' . $search['value'] . '%')
            ->orWhere('nomor_validasi', 'like', '%' . $search['value'] . '%')
            ->orWhere('tgl_validasi', 'like', '%' . $search['value'] . '%')
            ->orWhere('perihal', 'like', '%' . $search['value'] . '%')
            ->orWhere('pelaku_usaha', 'like', '%' . $search['value'] . '%');
        }

        $data = $data->orderBy('tgl_validasi', 'ASC')->skip($start)->take($limit)->get();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->count = $start + $i + 1;
            if ($data[$i]->status == "Belum") {
                $status = '<span class="badge badge-secondary">Belum diproses</span>';
            } elseif ($data[$i]->status == "Submit") {
                $status = '<span class="badge badge-info">Sudah Submit</span>';
            } elseif ($data[$i]->status == "Proses") {
                $status = '<span class="badge badge-warning">Proses Validasi</span>';
            } elseif ($data[$i]->status == "Draft") {
                $status = '<span class="badge badge-primary">Selesai Drafting</span>';
            } elseif ($data[$i]->status == "Final") {
                $status = '<span class="badge badge-success">Selesai</span>';
            } elseif ($data[$i]->status == "Batal") {
                $status = '<span class="badge badge-danger" title="' . $data[$i]->note . '">Dibatalkan</span>';
            } else {
                $status = '<span class="badge badge-danger" title="' . $data[$i]->note . '">Ditolak</span>';
            }
            $data[$i]->status = $status;

            foreach ($pemrakarsa as $user) {
                if ($data[$i]->user_id == $user->id) {
                    $data[$i]->pelaku_usaha = $user->name;
                }
            }

            $pic = $data[$i]->pic_pemohon . '<br>' . $data[$i]->no_hp_pic;
            $data[$i]->pic_pemohon = $pic;

            if ($data[$i]->nama_operator == null) {
                $data[$i]->nama_operator = '-';
            }

            if ($data[$i]->jenis_perubahan == 'perkep1') {
                $perkep = 'Perubahan Kepemilikkan';
            } elseif ($data[$i]->jenis_perubahan == 'perkep2') {
                $perkep = 'Perubahan Kepemilikkan dan Integrasi Pertek/Rintek';
            } elseif ($data[$i]->jenis_perubahan == 'perkep3') {
                $perkep = 'Integrasi Pertek/Rintek';
            }
            $data[$i]->jenis_perubahan = $perkep;

            $disable = '';
            if ($data[$i]->status == "Ditolak") {
                $disable = 'disabled';
            }

            $data[$i]->note = '<div class="btn-group-vertical">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        '. $disable .' data-toggle="modal"
                                        data-target="#tolak'.$data[$i]->id.'">
                                        Tolak
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#aksiModal'. $data[$i]->id .'">
                                        Pilih
                                    </button>
                                </div>';

            $data[$i]->pertek = '<button id="' . $data[$i]->noreg . '" type="button" class="btn penugasan-btn btn-sm btn-success">
                                    Penugasan
                                </button>
                                <input type="text" id="id_' . $data[$i]->noreg . '" value="'. $data[$i]->id .'" hidden>
                                <input type="text" id="nu_' . $data[$i]->noreg . '" value="'. $data[$i]->nama_usaha_baru .'" hidden>
                                <input type="text" id="pu_' . $data[$i]->noreg . '" value="'. $data[$i]->pelaku_usaha .'" hidden>';
                                
            // $data[$i]->pertek = '<select class="operator-list" style="width: 100%" name="operator_name[]">
            //                         <option value="-">Pilih</option>' . $operator .
            //                     '</select>
            //                     <input type="text" name="id[]" value="'. $data[$i]->id .'" hidden>
            //                     <script>
            //                         $(document).ready(function() {
            //                             $(".operator-list").select2();
            //                         });
            //                     </script>';

            $tgl = $data[$i]->created_at->format('d-m-Y, H:i:s');
            $data[$i]->tgl_rpd = $tgl;
        }

        return response()->json([
            "draw" => intval(request('draw')),
            "recordsTotal" => intval($total->count()),
            "recordsFiltered" => intval($total->count()),
            "data" => $data
        ]);
    }

    public function datatablePkplh()
    {
        $limit = request('length');
        $start = request('start');
        $search = request('search');
        $total = Pkplh::get();
        
        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $data = Pkplh::select(
            'id',
            'noreg',
            'created_at',
            'user_id',
            'nama_usaha_baru',
            'status',
            'pic_pemohon',
            'no_hp_pic',
            'nama_operator',
            'jenis_perubahan',
            'nomor_validasi',
            'tgl_validasi',
            'perihal',
            'tgl_rpd',
            'count',
            'pelaku_usaha',
            'note',
            'pertek',
        );

        if ($search['value'] != '') {
            $data->where('id', 'like', '%' . $search['value'] . '%')
            ->orWhere('noreg', 'like', '%' . $search['value'] . '%')
            ->orWhere('nama_usaha_baru', 'like', '%' . $search['value'] . '%')
            ->orWhere('status', 'like', '%' . $search['value'] . '%')
            ->orWhere('pic_pemohon', 'like', '%' . $search['value'] . '%')
            ->orWhere('no_hp_pic', 'like', '%' . $search['value'] . '%')
            ->orWhere('nama_operator', 'like', '%' . $search['value'] . '%')
            ->orWhere('nomor_validasi', 'like', '%' . $search['value'] . '%')
            ->orWhere('tgl_validasi', 'like', '%' . $search['value'] . '%')
            ->orWhere('perihal', 'like', '%' . $search['value'] . '%')
            ->orWhere('pelaku_usaha', 'like', '%' . $search['value'] . '%');
        }

        $data = $data->orderBy('tgl_validasi', 'ASC')->skip($start)->take($limit)->get();

        for ($i=0; $i < count($data); $i++) { 
            $data[$i]->count = $start + $i + 1;
            if ($data[$i]->status == "Belum") {
                $status = '<span class="badge badge-secondary">Belum diproses</span>';
            } elseif ($data[$i]->status == "Submit") {
                $status = '<span class="badge badge-info">Sudah Submit</span>';
            } elseif ($data[$i]->status == "Proses") {
                $status = '<span class="badge badge-warning">Proses Validasi</span>';
            } elseif ($data[$i]->status == "Draft") {
                $status = '<span class="badge badge-primary">Selesai Drafting</span>';
            } elseif ($data[$i]->status == "Final") {
                $status = '<span class="badge badge-success">Selesai</span>';
            } elseif ($data[$i]->status == "Batal") {
                $status = '<span class="badge badge-danger" title="' . $data[$i]->note . '">Dibatalkan</span>';
            } else {
                $status = '<span class="badge badge-danger" title="' . $data[$i]->note . '">Ditolak</span>';
            }
            $data[$i]->status = $status;

            foreach ($pemrakarsa as $user) {
                if ($data[$i]->user_id == $user->id) {
                    $data[$i]->pelaku_usaha = $user->name;
                }
            }

            $pic = $data[$i]->pic_pemohon . '<br>' . $data[$i]->no_hp_pic;
            $data[$i]->pic_pemohon = $pic;

            if ($data[$i]->nama_operator == null) {
                $data[$i]->nama_operator = '-';
            }

            if ($data[$i]->jenis_perubahan == 'perkep1') {
                $perkep = 'Perubahan Kepemilikkan';
            } elseif ($data[$i]->jenis_perubahan == 'perkep2') {
                $perkep = 'Perubahan Kepemilikkan dan Integrasi Pertek/Rintek';
            } elseif ($data[$i]->jenis_perubahan == 'perkep3') {
                $perkep = 'Integrasi Pertek/Rintek';
            }
            $data[$i]->jenis_perubahan = $perkep;

            $disable = '';
            if ($data[$i]->status == "Ditolak") {
                $disable = 'disabled';
            }

            $data[$i]->note = '<div class="btn-group-vertical">
                                    <button type="button" class="btn btn-sm btn-danger"
                                        '. $disable .' data-toggle="modal"
                                        data-target="#tolak'.$data[$i]->id.'">
                                        Tolak
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#aksiModal'. $data[$i]->id .'">
                                        Pilih
                                    </button>
                                </div>';

            $data[$i]->pertek = '<button id="' . $data[$i]->noreg . '" type="button" class="btn penugasan-btn btn-sm btn-success">
                                    Penugasan
                                </button>
                                <input type="text" id="id_' . $data[$i]->noreg . '" value="'. $data[$i]->id .'" hidden>
                                <input type="text" id="nu_' . $data[$i]->noreg . '" value="'. $data[$i]->nama_usaha_baru .'" hidden>
                                <input type="text" id="pu_' . $data[$i]->noreg . '" value="'. $data[$i]->pelaku_usaha .'" hidden>';

            $tgl = $data[$i]->created_at->format('d-m-Y, H:i:s');
            $data[$i]->tgl_rpd = $tgl;
        }

        return response()->json([
            "draw" => intval(request('draw')),
            "recordsTotal" => intval($total->count()),
            "recordsFiltered" => intval($total->count()),
            "data" => $data
        ]);
    }

    public function datatables_skkl()
    {
        $data = Skkl::latest()->get();
        return DataTables::of($data);
    }

    public function assign(Request $request)
    {
        $request->validate([
            'operator_name' => 'required'
        ]);

        for ($i = 0; $i < count($request->id); $i++) {
            $skkl = Skkl::find($request->id[$i]);
    
            if ($skkl->tgl_update) {
                $time = $skkl->tgl_update;
            } else {
                $time = Carbon::now()->toDateString();
            }
    
            if ($request->operator_name[$i] != '-') {
                Skkl::find($request->id[$i])->update([
                    'nama_operator' => $request->operator_name[$i],
                    'status' => "Proses",
                    'tgl_update' => $time
                ]);
            }
        }

        return redirect()->route('sekre.skkl.index')->with('message', 'Berhasil menugaskan PJM pada usaha/kegiatan yang dipilih');
    }
    
    public function skklReject(Request $request, $id)
    {
        Skkl::find($id)->update([
            'status' => "Ditolak",
            'tgl_update' => Carbon::now()->toDateString(),
            'nama_operator' => null,
            'note' => $request->note
        ]);
        
        $skkl = Skkl::find($id);

        return redirect()->route('sekre.skkl.index')->with('message', $skkl->nama_usaha_baru . ' berhasil ditolak!');
    }

    public function pkplhIndex()
    {
        $data_pkplh = Pkplh::orderBy('updated_at', 'DESC')->get();
        $operators = User::join('tuk_secretary_members', 'users.email', 'tuk_secretary_members.email')
		->join('feasibility_test_teams', 'tuk_secretary_members.id_feasibility_test_team', 'feasibility_test_teams.id')
		->where('feasibility_test_teams.authority', 'Pusat')
		->where('tuk_secretary_members.institution', 'like', '%PDLUK%')
		->select('users.name')
        ->orderBy('users.name', 'ASC')
		->get();

        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $pertek_pkplh = Pertek_pkplh::join('pkplh', 'pertek_pkplh.id_pkplh', 'pkplh.id')
        ->select('pertek_pkplh.id_pkplh', 'pertek_pkplh.pertek', 'pertek_pkplh.surat_pertek')
        ->orderBy('pertek_pkplh.id', 'asc')->get();

        return view('sekretariat.pkplh.index', compact('data_pkplh', 'operators', 'pemrakarsa', 'pertek_pkplh'));
    }

    public function pkplhAssign(Request $request)
    {
        $request->validate([
            'operator_name' => 'required'
        ]);

        for ($i = 0; $i < count($request->id); $i++) {
            $pkplh = Pkplh::find($request->id[$i]);
    
            if ($pkplh->tgl_update) {
                $time = $pkplh->tgl_update;
            } else {
                $time = Carbon::now()->toDateString();
            }
    
            if ($request->operator_name[$i] != '-') {
                Pkplh::find($request->id[$i])->update([
                    'nama_operator' => $request->operator_name[$i],
                    'status' => "Proses",
                    'tgl_update' => $time
                ]);
            }
        }

        return redirect()->route('sekre.pkplh.index')->with('message', 'Berhasil menugaskan PJM pada usaha/kegiatan yang dipilih');
    }

    public function pkplhReject(Request $request, $id)
    {
        Pkplh::find($id)->update([
            'status' => "Ditolak",
            'tgl_update' => Carbon::now()->toDateString(),
            'nama_operator' => null,
            'note' => $request->note
        ]);
        
        $pkplh = Pkplh::find($id);

        return redirect()->route('sekre.pkplh.index')->with('message', 'Permohonan perubahan ' . $pkplh->pelaku_usaha_baru . ' berhasil ditolak!');
    }

    public function skklExport()
    {
        return Excel::download(new SkklExport, 'Rekap SKKL.xlsx');
    }

    public function pkplhExport()
    {
        return Excel::download(new PkplhExport, 'Rekap PKPLH.xlsx');
    }
}

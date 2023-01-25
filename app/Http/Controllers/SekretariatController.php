<?php

namespace App\Http\Controllers;

use App\Pkplh;
use Illuminate\Http\Request;
use App\Skkl;
use App\User;
use Carbon\Carbon;

class SekretariatController extends Controller
{
    public function index()
    {
        $data_skkl = Skkl::orderBy('updated_at', 'DESC')->get();
        $operators = User::join('tuk_secretary_members', 'users.email', 'tuk_secretary_members.email')
		->join('feasibility_test_teams', 'tuk_secretary_members.id_feasibility_test_team', 'feasibility_test_teams.id')
		->where('feasibility_test_teams.authority', 'Pusat')
		->select('users.name')
		->get();

        return view('sekretariat.skkl.index', compact('data_skkl', 'operators'));
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
    
    public function skklReject($id)
    {
        Skkl::find($id)->update([
            'status' => "Ditolak",
            'tgl_update' => Carbon::now()->toDateString(),
            'nama_operator' => null
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
		->select('users.name')
		->get();

        return view('sekretariat.pkplh.index', compact('data_pkplh', 'operators'));
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

    public function pkplhReject($id)
    {
        Pkplh::find($id)->update([
            'status' => "Ditolak",
            'tgl_update' => Carbon::now()->toDateString(),
            'nama_operator' => null
        ]);
        
        $pkplh = Pkplh::find($id);

        return redirect()->route('sekre.pkplh.index')->with('message', 'Permohonan perubahan ' . $pkplh->pelaku_usaha_baru . ' berhasil ditolak!');
    }
}

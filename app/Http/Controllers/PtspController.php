<?php

namespace App\Http\Controllers;

use App\Skkl;
use App\User;
use App\Pkplh;
use App\Uklupl;
use App\rkl;
use App\rpl;
use App\Pertek_skkl;
use App\Pertek_pkplh;
use Illuminate\Http\Request;

class PtspController extends Controller
{
    public function login()
    {
        return view('ptsp.login');
    }

    public function authenticate(Request $request)
    {
        if ($request->password == "Amdalnetptsp") {
            return redirect()->route('ptsp.skkl.index');
        } else {
            return redirect()->back()->with('message', 'Password salah!');
        }
    }

    public function skklIndex()
    {
        $data_skkl = Skkl::orderBy('tgl_validasi', 'ASC')->get();
        $pertek_skkl = Pertek_skkl::join('skkl', 'pertek_skkl.id_skkl', 'skkl.id')
        ->select('pertek_skkl.id_skkl', 'pertek_skkl.pertek', 'pertek_skkl.surat_pertek')
        ->orderBy('pertek_skkl.id', 'asc')->get();
        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $jum_rkl = array();
        $jum_rpl = array();
        foreach ($data_skkl as $row) {
            $jum_rkl[] = Rkl::where('id_skkl', $row->id)->get()->count();
            $jum_rpl[] = Rpl::where('id_skkl', $row->id)->get()->count();
        }
        
        return view('ptsp.skkl.index', compact('data_skkl', 'jum_rkl', 'jum_rpl', 'pertek_skkl', 'pemrakarsa'));
    }

    public function pkplhIndex()
    {
        $data_pkplh = Pkplh::orderBy('updated_at', 'DESC')->get();
        $pertek_pkplh = Pertek_pkplh::join('pkplh', 'pertek_pkplh.id_pkplh', 'pkplh.id')
        ->select('pertek_pkplh.id_pkplh', 'pertek_pkplh.pertek', 'pertek_pkplh.surat_pertek')
        ->orderBy('pertek_pkplh.id', 'asc')->get();
        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        ->where('initiators.user_type', 'Pemrakarsa')
        ->orWhere('initiators.user_type', 'Pemerintah')
        ->select('users.id', 'users.name', 'users.email')
        ->get();

        $jum_uklupl = array();
        foreach ($data_pkplh as $row) {
            $jum_uklupl[] = Uklupl::where('id_pkplh', $row->id)->get()->count();
        }

        return view('ptsp.pkplh.index', compact('data_pkplh', 'jum_uklupl', 'pertek_pkplh', 'pemrakarsa'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Chat_skkl;
use App\il_pkplh;
use App\il_skkl;
use App\Pertek_pkplh;
use App\Pertek_skkl;
use App\Pkplh;
use App\rkl;
use App\rpl;
use Illuminate\Http\Request;
use App\Skkl;
use App\Uklupl;
use App\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id =  Auth::user()->id;
        $data_skkl = Skkl::where('user_id',$user_id)->orderBy('updated_at', 'desc')->get();
        $pertek_skkl = Pertek_skkl::join('skkl', 'pertek_skkl.id_skkl', 'skkl.id')
        ->select('pertek_skkl.id_skkl', 'pertek_skkl.pertek', 'pertek_skkl.surat_pertek')
        ->where('skkl.user_id', $user_id)->orderBy('pertek_skkl.id', 'asc')->get();

        return view('home.skkl.index', compact('data_skkl', 'pertek_skkl'));
    }

    public function reset()
    {
        il_skkl::truncate();
        il_pkplh::truncate();
        Skkl::truncate();
        Pkplh::truncate();
        Pertek_skkl::truncate();
        Pertek_pkplh::truncate();
        rkl::truncate();
        rpl::truncate();
        Uklupl::truncate();

        return redirect()->route('redirection');
    }

    public function redirection()
    {
        if (Auth::check()) {
            $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
            ->where('initiators.user_type', 'Pemrakarsa')
            ->orWhere('initiators.user_type', 'Pemerintah')
            ->get();

            $operator = User::join('tuk_secretary_members', 'users.email', 'tuk_secretary_members.email')
            ->join('feasibility_test_teams', 'tuk_secretary_members.id_feasibility_test_team', 'feasibility_test_teams.id')
            ->where('feasibility_test_teams.authority', 'Pusat')
            ->select('users.email')
            ->get();

            $sekretariat = User::join('luk_members', 'users.email', 'luk_members.email')
            ->join('feasibility_test_team_members', 'luk_members.id', 'feasibility_test_team_members.id_luk_member')
            ->join('feasibility_test_teams', 'feasibility_test_teams.id', 'feasibility_test_team_members.id_feasibility_test_team')
            ->select('users.email')
            ->where('feasibility_test_team_members.position', 'Kepala Sekretariat')
            ->where('feasibility_test_teams.authority', 'Pusat')
            ->get();
            
            $level = 'unregistered';
            for ($i = 0; $i < count($pemrakarsa); $i++) {
                if (Auth::user()->email == $pemrakarsa[$i]->email) {
                    $level = 'Pemrakarsa';
                }
            }
            
            for ($i = 0; $i < count($operator); $i++) {
                if (Auth::user()->email == $operator[$i]->email) {
                    $level = 'Operator';
                }
            }

            for ($i = 0; $i < count($sekretariat); $i++) {
                if (Auth::user()->email == $sekretariat[$i]->email) {
                    $level = 'Sekretariat';
                }
            }

            return redirect()->intended('/'.$level);
        } else {
            return view('check');
        }
    }

    public function testing()
    {
        $pdf = Pdf::loadView('layouts.registration');
        return $pdf->stream();
    }

    public function dd()
    {
        $skkl = Skkl::find(63);
        $tes = rkl::where('id_skkl', $skkl->id)->get()->count();
        return $tes;
    }

    public function registration_def()
    {
        $skkl = Skkl::all();
        $pkplh = Pkplh::all();

        for ($i = 0; $i < count($skkl); $i++) {
            $hash = hash_hmac('sha256', $skkl[$i]->nama_usaha_baru . $i, 'SKKL');    
            $regist = "A" . substr($hash, 0, 14);
            Skkl::find($skkl[$i]->id)->update(['noreg' => $regist]);
        }

        for ($i = 0; $i < count($pkplh); $i++) {
            $hash = hash_hmac('sha256', $pkplh[$i]->nama_usaha_baru . $i, 'PKPLH');    
            $regist = "B" . substr($hash, 0, 14);
            Pkplh::find($pkplh[$i]->id)->update(['noreg' => $regist]);
        }


        return "Berhasil";
    }
}
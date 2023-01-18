<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Skkl;
use App\User;
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
        $batas = 5;
        $jumlah_skkl = Skkl::count('user_id');
        $data_skkl = Skkl::where('user_id',$user_id)->orderBy('user_id', 'desc')->paginate($batas);

        $no = $batas * ($data_skkl->currentpage() - 1);
        return view('home.index', compact('data_skkl','no','jumlah_skkl'));
    }

    public function redirection()
    {
        if (Auth::check()) {
            $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
            ->where('initiators.user_type', 'Pemrakarsa')
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
            return view('auth.login');
        }
    }

    public function cekRole()
    {
        $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
		->where('initiators.user_type', 'Pemrakarsa')
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
		
        $role = 'unregistered';
		for ($i = 0; $i < count($pemrakarsa); $i++) {
			if (Auth::user()->email == $pemrakarsa[$i]->email) {
				$role = 'Pemrakarsa';
			}
		}

		for ($i = 0; $i < count($operator); $i++) {
			if (Auth::user()->email == $operator[$i]->email) {
				$role = 'Operator';
			}
		}

        for ($i = 0; $i < count($sekretariat); $i++) {
            if (Auth::user()->email == $sekretariat[$i]->email) {
                $role = 'Sekretariat';
            }
        }

        return view('home.check', compact('role'));
    }

    public function queryCheck()
    {
        $cek = User::join('luk_members', 'users.email', 'luk_members.email')
        ->join('feasibility_test_team_members', 'luk_members.id', 'feasibility_test_team_members.id_luk_member')
        ->join('feasibility_test_teams', 'feasibility_test_teams.id', 'feasibility_test_team_members.id_feasibility_test_team')
        ->select('users.email')
        ->where('feasibility_test_team_members.position', 'Kepala Sekretariat')
        ->where('feasibility_test_teams.authority', 'Pusat')
        ->get();

        return $cek;
    }
}

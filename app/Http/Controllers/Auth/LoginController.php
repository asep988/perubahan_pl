<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as authenticate;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect()->intended('https://amdalnet.menlhk.go.id/#/login');
    }
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // if (authenticate::check()) {
        //     $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
        //     ->where('initiators.user_type', 'Pemrakarsa')
        //     ->get();

        //     $operator = User::join('tuk_secretary_members', 'users.email', 'tuk_secretary_members.email')
        //     ->join('feasibility_test_teams', 'tuk_secretary_members.id_feasibility_test_team', 'feasibility_test_teams.id')
        //     ->where('feasibility_test_teams.authority', 'Pusat')
        //     ->select('users.email')
        //     ->get();
            
        //     $level = 'unregistered';
        //     for ($i = 0; $i < count($pemrakarsa); $i++) {
        //         if (authenticate::user()->getEmail() == $pemrakarsa[$i]->email) {
        //             $level = 'Pemrakarsa';
        //         }
        //     }

        //     for ($i = 0; $i < count($operator); $i++) {
        //         if (authenticate::user()->getEmail() == $operator[$i]->email) {
        //             $level = 'Operator';
        //         }
        //     }

        //     $this->redirectTo = '/' . $level;
        // }
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        if (authenticate::check()) {
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
                if (authenticate::user()->email == $pemrakarsa[$i]->email) {
                    $level = 'Pemrakarsa';
                }
            }

            for ($i = 0; $i < count($operator); $i++) {
                if (authenticate::user()->email == $operator[$i]->email) {
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
}

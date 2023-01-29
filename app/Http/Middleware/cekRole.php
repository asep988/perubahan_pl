<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$levels)
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

        if (in_array($role,$levels)) {
            return $next($request);
        }

        return redirect('/');
    }
}
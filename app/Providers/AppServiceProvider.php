<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        config(['app.locale' => 'id']);
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        // $pemrakarsa = User::join('initiators', 'users.email', 'initiators.email')
		// ->where('initiators.user_type', 'Pemrakarsa')
		// ->get();

		// $operator = User::join('tuk_secretary_members', 'users.email', 'tuk_secretary_members.email')
		// ->join('feasibility_test_teams', 'tuk_secretary_members.id_feasibility_test_team', 'feasibility_test_teams.id')
		// ->where('feasibility_test_teams.authority', 'Pusat')
		// ->select('users.email')
		// ->get();
		
        // $role = 'unregistered';
		// for ($i = 0; $i < count($pemrakarsa); $i++) {
		// 	if (Auth::user()->email == $pemrakarsa[$i]->email) {
		// 		$role = 'Pemrakarsa';
		// 	}
		// }

		// for ($i = 0; $i < count($operator); $i++) {
		// 	if (Auth::user()->email == $operator[$i]->email) {
		// 		$role = 'Operator';
		// 	}
		// }

        // view()->share('user_role', $role);
    }
}

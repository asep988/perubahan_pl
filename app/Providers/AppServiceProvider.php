<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\User;
use App\Chat_skkl;
use App\Chat_pkplh;

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

        view()->composer('*', function ($view)
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

            $skkl_notif = Chat_skkl::join('skkl', 'chat_skkl.id_skkl', 'skkl.id')
            ->select('skkl.noreg', 'skkl.nama_usaha_baru', 'chat_skkl.created_at', 'chat_skkl.id');

            if ($role != 'Operator') {
                $skkl_notif->where('skkl.user_id', Auth::user()->id);
            } else {
                $skkl_notif->where('skkl.nama_operator', Auth::user()->name);
            }

            $skkl_notif->where('chat_skkl.sender', '!=', $role)
            ->where('chat_skkl.notif', 0);

            $pkplh_notif = Chat_pkplh::join('pkplh', 'chat_pkplh.id_pkplh', 'pkplh.id')
            ->select('pkplh.noreg', 'pkplh.nama_usaha_baru', 'chat_pkplh.created_at', 'chat_pkplh.id');

            if ($role != 'Operator') {
                $pkplh_notif->where('pkplh.user_id', Auth::user()->id);
            } else {
                $pkplh_notif->where('pkplh.nama_operator', Auth::user()->name);
            }

            $pkplh_notif->where('chat_pkplh.sender', '!=', $role)
            ->where('chat_pkplh.notif', 0);

            $skkl_jml = $skkl_notif->count();
            $pkplh_jml = $pkplh_notif->count();

            if (count($skkl_notif->get()) == 0) {
                $data_skkl = null;
            } else {
                $data_skkl = $skkl_notif->get();
            }

            if (count($pkplh_notif->get()) == 0) {
                $data_pkplh = null;
            } else {
                $data_pkplh = $pkplh_notif->get();
            }

            $view->with([
                'notif_skkl' => $data_skkl,
                'notif_pkplh' => $data_pkplh,
                'notif_jml' => $skkl_jml + $pkplh_jml
            ]);
        });
        
        view()->share([
            'pemrakarsa_role' => $pemrakarsa,
            'operator_role' => $operator,
            'sekretariat_role' => $sekretariat,
        ]);
    }
}

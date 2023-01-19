<?php

namespace App\Http\Controllers;

use App\Pkplh;
use Illuminate\Http\Request;
use App\Skkl;
use App\User;

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

        return view('sekretariat.penugasan.index', compact('data_skkl', 'operators'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'operator_name' => 'required'
        ]);

        Skkl::find($id)->update([
            'nama_operator' => $request->operator_name
        ]);

        $skkl = Skkl::find($id);

        return redirect()->route('sekre.penugasan.index')->with('message', $request->operator_name . ' berhasil ditugaskan pada usaha/kegiatan ' . $skkl->nama_usaha_baru);
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

    public function pkplhAssign(Request $request, $id)
    {
        $request->validate([
            'operator_name' => 'required'
        ]);

        Pkplh::find($id)->update([
            'nama_operator' => $request->operator_name
        ]);

        $pkplh = Pkplh::find($id);

        return redirect()->route('sekre.pkplh.index')->with('message', $request->operator_name . ' berhasil ditugaskan pada usaha/kegiatan ' . $pkplh->nama_usaha_baru);
    }
}

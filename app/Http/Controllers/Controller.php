<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function integerToRoman($integer)
    {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array(
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        );

        foreach ($lookup as $roman => $value) {
            // Determine the number of matches
            $matches = intval($integer / $value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman, $matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }

    public function level()
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

        return $level;
    }
}

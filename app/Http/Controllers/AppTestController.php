<?php
// IMPORTANT NOTE: Nanti Controller Ini Dihapus 
namespace App\Http\Controllers;

use App\Entity\Project;
use App\Entity\Views\afterMeeting;
use App\Entity\Views\datedMeeting;
use App\Entity\Views\incomplete;
use App\Entity\Views\processed;
use App\Entity\Views\ptspValidated;
use App\Entity\Views\reportedMeeting;
use App\Entity\Views\returnedRejected;
use App\Entity\Views\returnedUnverificated;
use App\Entity\Views\undatedVerificated;
use App\Entity\Views\unverificated;
use App\Entity\Views\verificated;
use Google\Service\SecurityCommandCenter\Process;
use Hash;
use Illuminate\Http\Request;

class AppTestController extends Controller
{
    public function kegiatan()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }

        request('search') ? $search = request("search") : $search = "";
        $data = Project::select('id', 'registration_no', 'project_title', 'authority', 'description', 'required_doc', 'id_applicant')
        ->with(['initiator' => function ($query) {
            $query->select('id','name','pic','email','user_type');
        }])
        ->whereHas('initiator', function ($query) use ($search) {
            $query->where('name', 'ilike', '%' . $search . '%')
            ->orWhere('pic', 'ilike', '%' . $search . '%')
            ->orWhere('email', 'ilike', '%' . $search . '%')
            ->orWhere('user_type', 'ilike', '%' . $search . '%');
        })
        ->where('id_applicant', '!=', null)
        ->where('registration_no', 'like', '%' . $search . '%')
        ->orWhere('project_title', 'like', '%' . $search . '%')
        ->orWhere('authority', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->orWhere('required_doc', 'like', '%' . $search . '%')
        ->orderBy('id', 'ASC');

        $totalFiltered = $data->count();
        (request('start') >= 0) && request('limit') ? $data = $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data = $data->offset(0)->take(100)->get();
        
        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' => Project::with(['initiator'])->whereHas('initiator')->count(),
            'recordsFiltered' => $totalFiltered,
            'data' => $data->makeHidden(['filling_date', 'tuk_project_count', 'submission_deadline', 'rkl_rpl_document', 'andal_document', 'ukl_upl_document', 'form_ka_doc']) 
        ];
        return response()->json($result);
    }

    public function afterMeeting()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }

        request('search') ? $search = request("search") : $search = "";
        $data = afterMeeting::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('meeting_date', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' => afterMeeting::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function datedMeeting()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }

        request('search') ? $search = request("search") : $search = "";
        $data = datedMeeting::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('meeting_date', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' => datedMeeting::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function incomplete()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = incomplete::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('is_complete', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  incomplete::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function processed()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = processed::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  processed::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function ptspValidated()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = ptspValidated::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%')
        ->orWhere('tanggal_validasi', 'ilike', '%' . $search . '%')
        ->orWhere('no_registrasi_ba', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  ptspValidated::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function reportedMeeting()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = reportedMeeting::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  reportedMeeting::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function returnedRejected()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = returnedRejected::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%')
        ->orWhere('is_complete', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  returnedRejected::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function returnedUnverificated()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = returnedUnverificated::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%')
        ->orWhere('is_complete', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  returnedUnverificated::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function undatedVerificated()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = undatedVerificated::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%')
        ->orWhere('is_complete', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  undatedVerificated::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function unverificated()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = unverificated::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  unverificated::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    public function verificated()
    {
        if ($this->authenticate(request('key')) == false) {
            return response()->json(['message' => 'Unauthorized']);
        }
        
        request('search') ? $search = request("search") : $search = "";
        $data = verificated::where('name', 'ilike', '%' . $search . '%')
        ->orWhere('required_doc', 'ilike', '%' . $search . '%')
        ->orWhere('project_title', 'ilike', '%' . $search . '%')
        ->orWhere('registration_no', 'ilike', '%' . $search . '%')
        ->orWhere('is_complete', 'ilike', '%' . $search . '%');

        $result = [
            'draw' => intval(request('draw')),
            'recordsTotal' =>  verificated::count(),
            'recordsFiltered' => $data->count('id'),
            'data' => (request('start') >= 0) && request('limit') ? $data->offset((request('start') >= 0))->take(request('limit'))->get() : $data->get()
        ];
        return response()->json($result);
    }

    private function authenticate($key)
    {
        //amdalnet
        Hash::check($key, '$2a$12$I4ydLmcIge28cal6U3TKZeuyW.k2b4q7xX7UroV7p1RCnS4FkZcem') ? $result = true : $result = false;

        return $result;
    }
}
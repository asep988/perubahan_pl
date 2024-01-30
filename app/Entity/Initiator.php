<?php

namespace App\Entity;

use App\Laravue\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Entity\Project;
use App\Entity\OssNib;

class Initiator extends Model
{
    use SoftDeletes;

    // protected $fillable = [
    //     'name',
    //     'pic',
    //     'email',
    //     'phone',
    //     'address',
    //     'user_type',
    //     'nib',
    // ];

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email');
    }

    public function getLogoAttribute()
    {
        if($this->attributes['logo']) {
            if(str_contains($this->attributes['logo'], 'storage/')) {
                // return $this->attributes['logo'];
                $logo = str_replace('/storage/', '', $this->attributes['logo']);
                return Storage::disk('public')->temporaryUrl($logo, now()->addMinutes(env('TEMPORARY_URL_TIMEOUT')));
            } else {
                // return Storage::url($this->attributes['logo']);
                return Storage::disk('public')->temporaryUrl($this->attributes['logo'], now()->addMinutes(env('TEMPORARY_URL_TIMEOUT')));
            }
        }

        return null;
    }

    public function getNibDocOssAttribute()
    {
        if(isset($this->attributes['nib_doc_oss']) && $this->attributes['nib_doc_oss'] != null) {
            return Storage::disk('public')->temporaryUrl($this->attributes['nib_doc_oss'], now()->addMinutes(env('TEMPORARY_URL_TIMEOUT')));
        }

        return null;
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'id_applicant', 'id');
    }

    public function ossNib()
    {
        return $this->hasOne(OssNib::class, 'nib', 'nib');
    }
}

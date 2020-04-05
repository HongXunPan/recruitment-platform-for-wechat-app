<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'sex',
        'mobile',
        'avatar',
        'union_id',
        'open_id',
        'nickname',
        'verify_wechat',
        'api_token'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','open_id'
    ];

    protected $table = 'users';

    public function identity()
    {
        return $this->hasOne(Identity::class, 'user_id');
    }

    public function recruitmentInfo()
    {
        return $this->hasOne(RecruitmentInfo::class, 'user_id');
    }

    public function adeptLanguages()
    {
        return $this->hasMany(AdeptLanguage::class, 'user_id');
    }

    public function educationExperiences()
    {
        return $this->hasMany(EducationExperience::class, 'user_id');
    }

    public function skillCertificates()
    {
        return $this->hasMany(SkillCertificate::class, 'user_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'user_id');
    }
}

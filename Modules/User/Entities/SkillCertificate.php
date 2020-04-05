<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class SkillCertificate extends Model
{
    protected $fillable = [];

    protected $table = 'user_skill_certificates';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

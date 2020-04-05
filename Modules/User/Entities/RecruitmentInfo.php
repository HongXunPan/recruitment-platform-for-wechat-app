<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class RecruitmentInfo extends Model
{
    protected $fillable = [];

    protected $table = 'user_recruitment_info';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

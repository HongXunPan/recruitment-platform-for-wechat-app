<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = [];

    protected $table = 'user_work_experiences';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

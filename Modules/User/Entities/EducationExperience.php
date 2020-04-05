<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class EducationExperience extends Model
{
    protected $fillable = [];

    protected $table = 'user_education_experiences';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

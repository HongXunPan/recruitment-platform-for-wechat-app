<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_areas';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'area_id');
    }
}

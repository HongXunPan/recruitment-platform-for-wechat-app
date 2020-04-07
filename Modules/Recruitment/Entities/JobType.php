<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

class JobType extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_job_types';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_type_ids', 'id', HasOneOrMany::SPECIAL_ELSE_SEPARATE);
    }

}

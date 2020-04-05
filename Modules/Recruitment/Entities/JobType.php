<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JobType extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_job_types';

    public function jobs1()
    {
        return Job::query()->whereRaw(DB::raw('FIND_IN_SET(?, job_type_ids)', $this->id))->get();
    }

}

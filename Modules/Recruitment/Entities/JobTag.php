<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JobTag extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_job_tags';

    public function jobs1()
    {
        return Job::query()->whereRaw(DB::raw('FIND_IN_SET(?, tag_ids)', $this->id))->get();
    }


}

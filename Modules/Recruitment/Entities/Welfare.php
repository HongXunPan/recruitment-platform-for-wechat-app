<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Welfare extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_welfare';

    public function jobs1()
    {
        return Job::query()->whereRaw(DB::raw('FIND_IN_SET(?, welfare_ids)', $this->id))->get();
    }

    public function companies1()
    {
        return Company::query()->whereRaw(DB::raw('FIND_IN_SET(?, welfare_ids)', $this->id))->get();
    }
}

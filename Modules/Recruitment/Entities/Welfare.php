<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

class Welfare extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_welfare';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'welfate_ids', 'id', HasOneOrMany::SPECIAL_ELSE_SEPARATE);
    }

    public function companies()
    {
        return $this->hasMany(Company::class, 'welfare_ids', 'id', HasOneOrMany::SPECIAL_ELSE_SEPARATE);
    }
}

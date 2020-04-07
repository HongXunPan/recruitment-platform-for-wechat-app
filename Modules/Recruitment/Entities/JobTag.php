<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

class JobTag extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_job_tags';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'tag_ids', 'id', HasOneOrMany::SPECIAL_ELSE_SEPARATE);
    }


}

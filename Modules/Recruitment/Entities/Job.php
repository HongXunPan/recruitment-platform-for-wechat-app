<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_jobs';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function tags()
    {
        return $this->hasMany(JobTag::class, 'id', 'tag_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }

    public function welfare()
    {
        return $this->hasMany(Welfare::class, 'id', 'welfare_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }

    public function type()
    {
        return $this->hasMany(JobType::class, 'id', 'job_type_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }


}

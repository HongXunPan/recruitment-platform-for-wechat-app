<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
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

    public function tags1()
    {
        $tagIdArr = explode(',', $this->tag_ids);
        return JobTag::query()
            ->whereIn('id', $tagIdArr)
            ->orderByRaw(DB::raw("FIELD(id, ?)", $this->tag_ids))
            ->get();
    }

    public function welfare1()
    {
        $welfareIdArr = explode(',', $this->welfare_ids);
        return Welfare::query()
            ->whereIn('id', $welfareIdArr)
            ->orderByRaw(DB::raw("FIELD(id, ?)", $this->welfare_ids))
            ->get();
    }

    public function type1()
    {
        $jobTypeIdArr = explode(',', $this->job_type_ids);
        return JobType::query()
            ->whereIn('id', $jobTypeIdArr)
            ->orderByRaw(DB::raw("FIELD(id, ?)", $this->job_type_ids))
            ->get();
    }


}

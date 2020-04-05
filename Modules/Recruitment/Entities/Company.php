<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_companies';

    public function images()
    {
        return $this->hasMany(CompanyImage::class, 'company_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }

    //get welfare list
    public function welfare1()
    {
        $welfareIdArr = explode(',', $this->welfare_ids);
        return Welfare::query()
            ->whereIn('id', $welfareIdArr)
            ->orderByRaw(DB::raw("FIELD(id, ?)", $this->welfare_ids))
            ->get();
    }

}

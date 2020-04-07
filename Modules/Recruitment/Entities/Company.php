<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

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

    public function welfare()
    {
        return $this->hasMany(Welfare::class, 'id', 'welfare_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }

}

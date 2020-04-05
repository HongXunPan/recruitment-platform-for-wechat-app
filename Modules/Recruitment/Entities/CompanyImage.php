<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_company_images';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}

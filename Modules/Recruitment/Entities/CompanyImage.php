<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Recruitment\Entities\CompanyImage
 *
 * @property int $id
 * @property int $company_id
 * @property string|null $image
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Recruitment\Entities\Company $company
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\CompanyImage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyImage extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_company_images';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}

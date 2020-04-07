<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

/**
 * Modules\Recruitment\Entities\Welfare
 *
 * @property int $id
 * @property string $welfare
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Welfare whereWelfare($value)
 * @mixin \Eloquent
 */
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

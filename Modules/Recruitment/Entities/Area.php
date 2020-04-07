<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Recruitment\Entities\Area
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property int $code
 * @property int $type
 * @property string $initial
 * @property int $is_hot
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereInitial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Area whereType($value)
 * @mixin \Eloquent
 */
class Area extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_areas';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'area_id');
    }
}

<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

/**
 * Modules\Recruitment\Entities\JobType
 *
 * @property int $id
 * @property string $name
 * @property int $level 等级 1标题2类型
 * @property int $parent_id
 * @property string|null $icon
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobType extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_job_types';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'job_type_ids', 'id', HasOneOrMany::SPECIAL_ELSE_SEPARATE);
    }

}

<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

/**
 * Modules\Recruitment\Entities\JobTag
 *
 * @property int $id
 * @property string $name
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\JobTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobTag extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_job_tags';

    public function jobs()
    {
        return $this->hasMany(Job::class, 'tag_ids', 'id', HasOneOrMany::SPECIAL_ELSE_SEPARATE);
    }


}

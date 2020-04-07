<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Entities\WorkExperience
 *
 * @property int $id
 * @property int $user_id
 * @property string $company
 * @property string $job
 * @property string $begin_date
 * @property string $end_date
 * @property string|null $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereBeginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\WorkExperience whereUserId($value)
 * @mixin \Eloquent
 */
class WorkExperience extends Model
{
    protected $fillable = [];

    protected $table = 'user_work_experiences';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

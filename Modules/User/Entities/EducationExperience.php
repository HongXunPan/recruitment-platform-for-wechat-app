<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Entities\EducationExperience
 *
 * @property int $id
 * @property int $user_id
 * @property string $school
 * @property string $major
 * @property int $degree_type
 * @property string $begin_date
 * @property string $end_date
 * @property string|null $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereBeginDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereDegreeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereMajor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\EducationExperience whereUserId($value)
 * @mixin \Eloquent
 */
class EducationExperience extends Model
{
    protected $fillable = [];

    protected $table = 'user_education_experiences';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

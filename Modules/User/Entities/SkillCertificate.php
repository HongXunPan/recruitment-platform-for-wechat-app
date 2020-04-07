<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Entities\SkillCertificate
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $desc
 * @property string|null $images
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\SkillCertificate whereUserId($value)
 * @mixin \Eloquent
 */
class SkillCertificate extends Model
{
    protected $fillable = [];

    protected $table = 'user_skill_certificates';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

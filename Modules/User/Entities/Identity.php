<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Entities\Identity
 *
 * @property int $id
 * @property int $user_id
 * @property string $real_name
 * @property string $no 身份证号码
 * @property string $image_front 正面 人像
 * @property string $image_back 反面 国徽
 * @property string $school
 * @property string $graduate_at 毕业年月
 * @property int $status 认证状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereGraduateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereImageBack($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereImageFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\Identity whereUserId($value)
 * @mixin \Eloquent
 */
class Identity extends Model
{
    protected $fillable = [];

    protected $table = 'user_identity';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

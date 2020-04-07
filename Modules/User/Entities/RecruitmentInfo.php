<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Entities\RecruitmentInfo
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $area_id 所在城市
 * @property string|null $birth_date 生日
 * @property string|null $height 身高
 * @property int|null $education_status 教育状态 1在读 2已毕业
 * @property int|null $highest_degree 最高学历
 * @property string|null $qq qq账号
 * @property string|null $wechat 微信账号
 * @property string $hope_work_type 期望工作类型
 * @property string $hope_work_time 期望工作时间
 * @property int $can_full_time 可否全职
 * @property string|null $self_intro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereCanFullTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereEducationStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereHighestDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereHopeWorkTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereHopeWorkType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereQq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereSelfIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\RecruitmentInfo whereWechat($value)
 * @mixin \Eloquent
 */
class RecruitmentInfo extends Model
{
    protected $fillable = [];

    protected $table = 'user_recruitment_info';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

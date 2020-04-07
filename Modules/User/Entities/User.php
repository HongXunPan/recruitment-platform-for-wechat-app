<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
 * Modules\User\Entities\User
 *
 * @property int $id
 * @property string $name 用户id
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $mobile
 * @property int $status 状态
 * @property int $is_identify 是否已认证
 * @property string|null $nickname 昵称
 * @property string|null $real_name 姓名
 * @property string|null $avatar 微信头像
 * @property int $sex 性别默认未知 01男2女
 * @property mixed|null $location 当前地理信息
 * @property string|null $openid 微信开放id
 * @property string|null $union_id 微信union_id
 * @property string|null $weapp_session_key 微信session_key
 * @property string $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\User\Entities\AdeptLanguage[] $adeptLanguages
 * @property-read int|null $adept_languages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\User\Entities\EducationExperience[] $educationExperiences
 * @property-read int|null $education_experiences_count
 * @property-read \Modules\User\Entities\Identity $identity
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Modules\User\Entities\RecruitmentInfo $recruitmentInfo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\User\Entities\SkillCertificate[] $skillCertificates
 * @property-read int|null $skill_certificates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\User\Entities\WorkExperience[] $workExperiences
 * @property-read int|null $work_experiences_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereIsIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereUnionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\User whereWeappSessionKey($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'sex',
        'mobile',
        'avatar',
        'union_id',
        'open_id',
        'nickname',
        'verify_wechat',
        'api_token'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','open_id'
    ];

    protected $table = 'users';

    public function identity()
    {
        return $this->hasOne(Identity::class, 'user_id');
    }

    public function recruitmentInfo()
    {
        return $this->hasOne(RecruitmentInfo::class, 'user_id');
    }

    public function adeptLanguages()
    {
        return $this->hasMany(AdeptLanguage::class, 'user_id');
    }

    public function educationExperiences()
    {
        return $this->hasMany(EducationExperience::class, 'user_id');
    }

    public function skillCertificates()
    {
        return $this->hasMany(SkillCertificate::class, 'user_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'user_id');
    }
}

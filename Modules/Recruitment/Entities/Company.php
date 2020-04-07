<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

/**
 * Modules\Recruitment\Entities\Company
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property string|null $intro
 * @property int $is_identify 是否已认证
 * @property string|null $contacts 联系人
 * @property string|null $phone 联系电话
 * @property string|null $welfare_ids 公司福利
 * @property mixed|null $location 当前地理信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\CompanyImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Job[] $jobs
 * @property-read int|null $jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Welfare[] $welfare
 * @property-read int|null $welfare_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereContacts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereIsIdentify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Company whereWelfareIds($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_companies';

    public function images()
    {
        return $this->hasMany(CompanyImage::class, 'company_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'company_id');
    }

    public function welfare()
    {
        return $this->hasMany(Welfare::class, 'id', 'welfare_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }

}

<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Support\Facades\DB;

/**
 * Modules\Recruitment\Entities\Job
 *
 * @property int $id
 * @property int $company_id
 * @property string $title 标题
 * @property string|null $content 工作内容
 * @property int $price 价格 单位是分
 * @property string $unit 价格单位
 * @property int $area_id 工作地点区域
 * @property string|null $tag_ids 标签
 * @property string|null $welfare_ids 工作福利
 * @property string|null $job_type_ids 工作类型
 * @property string $work_circles 工作周期
 * @property int $sex_require 性别要求 0不限 1男2女
 * @property string $work_time 上班时间 逗号分隔 0不限
 * @property string|null $other_require 补充描述 选项:要求说明 每项用英文逗号隔开
 * @property mixed|null $location 地址信息
 * @property int $status 兼职状态 0正常 1下架
 * @property int $view_count 浏览次数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Recruitment\Entities\Area $area
 * @property-read \Modules\Recruitment\Entities\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\JobTag[] $tags
 * @property-read int|null $tags_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\JobType[] $type
 * @property-read int|null $type_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\Recruitment\Entities\Welfare[] $welfare
 * @property-read int|null $welfare_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereJobTypeIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereOtherRequire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereSexRequire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereTagIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereViewCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereWelfareIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereWorkCircles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereWorkTime($value)
 * @mixin \Eloquent
 * @property int $sort_score 综合排序分数
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Recruitment\Entities\Job whereSortScore($value)
 */
class Job extends Model
{
    protected $fillable = [];

    protected $table = 'recruitment_jobs';

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function tags()
    {
        return $this->hasMany(JobTag::class, 'id', 'tag_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }

    public function welfare()
    {
        return $this->hasMany(Welfare::class, 'id', 'welfare_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }

    public function type()
    {
        return $this->hasMany(JobType::class, 'id', 'job_type_ids', HasOneOrMany::SPECIAL_SELF_SEPARATE);
    }


}

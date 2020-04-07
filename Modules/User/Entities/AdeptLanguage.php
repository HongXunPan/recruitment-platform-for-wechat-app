<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\User\Entities\AdeptLanguage
 *
 * @property int $id
 * @property int $user_id
 * @property string $language
 * @property int $proficiency 熟练度
 * @property string $level 语言等级
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\User\Entities\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereProficiency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\User\Entities\AdeptLanguage whereUserId($value)
 * @mixin \Eloquent
 */
class AdeptLanguage extends Model
{
    protected $fillable = [];

    protected $table = 'user_adept_languages';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

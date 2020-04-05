<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class AdeptLanguage extends Model
{
    protected $fillable = [];

    protected $table = 'user_adept_languages';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}

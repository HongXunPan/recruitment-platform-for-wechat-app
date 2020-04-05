<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $fillable = [];

    protected $table = 'user_identity';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}

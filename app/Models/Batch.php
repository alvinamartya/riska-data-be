<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use SoftDeletes;

    protected $hidden = ["created_at", "created_by", "deleted_at", "deleted_by", "updated_at", "updated_by"];

    public function programs()
    {
        return $this->hasMany('App\Models\Program');
    }
}

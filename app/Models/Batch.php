<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use SoftDeletes;

    protected $hidden = [
        'created_at', 
        'created_by', 
        'deleted_at', 
        'deleted_by', 
        'updated_at', 
        'updated_by'
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function (Batch $batch) {
            if(!$batch->exists) $batch->created_by = auth()->user()->fullname;
            else $batch->updated_by = auth()->user()->fullname;
        });
    }

    public function programs()
    {
        return $this->hasMany('App\Models\Program');
    }
}

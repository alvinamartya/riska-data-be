<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
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
        static::saving(function (Department $department) {
            if(!$department->exists) $department->created_by = auth()->user()->fullname;
            else $department->updated_by = auth()->user()->fullname;
        });
        static::deleting(function (Department $department) {
            $department->deleted_by = auth()->user()->fullname;
        });
    }

    public function programs()
    {
        return $this->hasMany('App\Models\Program');
    }
}

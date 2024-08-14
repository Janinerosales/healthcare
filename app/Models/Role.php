<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }

    public function setRoleNameAttribute($value)
    {
        return $this->attributes['role_name'] = ucwords($value);
    }
}

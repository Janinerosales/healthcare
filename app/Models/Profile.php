<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Appointment;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function casts()
    {
        return [
            'full_name',
            'age'
        ];
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->attributes['first_name'] . ' ' . $this->attributes['last_name']);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->age;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecords::class);
    }
}

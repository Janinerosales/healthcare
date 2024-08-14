<?php

namespace App\Models;

use App\Models\Profile;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecords::class);
    }
}

<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Profile;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecords::class);
    }
}

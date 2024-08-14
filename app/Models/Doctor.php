<?php

namespace App\Models;

use App\Models\Prescription;
use App\Models\MedicalRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecords::class);
    }
}

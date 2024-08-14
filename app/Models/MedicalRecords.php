<?php

namespace App\Models;

use App\Models\Doctor;
use App\Models\Profile;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecords extends Model
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

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}

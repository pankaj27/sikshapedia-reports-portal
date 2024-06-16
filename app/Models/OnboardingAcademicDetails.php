<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardingAcademicDetails extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id','course_name'];
}

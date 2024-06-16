<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
    use HasFactory;
    
     protected $fillable = ['organization_name','contact_person_name','contact_person_mobile','organization_address','appointment_date','appointment_timing','remarks'];
}

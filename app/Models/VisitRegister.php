<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitRegister extends Model
{
    use HasFactory;
    
      protected $fillable = ['institution_name','contact_person_name','mobile_1','institution_address','city','state','district','pin','visit_date','appointment_time','special_note','visit_status'];
}

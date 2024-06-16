<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    
    protected $fillable = ['remarks','call_register_id','visit_status','follow_up_date'];
}

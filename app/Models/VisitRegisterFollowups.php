<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitRegisterFollowups extends Model
{
    use HasFactory;

    protected $fillable = ['remarks','visit_id','status','followup_date'];
}

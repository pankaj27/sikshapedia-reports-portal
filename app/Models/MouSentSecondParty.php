<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouSentSecondParty extends Model
{
    use HasFactory;
    protected $fillable = ['mou_id','name','designation','email_id','mobile_no'];
}

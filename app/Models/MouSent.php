<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouSent extends Model
{
    use HasFactory;

    protected $fillable = ['proposal_id','institute_id','party_name','address'];
}

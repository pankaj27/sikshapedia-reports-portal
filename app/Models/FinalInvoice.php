<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalInvoice extends Model
{
    use HasFactory;
    protected $fillable = ['mou_id'];
}

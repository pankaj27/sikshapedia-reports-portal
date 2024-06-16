<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    use HasFactory;
    protected $table = 'system_modules';

    protected $fillable = [
        'modules_name', 'modules_url','permission_name'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCost extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','product_cost_type','product_installment_number','instalment_duration',''];
}

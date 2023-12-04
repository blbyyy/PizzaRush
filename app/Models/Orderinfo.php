<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderinfo extends Model
{
    // use HasFactory;
    public $table = 'pizzaorderinfo';
    
    protected $guarded = ['id'];

    protected $fillable = ['customer_id','cut_type','ordered_date','price','discount','grand_price'];

}

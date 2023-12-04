<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    // use HasFactory;
    use HasFactory;

    public $table = 'pizzaorderline';
    
    protected $guarded = ['id'];

    protected $fillable = ['pizzaorderinfo_id','pizza_id','quantity'];
}

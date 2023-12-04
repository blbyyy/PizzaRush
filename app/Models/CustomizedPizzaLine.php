<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedPizzaLine extends Model
{
    use HasFactory;

    public $table = "customizedpizzainfo";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "customizedpizzainfo_id",
        "pizzatoppings_id",
    ];
}

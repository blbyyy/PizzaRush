<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaToppings extends Model
{
    use HasFactory;

    public $table = "pizzatoppings";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "name",
        "description",
        "fee",
        "img_path",
    ];
}

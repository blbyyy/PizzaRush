<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizedPizzaInfo extends Model
{
    use HasFactory;

    public $table = "customizedpizzainfo";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "customer_id",
        "pizzacrust_id",
        "ordered_date",
        "subtotal",
        "discount",
        "total",
    ];
}

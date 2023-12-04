<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaCrust extends Model
{
    use HasFactory;

    public $table = "pizzacrust";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "name",
        "description",
        "fee",
        "image",
    ];
}

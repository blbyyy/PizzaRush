<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = "employees";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "name",
        "gender",
        "phone",
        "address",
        "birthdate",
        "image",
        "user_id"
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}

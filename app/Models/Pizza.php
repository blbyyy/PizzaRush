<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    // use HasFactory;
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = ['name','description','fee','img_path'];
}

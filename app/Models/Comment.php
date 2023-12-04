<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $table = 'comments';

    public static $rules = [ 
            'guest_name' =>'required', 
            'pizza_id' =>'required',
            'comment'=>'required',
            'comment_date'=>'required'
        ];

    protected $fillable = ['guest_name','pizza_id','comment','comment_date'];
}

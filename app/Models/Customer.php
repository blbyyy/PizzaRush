<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Customer extends Model implements Searchable
{
    // use HasFactory;

    use HasFactory;

    public $table = "customers";
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
        "user_id"
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function getSearchResult(): SearchResult
    {
        $url = $this->id;
 
        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}

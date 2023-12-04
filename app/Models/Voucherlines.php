<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucherlines extends Model
{
    use HasFactory;

    public $table = "voucherlines";
    public $timestamps = false;
    public $primaryKey = "id";
    public $guarded = [
        "id"
    ];

    protected $fillable = [
        "customer_id",
        "voucher_id",
        "status",
    ];
}

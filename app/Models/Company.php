<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        "company_name",
        "city",
        "country",
        "pin_code",
        "address",
        "account_no",
        "bank_name",
        "swift_code",
        "ifsc",
        "bank_address",
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "type",
        "address",
        "bank_name",
        "bank_address",
        "account_no",
        "swift_no",
        "IBAN_no",
        "routing_no",
        "port_loading",
        "port_discharge",
        "country_origin",
        "incoterms",
        "HS_code",
        "state",
        "country",
        "ifsc"
    ];
}

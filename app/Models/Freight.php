<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freight extends Model
{
    use HasFactory;
    protected $fillable = [
        "invoice_id",
        "agent",
        "freight_invoice_no",
        "freight_amount_usd",
        "miscellaneous_invoice_no",
        "miscellaneous_expense",
        "insurance_amount",
        "bill_paid",
    ];
}

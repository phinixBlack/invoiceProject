<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInvoice extends Model
{
    use HasFactory;
    protected $fillable=[
        "invoice_id",
        "payment_bank_ref_no",
        "paid_amount",
        "receipt_bank_ref_no",
        "receipt_amount",
        "bank_charge",
    ];
}

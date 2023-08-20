<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePaymentTrack extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'invoice_id',
        'amount',
        'status_payment'
    ];
}

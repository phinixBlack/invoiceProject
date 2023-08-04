<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceContainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'invoice_id',
        'container_no',
        'seal_no'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'item_id',
        'port_loading_id',
        'bl_no',
        'buyer_id',
        'net_weight',
        'rate',
        'packs',
        'gross_weight',
        'HS_code',
        'invoice_date',
        'origin',
        'port_of_discharge',
        'BL_date',
        'bank_name',
        'seller_id',
        'incoterms',
        'trading_co',
        'buying_rate',
        'unit_measure',
        'container_no',
        'seal_no',
        'mark',
        'quality_certificate',
        'doc_credit_no',
        'doc_credit_no_date',
        'contract_no',
        'contract_no_date',
        'quality_certi_context',
        'freight_check',
        'bank_check'
        
    ];
}

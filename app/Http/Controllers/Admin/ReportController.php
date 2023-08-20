<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankInvoice;
use App\Models\Customer;
use App\Models\Freight;
use App\Models\Invoice;
use App\Models\Port;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function reportAjax()
    {
       
        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search = '';
        }

        if (isset($_GET['length'])) {
            $limit = $_GET['length'];
        } else {
            $limit = 25;
        }

        if (isset($_GET['start'])) {
            $ofset = $_GET['start'];
        } else {
            $ofset = 0;
        }

        $total = Invoice::get()->count();
        $invoices = Invoice::select('banks.name as bank', 'invoices.*', 'items.name', 'invoice_containers.container_no', 'invoice_containers.seal_no')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('invoice_containers', 'invoice_containers.invoice_id', '=', 'invoices.id')
            ->join('items', 'items.id', '=', 'invoices.item_id')
            ->join('banks', 'banks.id', '=', 'invoices.bank_name')
            ->offset($ofset)->limit($limit)->orderBy('invoices.id', 'DESC')->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($invoices as $invoice) {
            $freights = Freight::where('invoice_id', $invoice->id)->first();
            $value = 0;
            if(!empty($freights)){
                $value =$freights->freight_amount_usd + $freights->miscellaneous_expense;
            }
           
            $bankInvoice = BankInvoice::where('invoice_id', $invoice->id)->first();
            $buyers = Customer::select('name')->find($invoice->buyer_id);
            $seller = Customer::select('name')->find($invoice->seller_id);
            $port_loading = Port::select('name')->find($invoice->port_loading_id);
            $port_dispatch = Port::select('name')->find($invoice->port_of_discharge);
            $data[] = array(
                $i++,
                '1',
                $invoice->container_no . " / " . $invoice->seal_no,
                $invoice->name,
                $invoice->net_weight,
                $invoice->origin,
                $seller->name,
                $invoice->buying_rate,
                $invoice->invoice_id . " / " . date('Y-M-d', strtotime($invoice->created_at)),
                $invoice->import_bl_no . " / " . $invoice->import_bl_date,
                $invoice->trading_co,
                $port_loading->name,
                $port_dispatch->name,
                $buyers->name,
                $invoice->rate,
                $invoice->invoice_id,
                date('Y-M-d', strtotime($invoice->created_at)),
                $invoice->bl_no,
                $invoice->bl_date,
                $invoice->incoterms,
                $invoice->contract_no,
                $invoice->doc_credit_no,
                $invoice->mark,
                $invoice->bank,
                !empty($bankInvoice->payment_bank_ref_no) ? $bankInvoice->payment_bank_ref_no : "",
                !empty($bankInvoice->paid_amount)  ? $bankInvoice->paid_amount : "",
                !empty($bankInvoice->receipt_bank_ref_no)  ? $bankInvoice->receipt_bank_ref_no : "",
                !empty($bankInvoice->receipt_amount)  ? $bankInvoice->receipt_amount : "",
                !empty($bankInvoice->bank_charge)  ? $bankInvoice->bank_charge : "",
                !empty($freights->insurance_amount)  ? $freights->insurance_amount : "",
                $value !=0 ? $value    : "0",
                !empty($freights->bill_paid)   ? $freights->bill_paid : "",    /// not sure

            );
        }

        // dd($data);

        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function reportAjaxPrint()
    {   
        if (isset($_GET['search']['value'])) {
            $search = $_GET['search']['value'];
        } else {
            $search = '';
        }

        if (isset($_GET['length'])) {
            $limit = $_GET['length'];
        } else {
            $limit = 25;
        }

        if (isset($_GET['start'])) {
            $ofset = $_GET['start'];
        } else {
            $ofset = 0;
        }
        $end_date =$_GET['endDate'];
        $start_date = $_GET['startDate'];
        $total = Invoice::get()->count();
        $invoices = Invoice::select('banks.name as bank', 'invoices.*', 'items.name', 'invoice_containers.container_no', 'invoice_containers.seal_no')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('invoice_containers', 'invoice_containers.invoice_id', '=', 'invoices.id')
            ->join('items', 'items.id', '=', 'invoices.item_id')
            ->join('banks', 'banks.id', '=', 'invoices.bank_name')
            ->offset($ofset)->limit($limit)->orderBy('invoices.id', 'DESC')->whereBetween('invoices.created_at', [$start_date, $end_date])->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($invoices as $invoice) {
            $freights = Freight::where('invoice_id', $invoice->id)->first();
            $value = 0;
            if(!empty($freights)){
                $value =$freights->freight_amount_usd + $freights->miscellaneous_expense;
            }
            $bankInvoice = BankInvoice::where('invoice_id', $invoice->id)->first();
            $buyers = Customer::select('name')->find($invoice->buyer_id);
            $seller = Customer::select('name')->find($invoice->seller_id);
            $port_loading = Port::select('name')->find($invoice->port_loading_id);
            $port_dispatch = Port::select('name')->find($invoice->port_of_discharge);
            $data[] = array(
                $i++,
                '1',
                $invoice->container_no . " / " . $invoice->seal_no,
                $invoice->name,
                $invoice->net_weight,
                $invoice->origin,
                $seller->name,
                $invoice->buying_rate,
                $invoice->invoice_id . " / " . date('Y-M-d', strtotime($invoice->created_at)),
                $invoice->import_bl_no . " / " . $invoice->import_bl_date,
                $invoice->trading_co,
                $port_loading->name,
                $port_dispatch->name,
                $buyers->name,
                $invoice->rate,
                $invoice->invoice_id,
                date('Y-M-d', strtotime($invoice->created_at)),
                $invoice->bl_no,
                $invoice->bl_date,
                $invoice->incoterms,
                $invoice->contract_no,
                $invoice->doc_credit_no,
                $invoice->mark,
                $invoice->bank,
                !empty($bankInvoice->payment_bank_ref_no) ? $bankInvoice->payment_bank_ref_no : "",
                !empty($bankInvoice->paid_amount)  ? $bankInvoice->paid_amount : "",
                !empty($bankInvoice->receipt_bank_ref_no)  ? $bankInvoice->receipt_bank_ref_no : "",
                !empty($bankInvoice->receipt_amount)  ? $bankInvoice->receipt_amount : "",
                !empty($bankInvoice->bank_charge)  ? $bankInvoice->bank_charge : "",
                !empty($freights->insurance_amount)  ? $freights->insurance_amount : "",
                $value !=0 ? $value    : "0",
                !empty($freights->bill_paid)   ? $freights->bill_paid : "",    /// not sure

            );
        }

        // dd($data);

        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
}

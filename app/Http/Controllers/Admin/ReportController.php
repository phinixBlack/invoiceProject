<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankInvoice;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Freight;
use App\Models\Invoice;
use App\Models\InvoiceContainer;
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
        $invoices = Invoice::select('banks.name as bank', 'invoices.*', 'items.name')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('items', 'items.id', '=', 'invoices.item_id')
            ->join('banks', 'banks.id', '=', 'invoices.bank_name')
            ->offset($ofset)->limit($limit)->orderBy('invoices.id', 'DESC')->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($invoices as $invoice) {
            $freights = Freight::where('invoice_id', $invoice->id)->first();
            $value = 0;
            if (!empty($freights)) {
                $value = $freights->freight_amount_usd + $freights->miscellaneous_expense;
            }

            $bankInvoice = BankInvoice::where('invoice_id', $invoice->id)->first();
            $buyers = Customer::select('name')->find($invoice->buyer_id);
            $seller = Customer::select('name')->find($invoice->seller_id);
            $port_loading = Port::select('name')->find($invoice->port_loading_id);
            $port_dispatch = Port::select('name')->find($invoice->port_of_discharge);
            $company = Company::select('company_name')->find($invoice->trading_co);
            $countContainer = InvoiceContainer::select('container_no', 'seal_no')->whereinvoice_id($invoice->id)->get();
            $containerNumber = [];
            foreach ($countContainer as $key => $obj) {
                $containerNumber[$key] = $obj->container_no . " / " . $obj->seal_no . "<br>";
            }

            $data[] = array(
                $i++,
                count($countContainer),
                // $invoice->container_no . " / " . $invoice->seal_no,
                $containerNumber,
                $invoice->name,
                $invoice->net_weight,
                $invoice->origin,
                $seller->name,
                $invoice->buying_rate,
                !empty($freights->mbl_no) ? $freights->mbl_no : "",
                $invoice->import_inv_no . " / " . date('Y-M-d', strtotime($invoice->import_inv_date)),
                $invoice->import_bl_no . " / " . $invoice->import_bl_date,
                // $company->company_name,
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
                // $invoice->mark,
                $invoice->bank,
                !empty($bankInvoice->payment_bank_ref_no) ? $bankInvoice->payment_bank_ref_no : "",
                !empty($bankInvoice->paid_amount)  ? $bankInvoice->paid_amount : "",
                !empty($bankInvoice->receipt_bank_ref_no)  ? $bankInvoice->receipt_bank_ref_no : "",
                !empty($bankInvoice->receipt_amount)  ? $bankInvoice->receipt_amount : "",
                !empty($bankInvoice->bank_charge)  ? $bankInvoice->bank_charge : "",
                !empty($freights->insurance_amount)  ? $freights->insurance_amount : "",
                $value != 0 ? $value    : "0",
                // !empty($freights->bill_paid)   ? $freights->bill_paid : "",    /// not sure

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
        $end_date = $_GET['endDate'];
        $start_date = $_GET['startDate'];
        $total = Invoice::get()->count();
        $invoices = Invoice::select('banks.name as bank', 'invoices.*', 'items.name')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('items', 'items.id', '=', 'invoices.item_id')
            ->join('banks', 'banks.id', '=', 'invoices.bank_name')
            ->offset($ofset)->limit($limit)->orderBy('invoices.id', 'DESC')->whereBetween('invoices.created_at', [$start_date, $end_date])->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($invoices as $invoice) {
            $freights = Freight::where('invoice_id', $invoice->id)->first();
            $value = 0;
            if (!empty($freights)) {
                $value = $freights->freight_amount_usd + $freights->miscellaneous_expense;
            }

            $bankInvoice = BankInvoice::where('invoice_id', $invoice->id)->first();
            $buyers = Customer::select('name')->find($invoice->buyer_id);
            $seller = Customer::select('name')->find($invoice->seller_id);
            $port_loading = Port::select('name')->find($invoice->port_loading_id);
            $port_dispatch = Port::select('name')->find($invoice->port_of_discharge);
            $company = Company::select('company_name')->find($invoice->trading_co);
            $countContainer = InvoiceContainer::select('container_no', 'seal_no')->whereinvoice_id($invoice->id)->get();
            $containerNumber = [];
            foreach ($countContainer as $key => $obj) {
                $containerNumber[$key] = $obj->container_no . " / " . $obj->seal_no . "<br>";
            }

            $data[] = array(
                $i++,
                count($countContainer),
                // $invoice->container_no . " / " . $invoice->seal_no,
                $containerNumber,
                $invoice->name,
                $invoice->net_weight,
                $invoice->origin,
                $seller->name,
                $invoice->buying_rate,
                !empty($freights->mbl_no) ? $freights->mbl_no : "",
                $invoice->import_inv_no . " / " . date('Y-M-d', strtotime($invoice->import_inv_date)),
                $invoice->import_bl_no . " / " . $invoice->import_bl_date,
                // $company->company_name,
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
                // $invoice->mark,
                $invoice->bank,
                !empty($bankInvoice->payment_bank_ref_no) ? $bankInvoice->payment_bank_ref_no : "",
                !empty($bankInvoice->paid_amount)  ? $bankInvoice->paid_amount : "",
                !empty($bankInvoice->receipt_bank_ref_no)  ? $bankInvoice->receipt_bank_ref_no : "",
                !empty($bankInvoice->receipt_amount)  ? $bankInvoice->receipt_amount : "",
                !empty($bankInvoice->bank_charge)  ? $bankInvoice->bank_charge : "",
                !empty($freights->insurance_amount)  ? $freights->insurance_amount : "",
                $value != 0 ? $value    : "0",
                // !empty($freights->bill_paid)   ? $freights->bill_paid : "",    /// not sure

            );
        }

        // dd($data);

        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }


    public function reportAjaxPrintExcel(Request $request)
    {
        $dates = explode('?', $request->data);

        $fileName = 'tasks.csv';
        $tasks = Invoice::select('banks.name as bank', 'invoices.*', 'items.name')
            ->join('items', 'items.id', '=', 'invoices.item_id')
            ->join('banks', 'banks.id', '=', 'invoices.bank_name')
            ->orderBy('invoices.id', 'DESC');
        $tasks =   $tasks->whereBetween('invoices.created_at', [$dates[1], $dates[0]]);
        $tasks =   $tasks->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'No Of Container',
            'Container No / Seal No',
            'Item',
            'Quantity(Net weight)',
            'Origin',
            'Seller Name',
            'Buying Rate',
            'MBL No',
            'Import Inv No and Date',
            'Import BL No and Date',
            'Port Of Loading',
            'Port Of Discharge',
            'Buyer Name',
            'Selling Rate PMT',
            'Export Invoice No',
            'Export Invoice Date',
            'Export BL No.',
            'Export BL Date',
            'Incoterm',
            'Contract No',
            'LC No.',
            'Bank',
            'Import Payment Bank Ref No And Date',
            'Paid Amount',
            'Export Receipt Bank Ref No. And Date',
            'Receipt Amount',
            'Bank Charge ',
            'Insurance',
        );

        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $seller = Customer::select('name')->find($task->seller_id);
                $freights = Freight::where('invoice_id', $task->id)->first();
                $value = 0;
                if (!empty($freights)) {
                    $value = $freights->freight_amount_usd + $freights->miscellaneous_expense;
                }
                $bankInvoice = BankInvoice::where('invoice_id', $task->id)->first();
                $buyers = Customer::select('name')->find($task->buyer_id);
                $port_loading = Port::select('name')->find($task->port_loading_id);
                $port_dispatch = Port::select('name')->find($task->port_of_discharge);
                $company = Company::select('company_name')->find($task->trading_co);
                $countContainer = InvoiceContainer::select('container_no', 'seal_no')->whereinvoice_id($task->id)->get();
                $containerNumber = [];
                foreach ($countContainer as $key => $obj) {
                    $containerNumber[$key] = $obj->container_no . " / " . $obj->seal_no;
                }

                $row['No_Of_Container']  = count($containerNumber);
                $row['Container_No/Seal_No']    = implode(',', $containerNumber);
                $row['Item']    = $task->name;
                $row['Quantity']  = $task->net_weight;
                $row['Origin_Country']  = $task->origin;
                $row['Origin_Country']  = $task->origin;
                $row['Seller_Name'] = $seller->name;
                $row['Buying_Rate'] = $task->buying_rate;
                $row['Import_BL_No_and_Date'] = !empty($freights->mbl_no) ? $freights->mbl_no : "";
                $row['Buying_Invoice_No_and_Date'] = $task->import_inv_no . " / " . date('Y-M-d', strtotime($task->import_inv_date));
                $row['Import_BL_No_and_Date'] = $task->import_bl_no . " / " . $task->import_bl_date;
                // $row['Merchant_company'] = $company->trading_co;
                $row['Port_Of_Loading'] = $port_loading->company_name;
                $row['Port_Of_Discharge'] = $port_dispatch->name;
                $row['Buyer_Name'] =  $buyers->name;
                $row['Selling_Rate_PMT'] = $task->rate;
                $row['Selling_Invoice_No'] = $task->invoice_id;
                $row['Selling_Invoice_Date'] = date('Y-M-d', strtotime($task->created_at));
                $row['Export_BL_No'] = $task->bl_no;
                $row['Export_BL_Date'] = $task->bl_date;
                $row['Incoterm'] = $task->incoterms;
                $row['Contacts_No'] = $task->contract_no;
                $row['Documentary_Credit_No'] = $task->doc_credit_no;
                // $row['Remarks'] = $task->mark;
                $row['Bank'] = $task->bank;
                $row['Payment_Bank_Ref_No_And_Date'] = !empty($bankInvoice->payment_bank_ref_no) ? $bankInvoice->payment_bank_ref_no : "";
                $row['Paid_Amount'] = !empty($bankInvoice->paid_amount) ? $bankInvoice->paid_amount : "";
                $row['Receipt_Bank_Ref_No_And_Date'] = !empty($bankInvoice->receipt_bank_ref_no) ? $bankInvoice->receipt_bank_ref_no : "";
                $row['Receipt_Amount'] = !empty($bankInvoice->receipt_amount) ? $bankInvoice->receipt_amount : "";
                $row['Bank_Charge'] = !empty($bankInvoice->bank_charge) ? $bankInvoice->bank_charge : "";
                $row['Insurance'] = !empty($freights->insurance_amount) ? $freights->insurance_amount : "";
                $row['Freight'] = $value != 0 ? $value : "0";
                // $row['Profile_Margin'] = !empty($freights->bill_paid) ? $freights->bill_paid : "";

                fputcsv($file, array(
                    $row['No_Of_Container'], $row['Container_No/Seal_No'], $row['Item'], $row['Quantity'], $row['Origin_Country'], $row['Seller_Name'],  $row['Buying_Rate'],
                    $row['Buying_Invoice_No_and_Date'],
                    $row['Import_BL_No_and_Date'],
                    // $row['Merchant_company'],
                    $row['Port_Of_Loading'],
                    $row['Port_Of_Discharge'],
                    $row['Buyer_Name'],
                    $row['Selling_Rate_PMT'],
                    $row['Selling_Invoice_No'],
                    $row['Selling_Invoice_Date'],
                    $row['Export_BL_No'],
                    $row['Export_BL_Date'],
                    $row['Incoterm'],
                    $row['Contacts_No'],
                    $row['Documentary_Credit_No'],
                    // $row['Remarks'],
                    $row['Bank'],
                    $row['Payment_Bank_Ref_No_And_Date'],
                    $row['Paid_Amount'],
                    $row['Receipt_Bank_Ref_No_And_Date'],
                    $row['Receipt_Amount'],
                    $row['Bank_Charge'],
                    $row['Insurance'],
                    $row['Freight'],
                    // $row['Profile_Margin'],
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function reportAjaxPrintExcelSecond(Request $request)
    {
        $dates = explode('?', $request->data);

        $fileName = 'tasks.csv';
        $tasks = Invoice::select('banks.name as bank', 'invoices.*', 'items.name')
            ->join('items', 'items.id', '=', 'invoices.item_id')
            ->join('banks', 'banks.id', '=', 'invoices.bank_name')
            ->orderBy('invoices.id', 'DESC');
        $tasks =   $tasks->whereBetween('invoices.created_at', [$dates[1], $dates[0]]);
        $tasks =   $tasks->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array(
            'INV NO',
            'Sale Amount',
            'Purchase Amount',
            'Insurance',
            'Freight',
            'Margin'
        );

        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($tasks as $task) {
                $freights = Freight::where('invoice_id', $task->id)->first();
                $value = 0;
                if (!empty($freights)) {
                    $value = $freights->freight_amount_usd + $freights->miscellaneous_expense;
                }
                $row['Sale_amount'] = number_format($task->net_weight * $task->rate, 3);
                $row['Insurance'] = !empty($freights->insurance_amount) ? $freights->insurance_amount : "";
                $row['Freight'] = $value != 0 ? $value : "0";
                $row['INV_NO'] = $task->invoice_id;
                $row['Purcase_Amount'] =  number_format($task->net_weight * $task->buying_rate, 3);
                $row['Profile_Margin'] = number_format(($task->net_weight * $task->rate) - ($task->net_weight * $task->buying_rate) - $row['Freight'] -  $row['Insurance'], 3);
                fputcsv($file, array(
                    $row['INV_NO'],
                    $row['Sale_amount'],
                    $row['Purcase_Amount'],
                    $row['Insurance'],
                    $row['Freight'],
                    $row['Profile_Margin'],
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

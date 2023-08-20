<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceContainer;
use App\Models\InvoiceDoc;
use App\Models\InvoicePaymentTrack;
use App\Models\Item;
use App\Models\Port;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    //
    public function invoiceAjax(Request $request)
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
        $invoices = Invoice::select('invoices.*', 'items.name')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('items', 'items.id', '=', 'invoices.item_id')
            ->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($invoices as $invoice) {
            $buyers = Customer::select('name')->find($invoice->buyer_id);
            $seller = Customer::select('name')->find($invoice->seller_id);
            $port_loading = Port::select('name')->find($invoice->port_loading_id);
            $port_dispatch = Port::select('name')->find($invoice->port_of_discharge);
            $paymentStatus = "PAID";
            if ($invoice->status_payment != "paid") {
                $transaction = InvoicePaymentTrack::whereInvoice_id($invoice->id)->sum('amount');
                $amount = ($invoice->packs * $invoice->rate) - $transaction;
                $paymentStatus = '<button class="btn btn-primary btn-sm w-100 " id="paidStatus" data-total="' . $invoice->packs * $invoice->rate . '" data-amount="' . $amount . '" data-id="' . $invoice->id . '">Paid Status</button>';
            }
            $data[] = array(
                $i++,
                $invoice->invoice_id,
                $invoice->name,
                $buyers->name,
                $seller->name,
                $invoice->hs_code,
                $invoice->origin,
                $port_loading->name,
                $port_dispatch->name,
                date('Y-M-d', strtotime($invoice->created_at)),
                ' <a href="' . url('/invoice/print/' . base64_encode($invoice->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Print</a>',
                ' <a href="' . url('/invoice/print/commercial/' . base64_encode($invoice->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Commercial</a>',
                ' <a href="' . url('/invoice/edit/' . base64_encode($invoice->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Edit</a>',
                $paymentStatus,
            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] = $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function create()
    {
        $item = Item::where(['status' => 'active', 'soft_delete' => 'true'])->get();
        $ports = Port::where('status', 'active')->get();
        $customer = Customer::where(['status' => 'active', 'soft_delete' => 'true'])->get();
        $bank = Bank::where(['status' => 'active', 'soft_delete' => 'true'])->get();
        $company = Company::get();
        return view('page.invoice.index', compact('item', 'ports', 'customer', 'bank', 'company'));
    }

    public function createStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // "invoice_id" => 'required',
                "item_id" => 'required',
                "port_loading_id" => 'required',
                "bl_no" => 'required',
                "bl_date" => 'required',
                "buyer_id" => 'required',
                "net_weight" => 'required',
                "rate" => 'required',
                "packs" => 'required',
                "unit_measure" => 'required',
                "gross_weight" => 'required',
                "hs_code" => 'required',
                //  "invoice_date" => 'required',
                "origin" => 'required',
                "port_of_discharge" => 'required',
                "bank_name" => 'required',
                "incoterms" => 'required',
                "seller_id" => 'required',
                "trading_co" => 'required',
                "buying_rate" => 'required',
                "import_inv_no" => 'required',
                "import_inv_date" => 'required',
                "import_bl_no" => 'required',
                "import_bl_date" => 'required',
                "mark" => 'required',
                "quality_certificate" => 'required',
                "doc_credit_no" => 'required',
                "doc_credit_no_date" => 'required',
                "contract_no" => 'required',
                "contract_no_date" => 'required',
                "quality_certi_context" => 'required',
                "freight" => 'required',
                "vessel_name" => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $latest = Invoice::latest()->first();
            try {
                DB::beginTransaction();
                //    $request['invoice_id'] =  Str::random(10) . "_" . $latest === null ? '1' : $latest->id;
                $request['invoice_id'] = "MD-" . Str::random(10);
                $request['invoice_date'] = date('Y-m-d');
                if (!empty($request->container_no) || $request->seal_no) {
                    $invoice = Invoice::create($request->except('container_no', 'seal_no'));
                    foreach ($request->container_no as $key => $obj) {
                        if (!empty($obj) || !empty($request->seal_no[$key])) {
                            $invoiceContainer = InvoiceContainer::create(['invoice_id' => $invoice->id, 'container_no' => $obj, 'seal_no' => $request->seal_no[$key]]);
                        } else {
                            DB::rollBack();
                            return response()->json(['status' => true, 'msg' => 'Container imputs are empty']);
                        }
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['status' => true, 'msg' => 'Container imputs are empty']);
                }
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Save successfully']);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'msg' => "Something went wrong"]);
                DB::rollBack();
            }
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => 'something went wrong']);
        }
    }

    public function edit($id)
    {
        $invoice = Invoice::find(base64_decode($id));
        $invoice['container'] = InvoiceContainer::whereinvoice_id(base64_decode($id))->get();
        $invoice['file'] = InvoiceDoc::whereinvoice_id(base64_decode($id))->get();
        $item = Item::where(['status' => 'active', 'soft_delete' => 'true'])->get();
        $ports = Port::where('status', 'active')->get();
        $customer = Customer::where(['status' => 'active', 'soft_delete' => 'true'])->get();
        $bank = Bank::where(['status' => 'active', 'soft_delete' => 'true'])->get();
        $company = Company::get();
        return view('page.invoice.edit', compact('item', 'ports', 'customer', 'bank', 'company', 'invoice'));
    }

    public function print($id)
    {
        $invoice = Invoice::select('invoices.*', 'items.name', 'invoice_containers.container_no', 'invoice_containers.seal_no')->join('items', 'items.id', '=', 'invoices.item_id')->join('invoice_containers', 'invoice_containers.invoice_id', '=', 'invoices.id')->where('invoices.id', base64_decode($id))->first();
        $buyers = Customer::select('name', 'address')->find($invoice->buyer_id);
        $seller = Customer::select('name')->find($invoice->seller_id);
        $port_loading = Port::select('name')->find($invoice->port_loading_id);
        $port_discharge = Port::select('name')->find($invoice->port_of_discharge);
        $invoice['buyer_name'] = $buyers->name;
        $invoice['address'] = $buyers->address;
        $invoice['port_loading'] = $port_loading->name;
        $invoice['port_discharge'] = $port_discharge->name;
        $pdf = Pdf::loadView('page.invoice.print', ['invoice' => $invoice]);
        return $pdf->download('invoice.pdf');
    }
    public function printCommercial($id)
    {
        $invoice = Invoice::select('invoices.*', 'items.name', 'invoice_containers.container_no', 'invoice_containers.seal_no')->join('items', 'items.id', '=', 'invoices.item_id')->join('invoice_containers', 'invoice_containers.invoice_id', '=', 'invoices.id')->where('invoices.id', base64_decode($id))->first();
        $buyers = Customer::select('name', 'address')->find($invoice->buyer_id);
        $seller = Customer::select('name')->find($invoice->seller_id);
        $port_loading = Port::select('name')->find($invoice->port_loading_id);
        $port_discharge = Port::select('name')->find($invoice->port_of_discharge);
        $company = Company::where('id', $invoice->trading_co)->first();
        $invoice['buyer_name'] = $buyers->name;
        $invoice['address'] = $buyers->address;
        $invoice['trading_address'] = $company->address;
        $invoice['bank_name'] = $company->bank_name;
        $invoice['bank_address'] = $company->bank_address;
        $invoice['company_name'] = $company->company_name;
        $invoice['swift_code'] = $company->swift_code;
        $invoice['account_no'] = $company->account_no;
         $invoice['port_loading'] = $port_loading->name;
        $invoice['port_discharge'] = $port_discharge->name;
        $pdf = Pdf::loadView('page.invoice.commercial', ['invoice' => $invoice]);
        return $pdf->download('invoiceCommercial.pdf');
    }

    public function editStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // "invoice_id" => 'required',
                "item_id" => 'required',
                "port_loading_id" => 'required',
                "bl_no" => 'required',
                "bl_date" => 'required',
                "buyer_id" => 'required',
                "net_weight" => 'required',
                "rate" => 'required',
                "packs" => 'required',
                "unit_measure" => 'required',
                "gross_weight" => 'required',
                "hs_code" => 'required',
                //  "invoice_date" => 'required',
                "origin" => 'required',
                "port_of_discharge" => 'required',
                "bank_name" => 'required',
                "incoterms" => 'required',
                "seller_id" => 'required',
                "trading_co" => 'required',
                "buying_rate" => 'required',
                "import_inv_no" => 'required',
                "import_inv_date" => 'required',
                "import_bl_no" => 'required',
                "import_bl_date" => 'required',
                "mark" => 'required',
                "quality_certificate" => 'required',
                "doc_credit_no" => 'required',
                "doc_credit_no_date" => 'required',
                "contract_no" => 'required',
                "contract_no_date" => 'required',
                "quality_certi_context" => 'required',
                "id" => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $latest = Invoice::latest()->first();
            try {
                DB::beginTransaction();
                $request['invoice_id'] = Str::random(10) . "_" . $latest === null ? '1' : $latest->id;
                $request['invoice_id'] = "MD-" . Str::random(10);
                $request['invoice_date'] = date('Y-m-d');
                $invoice = Invoice::where('id', $request->id)->update($request->except('container_no', 'seal_no', 'id', '_token', 'files'));
                if (isset($request->container_no) || isset($request->seal_no)) {
                    InvoiceContainer::where('invoice_id', $request->id)->delete();
                    foreach ($request->container_no as $key => $obj) {
                        if (!empty($obj) || !empty($request->seal_no[$key])) {
                            $invoiceContainer = InvoiceContainer::create(['invoice_id' => $request->id, 'container_no' => $obj, 'seal_no' => $request->seal_no[$key]]);
                        } else {
                            DB::rollBack();
                            return response()->json(['status' => false, 'msg' => 'Container imputs are empty']);
                        }
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['status' => false, 'msg' => 'need to add one continer']);
                }
                if (!empty($request->file('files'))) {
                    foreach ($request->file('files') as $key => $file) {
                        $fileName = time() . rand(1, 99) . '.' . $file->extension();
                        $file->move(public_path('uploads'), $fileName);
                        $files[]['name'] = $fileName;
                    }
                    foreach ($files as $key => $obj) {
                        $invoiceContainer = InvoiceDoc::create(['invoice_id' => $request->id, 'path' => $obj['name'],]);
                    }
                }
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Save successfully']);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'msg' => "Something went wrong"]);
                DB::rollBack();
            }
        } catch (Exception $e) {

            return response()->json(['status' => false, 'msg' => 'something went wrong']);
        }
    }

    public function invoiceStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'payment_type' => 'required',
                'total' => 'required',
                'left' => 'required', 'amount' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $attempt = 1;
            $status = $request->payment_type;
            $invoiceCheck = Invoice::select('partial_payment_attempt')->whereId($request->id)->first();
            $request->total == $request->amount ? $status = "paid" : "";
            if ($request->total < $request->amount) {
                return response()->json(['status' => false, 'msg' => "Amount is more"]);
            }
            if ($invoiceCheck->partial_payment_attempt > 0) {
                if ($request->left != $request->amount) {
                    return response()->json(['status' => false, 'msg' => "Check the amount"]);
                }
                $attempt = 2;
                $status = 'paid';
            }
            DB::beginTransaction();
            $invoiceTransation  = InvoicePaymentTrack::create(['invoice_id' => $request->id, 'amount' => $request->amount, 'status_payment' => $request->payment_type]);
            $invoiceCheck = Invoice::whereId($request->id)->update(['partial_payment_attempt' => $attempt, 'status_payment' => $status]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => 'something went wrong']);
        }
    }
}

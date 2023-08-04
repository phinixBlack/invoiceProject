<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceContainer;
use App\Models\Item;
use App\Models\Port;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
             //    ' <a href="' . url('/invoice/edit/' . base64_encode($invoice->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Edit</a>',
             
            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
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
        return view('page.invoice.index', compact('item', 'ports', 'customer', 'bank','company'));
    }

    public function createStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // "item_id" => 'required',
                "port_loading_id" => 'required',
                "bl_no" => 'required',
                "buyer_id" => 'required',
                "net_weight" => 'required',
                "rate" => 'required',
                "packs" => 'required',
                "gross_weight" => 'required',
                "HS_code" => 'required',
                //  "invoice_date" => 'required',
                "origin" => 'required',
                "port_of_discharge" => 'required',
                "BL_date" => 'required',
                "bank_name" => 'required',
                "seller_id" => 'required',
                "incoterms" => 'required',
                "trading_co" => 'required',
                "buying_rate" => 'required',
                "unit_measure" => 'required',
                "container_no" => 'required',
                "seal_no"  => 'required',
                "mark" => 'required',
                "quality_certificate" => "required",
                "doc_credit_no" => 'required',
                "doc_credit_no_date" => 'required',
                "contract_no" => 'required',
                "contract_no_date" => 'required',
                "quality_certi_context" => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $latest = Invoice::latest()->first();
            try {
                DB::beginTransaction();
                //    $request['invoice_id'] =  Str::random(10) . "_" . $latest === null ? '1' : $latest->id;
                $request['invoice_id'] =  "MD-".Str::random(10);
                $request['invoice_date'] = date('Y-m-d');
                $invoice = Invoice::create($request->except('container_no', 'seal_no'));
                foreach ($request->container_no as $key => $obj) {
                    if (!empty($obj) || !empty($request->seal_no[$key])) {
                        $invoiceContainer = InvoiceContainer::create(['invoice_id' => $invoice->id, 'container_no' => $obj, 'seal_no' => $request->container_no[$key]]);
                    } else {
                        DB::rollBack();
                        return response()->json(['status' => true, 'msg' => 'Container imputs are empty']);
                    }
                }
                DB::commit();
                return response()->json(['status' => true, 'msg' => 'Save successfully']);
            } catch (Exception $e) {
                return response()->json(['status' => false, 'msg' => $e->getMessage()]);
                DB::rollBack();
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return response()->json(['status' => false, 'msg' => 'something went wrong']);
        }
    }

    // public function edit($id){
    //     $invoice = Invoice::find( base64_decode($id));
    //     dd($invoice);
    // }
}

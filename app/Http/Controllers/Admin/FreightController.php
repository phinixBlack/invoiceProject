<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Freight;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FreightController extends Controller
{
    //
    public function freightAjax(Request $request)
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

        $total = Freight::get()->count();
        $freight = Freight::select('freights.*', 'invoices.invoice_id as invoice_name')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('invoices', 'invoices.id', '=', 'freights.invoice_id')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($freight as $item) {
            $status = '<button type="button" class="btn ' . ($item->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-100 statusChange" data-id="' . $item->id . '" data-status="' . ($item->status === 'active' ? 'inactive' : 'active') . '">' . $item->status . '</button>';

            $data[] = array(
                $i++,
                $item->invoice_name,
                $item->agent,
                $item->freight_invoice_no,
                $item->freight_amount_usd . " USD",
                $item->miscellaneous_invoice_no,
                $item->miscellaneous_expense,
                $item->insurance_amount,
                $item->bill_paid,
                ' <a href="' . url('/freight/edit/' . base64_encode($item->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Edit</a>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] = $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function create()
    {
        $invoice = Invoice::select('id', 'invoice_id')->where(['freight_check' => "false"])->get();
        return view('page.freight.index', compact('invoice'));
    }

    public function createStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "invoice_id" => 'required',
                "agent" => 'required',
                "freight_invoice_no" => 'required',
                "freight_amount_usd" => 'required',
                "miscellaneous_invoice_no" => 'required',
                "miscellaneous_expense" => 'required',
                "insurance_amount" => 'required',
                "bill_paid" => 'required',
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $freight = Freight::create($request->all());
            $invoice = Invoice::where('id', $request->invoice_id)->update(['freight_check' => true]);
            DB::commit();
            return response()->json(['status' => true, 'msg' => "Freight add successfully"]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function edit($id)
    {
        $freight = Freight::select('freights.*', 'invoices.invoice_id as invoice_name')
            ->join('invoices', 'invoices.id', '=', 'freights.invoice_id')
            ->find(base64_decode($id));
        return view('page.freight.edit', compact( 'freight'));
    }
    public function editStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "invoice_id" => 'required',
                "agent" => 'required',
                "freight_invoice_no" => 'required',
                "freight_amount_usd" => 'required',
                "miscellaneous_invoice_no" => 'required',
                "miscellaneous_expense" => 'required',
                "insurance_amount" => 'required',
                "bill_paid" => 'required',
                "id" => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $freight = Freight::where('id', $request['id'])->update($request->except('id', '_token'));
            return response()->json(['status' => true, 'msg' => "Freight add successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
}

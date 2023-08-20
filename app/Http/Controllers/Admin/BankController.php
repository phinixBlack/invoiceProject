<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BankInvoice;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    //
    public function bankAjax(Request $request)
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

        $total = BankInvoice::get()->count();
        $freight = BankInvoice::select('bank_invoices.*', 'invoices.invoice_id as invoice_name')->orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->join('invoices', 'invoices.id', '=', 'bank_invoices.invoice_id')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($freight as $item) {
            $status = '<button type="button" class="btn ' . ($item->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-100 statusChange" data-id="' . $item->id . '" data-status="' . ($item->status === 'active' ? 'inactive' : 'active') . '">' . $item->status . '</button>';

            $data[] = array(
                $i++,
                $item->invoice_name,
                $item->payment_bank_ref_no,
                $item->paid_amount,
                $item->receipt_bank_ref_no,
                $item->receipt_amount,
                $item->bank_charge,
                ' <a href="' . url('/banking/edit/' . base64_encode($item->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Edit</a>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function create()
    {
        $invoice = Invoice::select('id', 'invoice_id')->where(['bank_check' => "false"])->get();
        return view('page.bank.index', compact('invoice'));
    }

    public function createStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "invoice_id" => 'required',
                "payment_bank_ref_no" => 'required',
                "paid_amount" => 'required',
                "receipt_bank_ref_no" => 'required',
                "receipt_amount" => 'required',
                "bank_charge" => 'required',

            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            DB::beginTransaction();
            $freight = BankInvoice::create($request->all());
            $invoice = Invoice::where('id', $request->invoice_id)->update(['bank_check' => true]);
            DB::commit();
            return response()->json(['status' => true, 'msg' => "Freight add successfully"]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function edit($id)
    {
        $bankInvoice = BankInvoice::select('bank_invoices.*', 'invoices.invoice_id as invoice_name')
            ->join('invoices', 'invoices.id', '=', 'bank_invoices.invoice_id')
            ->find(base64_decode($id));
        return view('page.bank.edit', compact('bankInvoice'));
    }
    public function editStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "invoice_id" => 'required',
                "payment_bank_ref_no" => 'required',
                "paid_amount" => 'required',
                "receipt_bank_ref_no" => 'required',
                "receipt_amount" => 'required',
                "bank_charge" => 'required',
                "id" => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $freight = BankInvoice::where('id', $request['id'])->update($request->except('id', '_token'));
            return response()->json(['status' => true, 'msg' => "Bank Invoice add successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
}

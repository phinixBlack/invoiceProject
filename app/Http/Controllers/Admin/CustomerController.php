<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function customerAjax(Request $request)
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

        $total = Customer::get()->count();
        $items = Customer::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->where('soft_delete','true')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();

        $i = 1 + $ofset;
        $data = [];
        foreach ($items as $item) {
            $status = '<button type="button" class="btn ' . ($item->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-100 statusChange" data-id="' . $item->id . '" data-status="' . ($item->status === 'active' ? 'inactive' : 'active') . '">' . $item->status . '</button>';

            $data[] = array(
                $i++,
                $item->name,
                $item->address ." ". $item->state ." ". $item->country,
                $item->type,
                $item->bank_name,
                $item->HS_code,
                $item->country_origin,
                $status,
                ' <a href="' . url('/customer/edit/' . base64_encode($item->id)) . '" class="btn btn-primary btn-sm w-100 edit_catories1" >Edit</a>',
                '  <button href="#" class="btn btn-danger btn-sm w-100  delteCustomer" data-id = "' . $item->id . '" >Delete</button>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
    public function statusEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'id' => 'required|exists:customers,id'
        ]);
        if ($validator->fails()) {

            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
        $customerStore =  Customer::where('id', $request->id)->update(['status' => $request->status]);
        return response()->json(['status' => true, 'msg' => "customer status change successfully"]);
    }

    public function deleteCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:customers,id'
        ]);
        if ($validator->fails()) {

            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }
       // $customerStore =  Customer::where('id', $request->id)->delete();
       $customerStore =  Customer::where('id', $request->id)->update(['soft_delete'=>'false']);
        return response()->json(['status' => true, 'msg' => "customer delete"]);
    }


    public function create()
    {
        return view('page.customer.index');
    }

    public function createStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => 'required',
                "type" => 'required',
                "address" => 'required',
                "country" => 'required',
                "state" => 'required',
                // "bank_name" => 'required',
                // "bank_address" => 'required',
                // "account_no" => 'required',
                // "swift_no" => 'required',
                // "IBAN_no" => 'required',
                // "routing_no" => 'required',
                // "port_of_loading" => 'required',
                // "port_of_discharge" => 'required',
                // "country_origin" => 'required',
                // "incoterms" => 'required',
                // "HS_code" => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $customer = Customer::create($request->except('_token'));
            return response()->json(['status' => true, 'msg' => 'customer created']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Something went wrong']);
        }
    }

    public function edit($id)
    {
        $customerId = base64_decode($id);
        $customer = Customer::find($customerId);
        return view('page.customer.edit', compact('customer'));
    }

    public function editStore(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => 'required',
                "type" => 'required',
                "address" => 'required',
                "country" => 'required',
                "state" => 'required',
                // "bank_name" => 'required',
                // "bank_address" => 'required',
                // "account_no" => 'required',
                // "swift_no" => 'required',
                // "IBAN_no" => 'required',
                // "routing_no" => 'required',
                // "port_of_loading" => 'required',
                // "port_of_discharge" => 'required',
                // "country_origin" => 'required',
                // "incoterms" => 'required',
                // "HS_code" => 'required',
                "customer_id" => 'required|exists:customers,id'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
               $request['port_loading'] = $request->port_of_loading;
               $request['port_discharge'] = $request->port_of_discharge;
              $customer = Customer::where('id', $request->customer_id)->update($request->except('_token','customer_id','port_of_loading','port_of_discharge'));
            return response()->json(['status' => true, 'msg' => "Customer Detail is edited"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => 'Something went wrong']);
        }
    }

    public function customerAjaxDashboard(Request $request)
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

        $total = Customer::get()->count();
        $items = Customer::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->where('soft_delete','true')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();

        $i = 1 + $ofset;
        $data = [];
        foreach ($items as $item) {
            $status = '<button type="button" class="btn ' . ($item->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-100 statusChange" data-id="' . $item->id . '" data-status="' . ($item->status === 'active' ? 'inactive' : 'active') . '">' . $item->status . '</button>';

            $data[] = array(
                $i++,
                $item->name,
                $item->address ." ". $item->state ." ". $item->country,
                $item->type,
                $item->bank_name,
                $item->HS_code,
                $item->country_origin,
                $item->status,
               
            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }
}

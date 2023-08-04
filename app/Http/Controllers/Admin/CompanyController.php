<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    //
    public function companyAjax(Request $request)
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

        $total = Company::get()->count();
        $freight = Company::orWhere(function ($query) use ($search) {
            // $query->orWhere('name', 'like', '%' . $search . '%');
        })->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();
        $i = 1 + $ofset;
        $data = [];
        foreach ($freight as $item) {
          //  $status = '<button type="button" class="btn ' . ($item->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-100 statusChange" data-id="' . $item->id . '" data-status="' . ($item->status === 'active' ? 'inactive' : 'active') . '">' . $item->status . '</button>';

            $data[] = array(
                $i++,
                $item->company_name,
                $item->address,
                $item->city,
                $item->country,
                $item->bank_name,
                $item->account_no,
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
        return view('page.company.index');
    }
    public function createStore(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                "company_name" => 'required',
                // "city" => 'required',
                // "country" => 'required',
                // "pin_code" => 'required',
                // "address" => 'required',
                // "account_no" => 'required',
                // "bank_name" => 'required',
                // "swift_code" => 'required',
                // "ifsc" => 'required',
                // "bank_address" => 'required',
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            // DB::beginTransaction();
            $company = Company::create($request->all());
            //  DB::commit();
            return response()->json(['status' => true, 'msg' => "Company add successfully"]);
        } catch (Exception $e) {
            // DB::rollBack();
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
}

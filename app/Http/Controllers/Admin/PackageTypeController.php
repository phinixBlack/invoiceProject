<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PackageType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class PackageTypeController extends Controller
{
    //
    public function packageTypeAjax (Request $request)
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

        $total = PackageType::get()->count();
        $PackageTypes = PackageType::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->where('soft_delete', 'true')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();

        $i = 1 + $ofset;
        $data = [];
        foreach ($PackageTypes as $PackageType) {
            $status = '<button type="button" class="btn ' . ($PackageType->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-50 statusChange" data-id="' . $PackageType->id . '" data-status="' . ($PackageType->status === 'active' ? 'inactive' : 'active') . '">' . $PackageType->status . '</button>';

            $data[] = array(
                $i++,
                $PackageType->name,
                $status,
                ' <button href="#" class="btn btn-primary btn-sm w-50 editPackageType" data-id = "' . $PackageType->id . '" data-name = "' . $PackageType->name . '">Edit</dutton>',
                '  <button href="#" class="btn btn-danger btn-sm w-50  deltePackageType" data-id = "' . $PackageType->id . '" >Delete</button>',

            );
        }
        $records['recordsTotal'] = $total;
        $records['recordsFiltered'] =  $total;
        $records['data'] = $data;
        echo json_encode($records);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $PackageTypeStore = PackageType::create(['name' => $request->name]);
            return response()->json(['status' => true, 'msg' => "Package Type add successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function statusEdit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
                'id' => 'required|exists:package_types,id'
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $PackageTypeStore =  PackageType::where('id', $request->id)->update(['status' => $request->status]);
            return response()->json(['status' => true, 'msg' => "Package Type status change successfully"]);
        } catch (Exception $e) {
            dd($e);
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
    public function deletePackageType(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:package_types,id'
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            //$PackageTypeStore =  PackageType::where('id', $request->id)->delete();
            $PackageTypeStore =  PackageType::where('id', $request->id)->update(['soft_delete' => 'false']);
            return response()->json(['status' => true, 'msg' => "Package Type delete successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function PackageTypeEdit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'id' => 'required|exists:package_types,id'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $PackageTypeStore =  PackageType::where('id', $request->id)->update(['name' => $request->name]);
            return response()->json(['status' => true, 'msg' => "Package Type Edit  successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
}

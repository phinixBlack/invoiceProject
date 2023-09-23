<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Port;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PortController extends Controller
{
   public function portAjax(Request $request)
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

        $total = Port::get()->count();
        $ports = Port::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->where('soft_delete', 'true')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();

        $i = 1 + $ofset;
        $data = [];
        foreach ($ports as $port) {
            $status = '<button type="button" class="btn ' . ($port->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-50 statusChange" data-id="' . $port->id . '" data-status="' . ($port->status === 'active' ? 'inactive' : 'active') . '">' . $port->status . '</button>';

            $data[] = array(
                $i++,
                $port->name,
                $status,
                ' <button href="#" class="btn btn-primary btn-sm w-50 editport" data-id = "' . $port->id . '" data-name = "' . $port->name . '">Edit</dutton>',
                '  <button href="#" class="btn btn-danger btn-sm w-50  delteport" data-id = "' . $port->id . '" >Delete</button>',

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
            $portStore = port::create(['name' => $request->name]);
            return response()->json(['status' => true, 'msg' => "port add successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function statusEdit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
                'id' => 'required|exists:ports,id'
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $portStore =  port::where('id', $request->id)->update(['status' => $request->status]);
            return response()->json(['status' => true, 'msg' => "port status change successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
    public function deleteport(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:ports,id'
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            //$portStore =  port::where('id', $request->id)->delete();
            $portStore =  port::where('id', $request->id)->update(['soft_delete' => 'false']);
            return response()->json(['status' => true, 'msg' => "port delete successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function portEdit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'id' => 'required|exists:ports,id'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $portStore =  port::where('id', $request->id)->update(['name' => $request->name]);
            return response()->json(['status' => true, 'msg' => "port Edit  successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
}

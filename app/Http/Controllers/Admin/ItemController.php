<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    //
    public function itemAjax(Request $request)
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

        $total = Item::get()->count();
        $items = Item::orWhere(function ($query) use ($search) {
            $query->orWhere('name', 'like', '%' . $search . '%');
        })->where('soft_delete', 'true')->offset($ofset)->limit($limit)->orderBy('id', 'DESC')->get();

        $i = 1 + $ofset;
        $data = [];
        foreach ($items as $item) {
            $status = '<button type="button" class="btn ' . ($item->status == "active" ? "btn-success" : " btn-danger") . ' btn-sm w-50 statusChange" data-id="' . $item->id . '" data-status="' . ($item->status === 'active' ? 'inactive' : 'active') . '">' . $item->status . '</button>';

            $data[] = array(
                $i++,
                $item->name,
                $status,
                ' <button href="#" class="btn btn-primary btn-sm w-50 editItem" data-id = "' . $item->id . '" data-name = "' . $item->name . '">Edit</dutton>',
                '  <button href="#" class="btn btn-danger btn-sm w-50  delteItem" data-id = "' . $item->id . '" >Delete</button>',

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
            $itemStore = Item::create(['name' => $request->name, 'created_by' => Auth::id()]);
            return response()->json(['status' => true, 'msg' => "item add successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function statusEdit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
                'id' => 'required|exists:items,id'
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $itemStore =  Item::where('id', $request->id)->update(['status' => $request->status]);
            return response()->json(['status' => true, 'msg' => "item status change successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
    public function deleteItem(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:items,id'
            ]);
            if ($validator->fails()) {

                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            //$itemStore =  Item::where('id', $request->id)->delete();
            $itemStore =  Item::where('id', $request->id)->update(['soft_delete' => 'false']);
            return response()->json(['status' => true, 'msg' => "item delete successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }

    public function itemEdit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'id' => 'required|exists:items,id'
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
            }
            $itemStore =  Item::where('id', $request->id)->update(['name' => $request->name]);
            return response()->json(['status' => true, 'msg' => "item Edit  successfully"]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'msg' => "Something went wrong"]);
        }
    }
}

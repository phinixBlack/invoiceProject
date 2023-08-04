<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    /*
    */
    public function index()
    {
        if (!Auth::guard('web')->check()) {
            return view('auth.login');
        }
        return redirect()->route('invoice.invoice.index');
    }
    public function login(Request $request)
    {
        try {
            $rules = [
                'email' => ['required',],
                'password' => ['required']
            ];
            $msg =  Validator::make($request->all(), $rules);
            if ($msg->fails()) {
                return response()->json(['status' => false, 'msg' => $msg->errors()->first()]);
            }

            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['status' => true, 'msg' => 'successfully login']);
            } else {
                return response()->json(['status' => false, 'msg' => 'Incorrect details']);
            }
        } catch (Exception $e) {

            return response()->json(['status' => false, 'msg' =>  "Something went wrong"]);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('auth.login.index');
    }
}

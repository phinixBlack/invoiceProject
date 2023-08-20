<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    //
    public function index()
    {   
        $getInvoiceCount = Invoice::count();
        $overdue =0;
        $unpaid= Invoice::where('status_payment','unpaid')->count();
        $paid = Invoice::where('status_payment','paid')->count();
        $partial = Invoice::where('status_payment','partial-payment')->count();
        $customers = Customer::count();
        $customersAcitve = Customer::where('status','active')->count();
        $customersInAcitve =  Customer::where('status','inactive')->count();
        return view('page.dashboard.dashboard', compact('overdue','unpaid','paid','partial','getInvoiceCount','customers','customersAcitve','customersInAcitve'));
    }
}

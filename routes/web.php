<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashbordController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\FreightController;
use App\Http\Controllers\Admin\PackageTypeController;
use App\Http\Controllers\Admin\PortController;
use App\Http\Controllers\Admin\ReportController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Report;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/wel', 'welcome');
Route::get('/', function () {
    return redirect()->route('auth.login.index');
});

Route::get('/login', [AuthController::class, 'index'])->name('auth.login.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.login');




Route::middleware(['user.guard'])->group(function () {

    // Route::view('/invoice', 'page.invoice')->name('invoice.index');
    Route::view('/item', 'page.item')->name('item.index');
    Route::get('/item-ajax', [ItemController::class, 'itemAjax'])->name('item.ajax');
    Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
    Route::post('/item/edit', [ItemController::class, 'itemEdit'])->name('item.edit');
    Route::post('/item/edit/status', [ItemController::class, 'statusEdit'])->name('item.edit.status');
    Route::post('/item/delete', [ItemController::class, 'deleteItem'])->name('item.delete');


    //
    Route::view('/customer', 'page.customer.customer')->name('customer.customer.index');
    Route::get('/customer-ajax', [CustomerController::class, 'customerAjax'])->name('customer.ajax');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::post('/customer/edit/status', [CustomerController::class, 'statusEdit'])->name('customer.edit.status');
    Route::post('/customer/delete', [CustomerController::class, 'deleteCustomer'])->name('customer.delete');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create.index');
    Route::post('/customer/create/store', [CustomerController::class, 'createStore'])->name('customer.create.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/customer/edit/store', [CustomerController::class, 'editStore'])->name('customer.edit.store');


    Route::view('/invoice', 'page.invoice.invoice')->name('invoice.invoice.index');
    Route::get('/invoice-ajax', [InvoiceController::class, 'invoiceAjax'])->name('invoice.ajax');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::post('/invoice/edit/status', [InvoiceController::class, 'statusEdit'])->name('invoice.edit.status');
    Route::post('/invoice/delete', [InvoiceController::class, 'deleteInvoice'])->name('invoice.delete');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create.index');
    Route::post('/invoice/create/store', [InvoiceController::class, 'createStore'])->name('invoice.create.store');
    Route::get('/invoice/edit/{id}', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::post('/invoice/edit/store', [InvoiceController::class, 'editStore'])->name('invoice.edit.store');
    Route::get('/invoice/print/{id}', [InvoiceController::class, 'print'])->name('invoice.print');
    Route::get('/invoice/print/commercial/{id}', [InvoiceController::class, 'printCommercial'])->name('invoice.print.commercial');
    Route::post('/invoice/status',[InvoiceController::class,'invoiceStatus'])->name('invoice.status.store');


    Route::view('/freight', 'page.freight.freight')->name('freight.freight.index');
    Route::get('/freight-ajax', [FreightController::class, 'freightAjax'])->name('freight.ajax');
    Route::get('/freight/create', [FreightController::class, 'create'])->name('freight.create.index');
    Route::post('/freight/create', [FreightController::class, 'createStore'])->name('freight.create.store');
    Route::get('/freight/edit/{id}', [FreightController::class, 'edit'])->name('freight.edit');
    Route::post('/freight/edit', [FreightController::class, 'editStore'])->name('freight.edit.store');
   
    Route::view('/banking', 'page.bank.bank')->name('bank.bank.index');
    Route::get('/banking-ajax', [BankController::class, 'bankAjax'])->name('bank.ajax');
    Route::get('/banking/create', [BankController::class, 'create'])->name('bank.create.index');
    Route::post('/banking/create', [BankController::class, 'createStore'])->name('bank.create.store');
    Route::get('/banking/edit/{id}', [BankController::class, 'edit'])->name('bank.edit');
    Route::post('/banking/edit', [BankController::class, 'editStore'])->name('bank.edit.store');
    
    Route::view('/company', 'page.company.company')->name('company.company.index');
    Route::get('/company-ajax', [CompanyController::class, 'companyAjax'])->name('company.ajax');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create.index');
    Route::post('/company/create', [CompanyController::class, 'createStore'])->name('company.create.store');
    Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/company/edit', [CompanyController::class, 'editStore'])->name('company.edit.store');
  

    Route::view('/report','page.report.report')->name('report.report.index');
    Route::get('/report-ajax',[ReportController::class,'reportAjax'])->name('report.ajax');
    Route::get('/report-ajax-print',[ReportController::class,'reportAjaxPrint'])->name('report.ajax.print');
    Route::get('/report-ajax-excel',[ReportController::class,'reportAjaxPrintExcel'])->name('report.ajax.print.excel');
    Route::get('/report-ajax-excel-second',[ReportController::class,'reportAjaxPrintExcelSecond'])->name('report.ajax.print.excel.second');

    Route::get('/dashboard',[DashbordController::class,'index'])->name('dashbaord.index');
    Route::get('/invoice-ajax-dashboard', [InvoiceController::class, 'invoiceAjaxDashboard'])->name('invoice.ajax.dashboard');
    Route::get('/customer-ajax-dashboard', [CustomerController::class, 'customerAjaxDashboard'])->name('customer.ajax.dashboard');


    Route::view('/port', 'page.port')->name('port.index');
    Route::get('/port-ajax', [PortController::class, 'portAjax'])->name('port.ajax');
    Route::post('/port/store', [PortController::class, 'store'])->name('port.store');
    Route::post('/port/edit', [PortController::class, 'portEdit'])->name('port.edit');
    Route::post('/port/edit/status', [PortController::class, 'statusEdit'])->name('port.edit.status');
    Route::post('/port/delete', [PortController::class, 'deletePort'])->name('port.delete');
    

    Route::view('/package-type', 'page.package-type')->name('packageType.index');
    Route::get('/package-type-ajax', [PackageTypeController::class, 'packageTypeAjax'])->name('packageType.ajax');
    Route::post('/package-type/store', [PackageTypeController::class, 'store'])->name('packageType.store');
    Route::post('/package-type/edit', [PackageTypeController::class, 'packageTypeEdit'])->name('packageType.edit');
    Route::post('/package-type/edit/status', [PackageTypeController::class, 'statusEdit'])->name('packageType.edit.status');
    Route::post('/package-type/delete', [PackageTypeController::class, 'deletePackageType'])->name('packageType.delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

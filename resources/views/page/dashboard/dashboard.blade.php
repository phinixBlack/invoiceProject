<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Invoice - Forms | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
  />

      <!-- Icons. Uncomment required icon fonts -->
 <link rel="stylesheet" href="{{ asset('public/assets/vendor/fonts/boxicons.css') }}" />

 <!-- Core CSS -->
 <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
 <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
 <link rel="stylesheet" href="{{ asset('public/assets/css/demo.css') }}" />
  
 <!-- Vendors CSS -->
 <link rel="stylesheet" href="{{ asset('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    @yield('extracss')
 <!-- Page CSS -->
 <!-- Page -->
 <link rel="stylesheet" href="{{ asset('public/assets/vendor/css/pages/page-auth.css') }}" />
 <!-- Helpers -->
 <script src="{{ asset('public/assets/vendor/js/helpers.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('public/izitoast/css/iziToast.min.css') }}" />
 <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css" />
   
 <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
 <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
 <script src="{{ asset('public/assets/js/config.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/datatable/css/jquery.dataTables.css') }}" />
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/billboard.js/dist/billboard.min.css" />
    <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>
    <style>.container{
        width: 95%;
        margin: 1px auto;
        padding: 10px;
      font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, "sans-serif";
        font-size:16px;
    }
        
    section {
      display: none;
      padding: 10px;
      border: 1px solid #ddd;
      overflow: hidden;
    }
    
    /* .tab input {
      display: none;
    } */
    
    label {
      display: inline-block;
      margin: 0 0 -1px;
      padding: 15px 25px;
      font-weight: bold;
      text-align: center;
      color: #1e3f79;
      border: 1px solid transparent;
    }
    
    label:before {
      font-weight: normal;
      margin-right: 10px;
    }
    
    label:hover {
      color: #888;
      cursor: pointer;
    }
    
    input:checked + label {
      color: #636363;
      border: 1px solid #ddd;
      border-top: 5px solid #1e3f79 ;
      border-bottom: 1px solid #fff;
    }
    
    #tab1:checked ~ #content1,
    #tab2:checked ~ #content2,
    #tab3:checked ~ #content3,
    #tab4:checked ~ #content4,
    #tab5:checked ~ #content5,
    #tab6:checked ~ #content6,
    #tab7:checked ~ #content7 {
      display: block;
    }
    ul > li{
        margin-bottom: 10px;
    }
    
    </style>

  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('include.sidebar')
       
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          @include('include.navbar')

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="row" style="margin:10px">
                <!-- Order Statistics -->
                <div class="col-md-12 col-lg-4 col-xl-4 order-0 mb-4">
                    <div class="card h-100">
                        <div id="donut-chart"></div>

                    </div>
                    
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4 order-0 mb-4" >
                    <div class="card h-10" style="padding:10px">
                        <div class="card-body" style="display: flex; justify-content: center;  align-items: center;flex-direction: column;">
                            <div class="row"> <i class="menu-icon tf-icons bx bx-user" style=" font-size: 32px; color: #1E90FF; border-radius: 24px; padding:8px 4px 8px 11px background-color: #e5e5e5;" ></i> </div>
                            <div class="row"> <strong>Customer</strong> </div>
                            <div class="row"> <strong style="color:#1E90FF">{{ $customers }}</strong> </div>
                        </div>
                        <div class="row"><div class="col-6" style="display: flex; justify-content: center;  align-items: center;flex-direction: column; border:soild 2px black"><p>Active user</p>
                        <strong>{{ $customersAcitve }}</strong></div>
                        <div class="col-6" style="display: flex; justify-content: center;  align-items: center;flex-direction: column;"><p>InActive User</p><strong>{{ $customersInAcitve }}</strong></div></div>
                  </div>
                    
                </div>
                <div class="col-md-12 col-lg-4 col-xl-4 order-0 mb-4" >
                    <div class="card h-10" style="padding:10px">
                        <div class="card-body" style="display: flex; justify-content: center;  align-items: center;flex-direction: column;">
                            <div class="row"> <i class="menu-icon tf-icons bx bx-detail" style=" font-size: 32px; color: #1E90FF; border-radius: 24px; padding:8px 4px 8px 11px background-color: #e5e5e5;" ></i> </div>
                            <div class="row"> <strong>Invoice</strong> </div>
                            <div class="row"> <strong style="color:#1E90FF">{{ $getInvoiceCount }}</strong> </div>
                        </div>
                        <div class="row"><div class="col-6" style="display: flex; justify-content: center;  align-items: center;flex-direction: column;"><p>Paid</p>
                        <strong>{{ $paid }}</strong></div>
                        <div class="col-6" style="display: flex; justify-content: center;  align-items: center;flex-direction: column;"><p>Partial Paid</p><strong>{{ $partial }}</strong></div></div>
                  </div>
                    
                </div>
                <!--/ Order Statistics -->

                <!-- Expense Overview -->



            </div>
            <div class="row">
                <div class="container">
                    <div class="tab">
                        <input id="tab1" type="radio" name="tabs" checked style="display:none">
                        <label for="tab1">Invoices</label>
                        <input id="tab2" type="radio" name="tabs" style="display:none">
                        <label for="tab2">My Customer</label>
                        <input id="tab3" type="radio" name="tabs" style="display:none">
                        <label for="tab3">MY Reports</label>
                        
                    <section id="content1">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Invoice Tab</h4>
                            <div class="row" style="margin: 10px">
                                <div class="card">
                                    <div class="row card-header">
                                        <div class="col">
                                            <h5 class="">Reports</h5>
                                        </div>
                                        
                                    </div>
                    
                    
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-bordered" id="Table1">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Invoice Id</th>
                                                        <th>Item Name</th>
                                                        <th>Buyer</th>
                                                        <th>Seller</th>
                                                        <th>HS Code</th>
                                                        <th>Country Origin</th>
                                                        <th>Loading Port</th>
                                                        <th>Discharge Port</th>
                                                        <th>Date</th>
                                                        <th>Print</th>
                                                        <th>Commercial</th>
                                                        {{-- <th>Edit</th> --}}
                                                        <th>Paid Status</th>
                                                    </tr>
                                                </thead>
                    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                          
                        </div>
            
                    </section>
                    <!-- end of section 1 -->
                    <section id="content2">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Customer Tab</h4>
                            <div class="row"  style="margin: 10px">
                                <div class="card">
                                    <div class="row card-header">
                                        <div class="col">
                                            <h5 class="">Reports</h5>
                                        </div>
                                     
                                    </div>
                    
                    
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-bordered" id="Table2">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Adress</th>
                                                        <th>Type</th>
                                                        <th>Bank Name</th>
                                                        <th>HS Code</th>
                                                        <th>Country Origin</th>
                                                        <th>Status</th>
                                                        {{-- <th>Edit</th>
                                                        <th>Delete</th> --}}
                    
                                                    </tr>
                                                </thead>
                    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
            
                    </section>
            
                    <!-- end of section 2 -->
                    <section id="content3">
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Report Tab</h4>
                                </div>
                                <div class="col-2 align-self-center"> <input id="start_date" class="form-control" type="date"
                                        placeholder="Start Date" name="start_date" /></div>
                                <div class="col-2 align-self-center"> <input id="end_date" class="form-control" type="date"
                                        placeholder="End Date" name="end_date" /></div>
                                <div class="col-1  align-self-center"><button class="btn btn-primary" id="search">Search</button></div>
                                <div class="col-1 align-self-center"><button class="btn btn-primary" id="reset">Reset</button></div>
                            </div>
                            <div class="row" style="margin: 10px">
                                <div class="card">
                                    <div class="row card-header">
                                        <div class="col">
                                            <h5 class="">Reports</h5>
                                        </div>
                                    </div>
                    
                    
                                    <div class="card-body">
                                        <div class="table-responsive text-nowrap">
                                            <table class="table table-bordered" id="Table3">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                    <th>No Of Container</th>
                                    <th>Container No / Seal No</th>
                                    <th>Item</th>
                                    <th>Quantity(Net weight)</th>
                                    <th>Origin</th>
                                    <th>Seller Name</th>
                                    <th>Buying Rate</th>
                                    <th>MBL No</th>
                                    <th>Import Inv No and Date</th>
                                    <th>Import BL No and Date</th>
                                    {{-- <th>Merchant company / Trading co</th> --}}
                                    <th>Port Of Loading</th>
                                    <th>Port Of Discharge</th>
                                    <th>Buyer Name</th>
                                    <th>Selling Rate PMT</th>
                                    <th>Export Invoice No</th>
                                    <th>Export Invoice Date</th>
                                    <th>Export BL No.</th>
                                    <th>Export BL Date</th>
                                    <th>Incoterm</th>
                                    <th>Contract No</th>
                                    <th>LC No.</th>
                                    {{-- <th>Remarks</th> --}}
                                    <th>Bank</th>
                                    <th>Import Payment Bank Ref No And Date</th>
                                    <th>Paid Amount</th>
                                    <th>Export Receipt Bank Ref No. And Date</th>
                                    <th>Receipt Amount</th>
                                    <th>Bank Charge </th>
                                    <th>Insurance</th>
                                    <th>Freight</th>
                                    {{-- <th>Profile Margin</th> --}}
                                                    </tr>
                                                </thead>
                    
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    </section>
              
                </div>
                        
            
                        
            </div>
            </div>
        </div>
        <!-- / Content -->

        </div>




       <!-- Footer -->
       <footer class="content-footer footer bg-footer-theme">
        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
          <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            , made By ITSoftexpert
            
          </div>
          <div>
            
          </div>
        </div>
      </footer>
      <!-- / Footer -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
  </div>
  <!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('public/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('public/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('public/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('public/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('public/izitoast/js/iziToast.min.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="{{ asset('public/assets/js/main.js') }}"></script>
<script src="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js"></script>
<script type="text/javascript" src="{{ asset('public/datatable/js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/datatable/js/jquery.dataTables.js') }}"></script>

<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('public/assets/vendor/js/menu.js') }}"></script>
        <!-- endbuild -->

        <!-- Vendors JS -->
        <script src="{{ asset('public/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

        

        <!-- Page JS -->
        <script src="{{ asset('public/assets/js/dashboards-analytics.js') }}"></script>
        <script>
            var overdue = "<?php echo $overdue; ?>";
            var unpaid = "<?php echo $unpaid; ?>";
            var paid = "<?php echo $paid; ?>";
            var partial = "<?php echo $partial; ?>";
            var getInvoiceCount = "<?php echo $getInvoiceCount; ?>";
            let chart = bb.generate({
                data: {
                    columns: [
                        ["unpaid", parseInt(unpaid)],
                        ["paid", parseInt(paid)],
                        ["partial", parseInt(partial)],
                    ],
                    type: "donut",

                },
                donut: {
                    title: 'invoices ',
                },
                bindto: "#donut-chart",
            });
            $(document).ready(function() {
                $('#Table1').DataTable({
                    "processing": true,
                    pageLength: 10,
                    "serverSide": true,
                    "bDestroy": true,
                    'checkboxes': {
                        'selectRow': true
                    },
                    "ajax": {
                        url: "{{ route('invoice.ajax.dashboard') }}",
                        "type": "GET",
                        "data": function(d) {
                            d._token = "{{ csrf_token() }}";
                        },
                        dataFilter: function(data) {
                            var json = jQuery.parseJSON(data);
                            json.recordsTotal = json.recordsTotal;
                            json.recordsFiltered = json.recordsFiltered;
                            json.data = json.data;
                            return JSON.stringify(json); // return JSON string
                        }
                    },
                    "order": [
                        [1, 'desc']
                    ],
                    "columns": [{
                            "targets": 0,
                            "name": "id",
                            'searchable': false,
                            'orderable': true
                        },
                        // {
                        //     "targets": 1,
                        //     "name": "name",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                    ]

                });
                $('#Table2').DataTable({
                    "processing": true,
                    pageLength: 10,
                    "serverSide": true,
                    "bDestroy": true,
                    'checkboxes': {
                        'selectRow': true
                    },
                    "ajax": {
                        url: "{{ route('customer.ajax.dashboard') }}",
                        "type": "GET",
                        "data": function(d) {
                            d._token = "{{ csrf_token() }}";
                        },
                        dataFilter: function(data) {
                            var json = jQuery.parseJSON(data);
                            json.recordsTotal = json.recordsTotal;
                            json.recordsFiltered = json.recordsFiltered;
                            json.data = json.data;
                            return JSON.stringify(json); // return JSON string
                        }
                    },
                    "order": [
                        [1, 'desc']
                    ],
                    "columns": [{
                            "targets": 0,
                            "name": "id",
                            'searchable': false,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                    ]

                });


                ///

                $('#Table3').DataTable({
                    "processing": true,
                    pageLength: 10,
                    "serverSide": true,
                    "bDestroy": true,
                    'checkboxes': {
                        'selectRow': true
                    },
                    "ajax": {
                        url: "{{ route('report.ajax') }}",
                        "type": "GET",
                        "data": function(d) {
                            d._token = "{{ csrf_token() }}";
                        },
                        dataFilter: function(data) {
                            var json = jQuery.parseJSON(data);
                            json.recordsTotal = json.recordsTotal;
                            json.recordsFiltered = json.recordsFiltered;
                            json.data = json.data;
                            return JSON.stringify(json); // return JSON string
                        }
                    },
                    "order": [
                        [1, 'desc']
                    ],
                    "columns": [{
                            "targets": 0,
                            "name": "id",
                            'searchable': false,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                    ]

                });
            });
            $('#reset').click(function() {
                $('#end_date').val("");
                $('#start_date').val("");
                $('#Table3').DataTable({
                    "processing": true,
                    pageLength: 10,
                    "serverSide": true,
                    "bDestroy": true,
                    'checkboxes': {
                        'selectRow': true
                    },
                    "ajax": {
                        url: "{{ route('report.ajax') }}",
                        "type": "GET",
                        "data": function(d) {
                            d._token = "{{ csrf_token() }}";
                        },
                        dataFilter: function(data) {
                            var json = jQuery.parseJSON(data);
                            json.recordsTotal = json.recordsTotal;
                            json.recordsFiltered = json.recordsFiltered;
                            json.data = json.data;
                            return JSON.stringify(json); // return JSON string
                        }
                    },
                    "order": [
                        [1, 'desc']
                    ],
                    "columns": [{
                            "targets": 0,
                            "name": "id",
                            'searchable': false,
                            'orderable': true
                        },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                    ]

                });
            })
            $('#search').click(function() {
                let endDate = $('#end_date').val();
                let startDate = $('#start_date').val();
                $('#Table3').DataTable({
                    "processing": true,
                    pageLength: 10,
                    "serverSide": true,
                    "bDestroy": true,
                    'checkboxes': {
                        'selectRow': true
                    },
                    "ajax": {
                        url: "{{ route('report.ajax.print') }}",
                        "type": "GET",
                        "data": function(d) {
                            d._token = "{{ csrf_token() }}";
                            d.endDate = endDate;
                            d.startDate = startDate;
                        },
                        dataFilter: function(data) {
                            var json = jQuery.parseJSON(data);
                            json.recordsTotal = json.recordsTotal;
                            json.recordsFiltered = json.recordsFiltered;
                            json.data = json.data;
                            return JSON.stringify(json); // return JSON string
                        }
                    },
                    "order": [
                        [1, 'desc']
                    ],
                    "columns": [{
                            "targets": 0,
                            "name": "id",
                            'searchable': false,
                            'orderable': true
                        },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        // {
                        //     "targets": 1,
                        //     "name": "status",
                        //     'searchable': true,
                        //     'orderable': true
                        // },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "name",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                        {
                            "targets": 1,
                            "name": "status",
                            'searchable': true,
                            'orderable': true
                        },
                    ]

                });

            });
        </script>
@yield('js')
</body>
</html>

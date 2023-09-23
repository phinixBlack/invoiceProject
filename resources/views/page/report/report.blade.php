@extends('main.main')
@section('extracss')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/datatable/css/jquery.dataTables.css') }}" />
@endsection
@section('pagename')
    <a class="navbar-brand ml-5" style="color: #242423;" href="#">Sales List</a>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-5">
                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Report Tab</h4>
            </div>
            <div class="col-2 align-self-center"> <input id="start_date" class="form-control" type="date"
                    placeholder="Start Date" name="start_date" /></div>
            <div class="col-2 align-self-center"> <input id="end_date" class="form-control" type="date"
                    placeholder="End Date" name="end_date" /></div>
            <div class="col-1  align-self-center"><button class="btn btn-primary" id="search">Search</button></div>
            <div class="col-1 align-self-center"><button class="btn btn-primary" id="reset">Reset</button></div>
            <div class="col-1 align-self-center"><button class="btn btn-primary" id="filter">Excel</button></div>
            <div class="col-1 align-self-center"><button class="btn btn-primary" id="secondexcel">SendExcel</button></div>
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
                        <table class="table table-bordered" id="testingTable">
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

@section('js')
    <script type="text/javascript" src="{{ asset('public/datatable/js/jquery-3.6.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/datatable/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#testingTable').DataTable({
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
            $('#testingTable').DataTable({
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
                    //     "targets": 0,
                    //     "name": "id",
                    //     'searchable': false,
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
            $('#testingTable').DataTable({
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
                    //     "targets": 0,
                    //     "name": "id",
                    //     'searchable': false,
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
        $('#filter').click(function() {
            let endDate = $('#end_date').val();
            let startDate = $('#start_date').val();
            if (endDate && startDate) {

                location.href = `{{ url('/report-ajax-excel?data=${endDate}?${startDate}') }}`
            } else {
                iziToast.error({
                    message: "need to select start date and end date",
                    position: 'topRight'
                });
            }


        });
        $('#secondexcel').click(function() {
            let endDate = $('#end_date').val();
            let startDate = $('#start_date').val();
            if (endDate && startDate) {
                location.href = `{{ url('/report-ajax-excel-second?data=${endDate}?${startDate}') }}`
            } else {
                iziToast.error({
                    message: "need to select start date and end date",
                    position: 'topRight'
                });
            }


        });
    </script>
@endsection
@endsection

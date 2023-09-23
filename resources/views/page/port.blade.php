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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Port Tab</h4>
        <div class="row">
            <div class="card">
                <div class="row card-header">
                    <div class="col">
                        <h5 class="">Reports</h5>
                    </div>
                    <div class="col align-self-end "> <button type="button" class="btn btn-primary"
                            style="margin-left: 448px" data-bs-toggle="modal" data-bs-target="#addModule">
                            Add Port
                        </button></div>
                </div>


                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="testingTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>

         {{-- add item module --}}
    <div class="col-lg-4 col-md-6">
        <small class="text-light fw-semibold">Default</small>
        <div class="mt-3">
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="addModule" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Add Port</h5>
                            <button type="button" class="btn-close addItem" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="itemForm" class="mb-3" action="#" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Port Name</label>
                                        <input type="text" id="nameBasic" class="form-control" name="name"
                                            placeholder="Enter Item Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- edit item moddule --}}
    <div class="col-lg-4 col-md-6">
        <small class="text-light fw-semibold">Default</small>
        <div class="mt-3">
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="editModule" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Edit Port</h5>
                            <button type="button" class="btn-close addItem" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form id="itemEdit" class="mb-3" action="#" method="POST">
                            <input type="hidden" name="id" id="portId">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="nameBasic" class="form-label">Port Name</label>
                                        <input type="text" id="portName" class="form-control" name="name"
                                            placeholder="Enter Item Name" />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
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
                    url: "{{ route('port.ajax') }}",
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
                ]

            });
            $('#itemForm').submit(function(e) {
                e.preventDefault();
                var fd = new FormData(this);
                fd.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ route('port.store') }}",
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.generalsets').prop('disabled', true);
                    },
                    success: function(result) {
                        if (result.status === true) {
                            iziToast.success({
                                message: result.msg,
                                position: 'topRight'
                            });
                            $('.addItem').click();
                            $('#testingTable').DataTable().ajax.reload(null, false);

                        } else {
                            iziToast.error({
                                message: result.msg,
                                position: 'topRight'
                            });
                        }
                    }
                })
            });
            $('body').on('click', '.statusChange', function() {

                let body = $(this).parent();
                let id = $(this).data('id');
                let status = $(this).data('status');
                var fd = new FormData();
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('id', id);
                fd.append('status', status);
                $.ajax({
                    url: "{{ route('port.edit.status') }}",
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.generalsets').prop('disabled', true);
                    },
                    success: function(result) {
                        if (result.status === true) {
                            iziToast.success({
                                message: result.msg,
                                position: 'topRight'
                            });
                            $('#testingTable').DataTable().ajax.reload(null, false);

                        } else {
                            iziToast.error({
                                message: result.msg,
                                position: 'topRight'
                            });
                        }
                    }
                })
            });
            $('body').on('click', '.delteport', function() {

                let body = $(this).parent();
                let id = $(this).data('id');
                var fd = new FormData();
                fd.append('_token', "{{ csrf_token() }}");
                fd.append('id', id);
                fd.append('status', status);
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this item !",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: "No, cancel plx!",
                        // closeOnConfirm: false,
                        //  closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ route('port.delete') }}",
                                type: "post",
                                data: fd,
                                dataType: "JSON",
                                processData: false,
                                contentType: false,
                                beforeSend: function() {
                                    $('.generalsets').prop('disabled', true);
                                },
                                success: function(result) {
                                    if (result.status === true) {
                                        iziToast.success({
                                            message: result.msg,
                                            position: 'topRight'
                                        });
                                        $('#testingTable').DataTable().ajax.reload(null,
                                            false);

                                    } else {
                                        iziToast.error({
                                            message: result.msg,
                                            position: 'topRight'
                                        });
                                    }
                                }
                            })
                        }
                    });

            });
            $('body').on('click', '.editport', function() {

                let body = $(this).parent();
                let id = $(this).data('id');
                let name = $(this).data('name');
                $('#portId').val(id);
                $('#portName').val(name);
                $('#editModule').modal('show');
            });
            $('#itemEdit').submit(function(e) {
                e.preventDefault();
                var fd = new FormData(this);
                fd.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ route('port.edit') }}",
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('.generalsets').prop('disabled', true);
                    },
                    success: function(result) {
                        if (result.status === true) {
                            iziToast.success({
                                message: result.msg,
                                position: 'topRight'
                            });
                            $('.addItem').click();
                            $('#testingTable').DataTable().ajax.reload(null, false);

                        } else {
                            iziToast.error({
                                message: result.msg,
                                position: 'topRight'
                            });
                        }
                    }
                })
            });



        });
    </script>
@endsection
@endsection

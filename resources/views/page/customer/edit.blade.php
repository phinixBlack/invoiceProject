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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Customer Tab</h4>
        <div class="row" style="margin: 10px">
            <form id="customer_edit" action="#" method="POST">
                <div class="card col-12">

                    <div class="row card-header" style="margin:1px">
                        <div class="col">
                            <h5 class="">Reports</h5>
                        </div>
                        <div class="col align-self-end "> <button type="submit"class="btn btn-primary"
                                style="margin-left: 448px">
                                Save
                            </button></div>
                    </div>


                    <div class="row" style="padding:9px">
                        <!-- Form controls and first invoice tab -->

                        <div class="col-md-6">

                            <div class="card mb-4" style="padding:2px">
                                <h5 class="card-header">Vendor Details</h5>
                                <div class="card-body">
                                    <input id="defaultInput" class="form-control" type="hidden" name="customer_id" value="{{$customer->id}}"
                                    placeholder="Enter Name..." />
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Customer Name</label>
                                        <input id="defaultInput" class="form-control" type="text" name="name" value="{{$customer->name}}"
                                            placeholder="Enter Name..." />
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Type Of Customer</label>
                                        <select class="form-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example" name="type">
                                            <option style="color: #697a8d;"value="" selected>select or write...
                                            </option>
                                            <option value="seller" {{$customer->type == "seller" ? "selected" : ""}}>Seller</option>
                                            <option value="buyer" {{$customer->type == "buyer" ? "selected" : ""}}>Buyer</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Address</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address">{{$customer->address}}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Customer Country</label>
                                        <input id="defaultInput" class="form-control" type="text" name="country" value="{{$customer->country}}"
                                            placeholder="Enter Country..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Customer State</label>
                                        <input id="defaultInput" class="form-control" type="text" name="state"  value="{{$customer->state}}"
                                            placeholder="Enter State..." />
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Second invoice tab -->

                        <div class="col-md-6">
                            <div class="card mb-4">
                                <h5 class="card-header">Account Details</h5>
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Bank Name</label>
                                        <input id="defaultInput" class="form-control" type="text" name="bank_name" value="{{$customer->bank_name}}"
                                            placeholder="Enter Bank Name..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Bank Address</label>
                                        <input id="defaultInput" class="form-control" type="text" name="bank_address" value="{{$customer->bank_address}}"
                                            placeholder="Enter Bank Address..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Account No</label>
                                        <input id="defaultInput" class="form-control" type="text" name="account_no" value="{{$customer->account_no}}" 
                                            placeholder="Enter Account No..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Swift No</label>
                                        <input id="defaultInput" class="form-control" type="text" name="swift_no" value="{{$customer->swift_no}}"
                                            placeholder="Enter Swift No..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">IBAN No</label>
                                        <input id="defaultInput" class="form-control" type="text" name="IBAN_no" value="{{$customer->IBAN_no}}"
                                            placeholder="Enter IBAN_no..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Routing No</label>
                                        <input id="defaultInput" class="form-control" type="text" name="routing_no" value="{{$customer->routing_no}}"
                                            placeholder="Enter Routing No..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">IFSC Code</label>
                                        <input id="defaultInput" class="form-control" type="text" name="ifsc" value="{{$customer->ifsc}}"
                                            placeholder="Enter IFSC Code..." />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Third tab Other Information -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <h5 class="card-header">Port Information</h5>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Port Of Loading</label>
                                        <input id="defaultInput" class="form-control" type="text" value="{{$customer->port_loading}}" 
                                            name="port_of_loading" placeholder="Enter Port Of Loading..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Port Of Discharge</label>
                                        <input id="defaultInput" class="form-control" type="text" value="{{$customer->port_discharge}}"
                                            name="port_of_discharge" placeholder="Enter Port Of Discharge..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Country Of Origin</label>
                                        <input id="defaultInput" class="form-control" type="text" value="{{$customer->country_origin}}"
                                            name="country_origin" placeholder="Enter Country Of origin..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Incoterms</label>
                                        <input id="defaultInput" class="form-control" type="text" name="incoterms" value="{{$customer->incoterms}}"
                                            placeholder="Enter Incoterms..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">HS Code</label>
                                        <input id="defaultInput" class="form-control" type="text" value="{{$customer->HS_code}}" name="HS_code"
                                            placeholder="Enter HS code..." />
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    @section('js')
        <script type="text/javascript" src="{{ asset('public/datatable/js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/datatable/js/jquery.dataTables.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#customer_edit').submit(function(e) {
                    e.preventDefault();
                    var fd = new FormData(this);
                    fd.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: "{{ route('customer.edit.store') }}",
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
                                location.href = "{{ route('customer.customer.index') }}"

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

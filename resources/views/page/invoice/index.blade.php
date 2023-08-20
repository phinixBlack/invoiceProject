@extends('main.main')
@section('extracss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
@endsection
@section('pagename')
    <a class="navbar-brand ml-5" style="color: #242423;" href="#">Sales List</a>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Invoice Tab</h4>
        <form id="invoice_create" method="POST" acton="#">
            <div class="row">
                <!-- Form controls and first invoice tab -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Invoice No.</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="auto or edit...."
                                    name="invoice_id" readonly />
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Invoice of (Item)</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="item_id" >
                                    <option style="color: #697a8d;" value="" selected>select or write...</option>
                                    @foreach ($item as $key => $obj)
                                        <option value="{{ $obj->id }}">{{ ucfirst($obj->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">From (Port of Loading)</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="port_loading_id" >
                                    <option value="" selected>select or write...</option>
                                    @foreach ($ports as $key => $obj)
                                        <option value="{{ $obj->id }}">{{ ucfirst($obj->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Export BL No.</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="bl_no"  />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">BL Date</label>
                                <input class="form-control" type="date" value="" id="html5-date-input"
                                    name="bl_date" placeholder="Invoice date" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Buyer</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="buyer_id" placeholder="Buyer" >
                                    <option value="" selected>select...</option>
                                    @foreach ($customer as $key => $obj)
                                        @if ($obj->type === 'buyer')
                                            <option value="{{ $obj->id }}">{{ ucfirst($obj->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Net Weight</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    name="net_weight"  />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Rate</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    name="rate"  />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Packs</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    name="packs"  />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Unit of Measurement</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="unit_measure" placeholder="Measurement"
                                    >
                                    <option value="" selected>select...</option>
                                    <option value="mt" >MT</option>
                                    <option value="kt" >KT</option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Gross Weight</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    name="gross_weight"  />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">HS Code</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="hs_code"  />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Vessel Name</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="vessel_name"  />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second invoice tab -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Invoice Date</label>
                                <input class="form-control" type="date" value="" id="html5-date-input"
                                    name="invoice_date" placeholder="Invoice date" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Origin</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="origin" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">To (Port of Discharge)</label>
                                <select id="defaultSelect" class="form-select" name="port_of_discharge">
                                    <option value="" selected>select or write...</option>
                                    @foreach ($ports as $key => $obj)
                                        <option value="{{ $obj->id }}">{{ ucfirst($obj->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Bank</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="bank_name" placeholder="Measurement">
                                    <option value="" selected>select...</option>
                                    @foreach ($bank as $key => $obj)
                                            <option value="{{ $obj->id }}">{{ ucfirst($obj->name) }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Incoterms</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="incoterms" />

                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Seller</label>
                                <select id="defaultSelect" class="form-select" name="seller_id">
                                    <option value="">select....</option>
                                    @foreach ($customer as $key => $obj)
                                        @if ($obj->type === 'seller')
                                            <option value="{{ $obj->id }}">{{ ucfirst($obj->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Trading Co.</label>
                                    <select id="defaultSelect" class="form-select" name="trading_co">
                                        <option value="">select....</option>
                                        @foreach ($company as $key => $obj)
                                                <option value="{{ $obj->id }}">{{ ucfirst($obj->company_name) }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Buying Rate</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    name="buying_rate" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import Inv No</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."  name="import_inv_no"/>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import Inv Date</label>
                                <input id="defaultInput" class="form-control" type="date" placeholder="write...."  name="import_inv_date"/>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import BL No</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."  name="import_bl_no"/>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import BL Date</label>
                                <input id="defaultInput" class="form-control" type="date" placeholder="write...." name="import_bl_date" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Freight</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    name="freight"  />
                            </div>

                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Container Details</h5>
                        <div class="card-body">
                            <div id="inputFormRow">
                                <div class="row">

                                    <div class="col-5">
                                        <div class="mb-3">
                                            <label for="defaultInput" class="form-label">CONTAINER NO.</label>
                                            <input id="defaultInput" class="form-control" type="text"
                                                name="container_no[]" placeholder="write...."  required>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="mb-3">
                                            <label for="defaultInput" class="form-label">SEAL NO.</label>
                                            <input id="defaultInput" class="form-control" type="text"
                                                name="seal_no[]" placeholder="write...."  required>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="mb-3" style="margin: 29px; ">
                                            <button id="addRow" type="button" class="btn btn-danger">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="newRow"></div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Third tab Other Information -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Other Information</h5>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">
                                            Marks & Numbers
                                        </label>
                                        <input id="defaultInput" class="form-control" type="text"
                                            placeholder="write...." name="mark">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">
                                            Quality Certificate
                                        </label>
                                        <select id="defaultSelect" class="form-select" name="quality_certificate">
                                            <option value="">select...</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>

                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Documentary
                                            Credit No.
                                        </label>
                                        <input id="defaultInput" class="form-control" type="text"
                                            placeholder="write...." name="doc_credit_no">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Documentary
                                            Credit No. Date</label>
                                        <input class="form-control" type="date" value="" id="html5-date-input"
                                            name="doc_credit_no_date" placeholder="Invoice date" />

                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">
                                            Contract No.
                                        </label>
                                        <input id="defaultInput" class="form-control" type="text"
                                            placeholder="write...." name="contract_no">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">
                                            Contract No. Date</label>
                                        <input class="form-control" type="date" value="" id="html5-date-input"
                                            name="contract_no_date" placeholder="Contract date" />

                                    </div>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">
                                            Quality Certificate Context
                                        </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="quality_certi_context"></textarea>
                                    </div>
                                </div>


                            </div>
                            <button type="submit"class="btn btn-primary" style="margin-left: 448px ;margin-top: 10px;">
                                Save
                            </button>
                        </div>
                    </div>

                </div>
                {{-- <div class="col-xl-6">
                <div class="card mb-4">
                    <h5 class="card-header">Other Information</h5>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                            <div class="col-md-12">
                                <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
                            </div>
                            <div class="mb-3">
                                <label for="html5-date-input" class="col-md-2 col-form-label">Date</label>
                                <div class="col-md-12">
                                    <input class="form-control" type="date" value="2021-06-18"
                                        id="html5-date-input" />
                                </div>
                                <div class="mb-3">
                                    <label for="defaultSelect" class="form-label">Quality Certificate</label>
                                    <select id="defaultSelect" class="form-select">
                                        <option>select...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--fifth-->

            </div> --}}
            </div>
        </form>

        <!--Fourth tab Other Information  -->

    @section('js')
        <script>
            $("#addRow").click(function() {
                var html = '';
                html += `     <div id="inputFormRow">
                            <div class="row">

                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">CONTAINER NO.</label>
                                        <input id="defaultInput" class="form-control" type="text"  name="container_no[]"
                                            placeholder="write...."  required />
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">SEAL NO.</label>
                                        <input id="defaultInput" class="form-control" type="text"  name="seal_no[]"
                                            placeholder="write...."  required />
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-3" style="margin: 29px; ">
                                        <button id="removeRow" type="button" class="btn btn-danger">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                $('#newRow').append(html);
            });
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#inputFormRow').remove();
            });

            $('#invoice_create').submit(function(e) {
                e.preventDefault();
                var fd = new FormData(this);
                fd.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ route('invoice.create.store') }}",
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
                            location.href = "{{ route('invoice.invoice.index') }}"

                        } else {
                            iziToast.error({
                                message: result.msg,
                                position: 'topRight'
                            });
                        }
                    }
                })
            });
        </script>
    @endsection
@endsection

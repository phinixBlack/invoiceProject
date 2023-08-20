@extends('main.main')
@section('extracss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <style>input[type="file"] {
        display: block;
      }
      .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
      }
      .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
      }
      .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
      }
      .remove:hover {
        background: white;
        color: black;
      }
      </style>
@endsection
@section('pagename')
    <a class="navbar-brand ml-5" style="color: #242423;" href="#">Sales List</a>
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Invoice Tab</h4>
        <form id="invoice_create" method="POST" acton="#" enctype="multipart/form-data">
            <div class="row">
                <!-- Form controls and first invoice tab -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Invoice No.</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="auto or edit...."
                                    name="invoice_id" readonly value="{{ $invoice->invoice_id }}" />
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Invoice of (Item)</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="item_id">
                                    <option style="color: #697a8d;" value="">select or write...</option>
                                    @foreach ($item as $key => $obj)
                                        <option value="{{ $obj->id }}"
                                            {{ $invoice->item_id === $obj->id ? 'selected' : '' }}>{{ ucfirst($obj->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">From (Port of Loading)</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="port_loading_id">
                                    <option value="" selected>select or write...</option>
                                    @foreach ($ports as $key => $obj)
                                        <option value="{{ $obj->id }}"
                                            {{ $invoice->port_loading_id === $obj->id ? 'selected' : '' }}>
                                            {{ ucfirst($obj->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Export BL No.</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    value="{{ $invoice->bl_no }}" name="bl_no" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">BL Date</label>
                                <input class="form-control" type="date" id="html5-date-input"
                                    value="{{ $invoice->bl_date }}" name="bl_date" placeholder="Invoice date" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Buyer</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="buyer_id" placeholder="Buyer">
                                    <option value="" selected>select...</option>
                                    @foreach ($customer as $key => $obj)
                                        @if ($obj->type === 'buyer')
                                            <option value="{{ $obj->id }}"
                                                {{ $invoice->buyer_id === $obj->id ? 'selected' : '' }}>
                                                {{ ucfirst($obj->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Net Weight</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    value="{{ $invoice->net_weight }}" name="net_weight" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Rate</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    value="{{ $invoice->rate }}" name="rate" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Packs</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    value="{{ $invoice->packs }}" name="packs" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Unit of Measurement</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="unit_measure" placeholder="Measurement">
                                    <option value="" selected>select...</option>
                                    <option value="mt" {{ $invoice->unit_measure === 'mt' ? 'selected' : '' }}>MT
                                    </option>
                                    <option value="kt" {{ $invoice->unit_measure === 'kt' ? 'selected' : '' }}>KT
                                    </option>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Gross Weight</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    value="{{ $invoice->gross_weight }}" name="gross_weight" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">HS Code</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    value="{{ $invoice->hs_code }}" name="hs_code" />
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
                                    name="invoice_date" placeholder="Invoice date" readonly
                                    value="{{ $invoice->invoice_date }}" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Origin</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    value="{{ $invoice->origin }}" name="origin" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">To (Port of Discharge)</label>
                                <select id="defaultSelect" class="form-select" name="port_of_discharge">
                                    <option value="" selected>select or write...</option>
                                    @foreach ($ports as $key => $obj)
                                        <option value="{{ $obj->id }}"
                                            {{ $invoice->port_of_discharge === $obj->id ? 'selected' : '' }}>
                                            {{ ucfirst($obj->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Bank</label>
                                <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example" name="bank_name" placeholder="Measurement">
                                    <option value="">Select...</option>
                                    @foreach ($bank as $key => $obj)
                                        <option value="{{ $obj->id }}"
                                            {{ $invoice->bank_name == $obj->id ? 'selected' : '' }}>
                                            {{ ucfirst($obj->name) }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Incoterms</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    value="{{ $invoice->incoterms }}" name="incoterms" />

                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Seller</label>
                                <select id="defaultSelect" class="form-select" name="seller_id">
                                    <option value="">select....</option>
                                    @foreach ($customer as $key => $obj)
                                        @if ($obj->type === 'seller')
                                            <option value="{{ $obj->id }}"
                                                {{ $invoice->seller_id === $obj->id ? 'selected' : '' }}>
                                                {{ ucfirst($obj->name) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Trading Co.</label>
                                <select id="defaultSelect" class="form-select" name="trading_co">
                                    <option value="">select....</option>
                                    @foreach ($company as $key => $obj)
                                        <option value="{{ $obj->id }}"
                                            {{ $invoice->trading_co === $obj->id ? 'selected' : '' }}>
                                            {{ ucfirst($obj->company_name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Buying Rate</label>
                                <input id="defaultInput" class="form-control" type="number" placeholder="write...."
                                    value="{{ $invoice->buying_rate }}" name="buying_rate" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import Inv No</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    value="{{ $invoice->import_inv_no }}" name="import_inv_no" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import Inv Date</label>
                                <input id="defaultInput" class="form-control" type="date" placeholder="write...."
                                    value="{{ $invoice->import_inv_date }}" name="import_inv_date" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import BL No</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    value="{{ $invoice->import_bl_no }}" name="import_bl_no" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Import BL Date</label>
                                <input id="defaultInput" class="form-control" type="date" placeholder="write...."
                                    value="{{ $invoice->import_bl_date }}" name="import_bl_date" />
                            </div>
                            <input type="hidden" name="id" value="{{ $invoice->id }}">
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="row">
                            <div class="col-10">
                                <h5 class="card-header">Container Details</h5>
                            </div>
                            <div class="col-auto card-header"> <button id="addRow" type="button"
                                    class="btn btn-danger">Add</button></div>
                        </div>


                        <div class="card-body">

                            <div id="inputFormRow">
                                @php
                                    $container = $invoice['container'];
                                @endphp
                                @foreach ($container as $key => $obj)
                                    <div class="row" id="{{ $obj->id }}">

                                        <div class="col-5">
                                            <div class="mb-3">
                                                <label for="defaultInput" class="form-label">CONTAINER NO.</label>
                                                <input id="defaultInput" class="form-control" type="text"
                                                    name="container_no[]" placeholder="write...."
                                                    value="{{ $obj->container_no }}" required>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="mb-3">
                                                <label for="defaultInput" class="form-label">SEAL NO.</label>
                                                <input id="defaultInput" class="form-control" type="text"
                                                    name="seal_no[]" placeholder="write...." value="{{ $obj->seal_no }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mb-3" style="margin: 29px; ">
                                                <button id="removeRow1" data-id="{{ $obj->id }}" type="button"
                                                    class="btn btn-danger">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

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
                                        <input id="defaultInput" class="form-control" type="text"  value="{{$invoice->mark}}"
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
                                            <option value="yes"  {{ $invoice->quality_certificate === 'yes' ? 'selected' : '' }}>Yes</option>
                                            <option value="no" {{ $invoice->quality_certificate === 'no' ? 'selected' : '' }} >No</option>
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
                                        <input id="defaultInput" class="form-control" type="text" value="{{$invoice->doc_credit_no}}"
                                            placeholder="write...." name="doc_credit_no">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Documentary
                                            Credit No. Date</label>
                                        <input class="form-control" type="date"  id="html5-date-input" value="{{$invoice->doc_credit_no_date}}"
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
                                        <input id="defaultInput" class="form-control" type="text" value="{{$invoice->contract_no}}"
                                            placeholder="write...." name="contract_no">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">
                                            Contract No. Date</label>
                                        <input class="form-control" type="date" id="html5-date-input" value="{{$invoice->contract_no_date}}"
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
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="quality_certi_context"> {{$invoice->quality_certi_context}}</textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                            <div class="field" align="left">
                                <h3>Upload your images</h3>
                                <input type="file" id="files" name="files[]" multiple />
                                @php
                                $file = $invoice['file'];
                            @endphp
                                @foreach($file as $key =>$obj)
                                <span class="pip">
                                    <img class="imageThumb" src="{{asset('public/uploads/'.$obj->path)}}">
                                    <br/><span class="remove1"></span>
                                    </span>
                                @endforeach
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
                    url: "{{ route('invoice.edit.store') }}",
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

            $(document).on('click', '#removeRow1', function() {
                let id = $(this).attr("data-id");
                $('#' + id).remove();
            })
            $(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
        </script>
    @endsection
@endsection

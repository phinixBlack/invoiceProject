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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Bank Invoice Tab</h4>
        <div class="row" style="margin: 10px">
            <form id="freight_create" action="#" method="POST">
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

                        <div class="col-md-12">

                            <div class="card mb-4" style="padding:2px">
                                <h5 class="card-header">Freight Edit</h5>
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Invoice No</label>


                                        <input readonly class="form-control" value="{{ $bankInvoice->invoice_name }}">
                                        <input type="hidden" class="form-control" name="invoice_id"
                                            value="{{ $bankInvoice->invoice_id }}">

                                    </div>

                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Payment Bank Reference No</label>
                                        <input id="defaultInput" class="form-control" type="text" value="{{ $bankInvoice->payment_bank_ref_no }}"
                                            name="payment_bank_ref_no" placeholder="Enter Payment Bank Reference No ...." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Paid Amount</label>
                                        <input id="defaultInput" class="form-control" type="number" name="paid_amount" value="{{ $bankInvoice->paid_amount }}"
                                            placeholder="Enter Paid Amount...." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Receipt Bank Ref No</label>
                                        <input id="defaultInput" class="form-control" type="text" value="{{ $bankInvoice->receipt_bank_ref_no }}"
                                            name="receipt_bank_ref_no" placeholder="Enter Receipt Bank Ref No ..." />
                                    </div>
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Receipt Amount</label>
                                        <input id="defaultInput" class="form-control" type="number" name="receipt_amount"  value="{{ $bankInvoice->receipt_amount }}"
                                            placeholder="Enter Receipt Amount...." />
                                    </div>

                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Bank Charge</label>
                                        <input id="defaultInput" class="form-control" type="number" name="bank_charge"  value="{{ $bankInvoice->bank_charge }}"
                                            placeholder="Enter Bank Charge ..." />
                                    </div>
                                    <input type="hidden" name="id" value="{{ $bankInvoice->id }}">
                                </div>
                            </div>
                        </div>

                        <!-- Second invoice tab -->

                    </div>
                </div>
            </form>

        </div>

    @section('js')
        <script type="text/javascript" src="{{ asset('public/datatable/js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/datatable/js/jquery.dataTables.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#freight_create').submit(function(e) {
                    e.preventDefault();
                    var fd = new FormData(this);
                    fd.append('_token', "{{ csrf_token() }}");

                    $.ajax({
                        url: "{{ route('bank.edit.store') }}",
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
                                setTimeout(function() {
                                    location.href = "{{ route('bank.bank.index') }}"
                                }, 2000);
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

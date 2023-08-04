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
        <form id="company_create" method="POST" acton="#">
            <div class="row">
                <!-- Form controls and first invoice tab -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Company Name</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="auto or edit...."
                                    name="company_name"  />
                            </div>

                        
                           
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">City</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="city"  />
                            </div>
                          
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Country</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="country"  />
                            </div>
                            <div class="mb-3">
                                <label for="defaultInput" class="form-label">Pin Code</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="pin_code"  />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Address</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="address"></textarea>
                                 

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second invoice tab -->
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Account No</label>
                                <input class="form-control" type="text" value="" id="html5-date-input"
                                    name="account_no" placeholder="Invoice date" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Bank Name</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="bank_name" />
                            </div>
                            
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Swift Code</label>
                                <input class="form-control" type="text" value="" id="html5-date-input"
                                    name="swift_code" placeholder="Invoice date" />
                            </div>
                           
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">IFSC</label>
                                <input id="defaultInput" class="form-control" type="text" placeholder="write...."
                                    name="ifsc" />

                            </div>
                            <div class="mb-3">
                                <label for="defaultSelect" class="form-label">Bank Address</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bank_address"></textarea>
                                 

                            </div>
                            <button type="submit"class="btn btn-primary" style="margin-left: 448px ;margin-top: 10px;">
                                Save
                            </button>

                        </div>
                    </div>
                </div>


            </div>
            
        </form>

        <!--Fourth tab Other Information  -->

    @section('js')
        <script>
          

            $('#company_create').submit(function(e) {
                e.preventDefault();
                var fd = new FormData(this);
                fd.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ route('company.create.store') }}",
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
                            location.href = "{{ route('company.company.index') }}"

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

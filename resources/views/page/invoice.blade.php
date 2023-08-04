@extends('main.main')
@section('extracss')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
@endsection
@section('pagename')
    <a class="navbar-brand ml-5" style="color: #242423;" href="#">Sales List</a>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span>  Invoice Tab</h4>

    <div class="row">
      <!-- Form controls and first invoice tab -->
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
              <div class="mb-3">
                  <label for="defaultInput" class="form-label">Invoice No.</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="auto or edit...." />
              </div>
         
            <div class="mb-3">
              <label for="exampleFormControlSelect1" class="form-label">Invoice of (Item)</label>
              <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                <option style="color: #697a8d;" selected>select or write...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                <option value="4">Four</option>
              </select>
            </div>
              <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">From (Port of Loading)</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option selected>select or write...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                  </select>
              </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Export BL No.</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
              <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">Buyer</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option selected>select...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                  </select>
              </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Net Weight</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Rate</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Packs</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Container No.</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Seal No.</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
                <div class="mb-3">
                  <label for="defaultInput" class="form-label">Gross Weight</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
                </div>
              <div class="mb-3">
                  <label for="exampleFormControlSelect1" class="form-label">HS Code</label>
                  <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                      <option selected>select or write...</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">Four</option>
                  </select>
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
              <select id="defaultSelect" class="form-select">
                <option>select....</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Origin</label>
              <select id="defaultSelect" class="form-select">
                <option>select or write...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">To (Port of Discharge)</label>
              <select id="defaultSelect" class="form-select">
                <option>select or write...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">BL Date</label>
              <select id="defaultSelect" class="form-select">
                <option>select...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Bank</label>
              <select id="defaultSelect" class="form-select">
                <option>select...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Incoterms</label>
              <select id="defaultSelect" class="form-select">
                <option>select...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Seller</label>
              <select id="defaultSelect" class="form-select">
                <option>select...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Trading Co.</label>
              <select id="defaultSelect" class="form-select">
                <option>select...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
              <div class="mb-3">
                  <label for="defaultInput" class="form-label">Buying Rate</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
              </div>
              <div class="mb-3">
                  <label for="defaultInput" class="form-label">Import Inv & Date</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
              </div>
              <div class="mb-3">
                  <label for="defaultInput" class="form-label">Import BL No. & Date</label>
                  <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
              </div>
            <div class="mb-3">
              <label for="defaultSelect" class="form-label">Unit of Measurement</label>
              <select id="defaultSelect" class="form-select">
                <option>select...</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <!-- Third tab Other Information -->
      <div class="col-xl-6">
        <div class="card mb-4">
          <h5 class="card-header">Other Information</h5>
          <div class="card-body">                        
            <div class="mb-3">
              <label for="defaultInput" class="form-label">Marks & Numbers</label>
              <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
            </div>
            <div class="mb-3">
              <label for="defaultInput" class="form-label">Documentary</label>
              <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
            </div>
            <div class="mb-3">
              <label for="defaultInput" class="form-label">Credit No.</label>
              <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
            </div>
            <div class="mb-3">
              <label for="defaultInput" class="form-label">Contract No.</label>
              <input id="defaultInput" class="form-control" type="text" placeholder="write...." />
            </div>
          </div>
          </div>
        <div class="card-body">
         <div class="row gy-3">
       </div>
      </div>
    </div>

    <!--Fourth tab Other Information  -->
      <div class="col-xl-6">
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
              <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
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
          </div>
        </div> 
      </div>
    </div>
  </div>
    @endsection

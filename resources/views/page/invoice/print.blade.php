<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Table new </title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        /* background-color: #F1F2F3; */
    }

    .invoice-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: 3px solid #ddd;
        /* box-shadow:
            inset 0 -3em 3em rgba(0, 0, 0, 0.1),
            0 0 0 2px rgb(255, 255, 255),
            0.3em 0.3em 1em rgba(0, 0, 0, 0.3); */
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #111;
        padding: 8px;
    }

    .invoice-table th {
        background-color: #D3D3D3;
    }

    .total-label {
        text-align: right;
        font-weight: bold;
    }

    .total-amount {
        font-weight: bold;
        color: #000000;
    }
</style>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2 style="text-decoration: underline;">INVOICE</h2>
            <p style="text-align: left;">
                <span style=" width: 50%; text-transform: capitalize; font-weight: 700;">
                    Invoice No:
                    {{$invoice->invoice_id}}</span>
            </p>
            <p style="text-align: right;"><span style=" width: 50%; text-transform: capitalize; font-weight: 700;">Date:
                    {{date('Y-m-d',strtotime($invoice->created_at))}}</span></p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">Invoice Of</span>
                : {{strtoupper($invoice->name)}}</p>
            <p style="text-align: left;"><span style="text-transform: capitalize; font-weight: 600;">Shipped /
                    Dispatched in Good Order and Condition vide B/L No. {{$invoice->bl_no}}
                    Dated {{date('d M Y',strtotime($invoice->created_at))}}</span></p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">From</span> :
                {{$invoice->port_loading}}</p>
                <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">To</span> :
                    {{$invoice->port_discharge}} - on account and risk of</p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">M/S</span> :
               {{$invoice->buyer_name}} , {{$invoice->address}}
            </p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Marks & No.</th>
                    <th>Description</th>
                    {{-- <th>Packages</th> --}}
                    <th>Rate USD</th>
                    <th>Total Amount USD</th>
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>As Per B/L</td>
                    <td>22.420 M/Tons of GALVALUME DROSS at the rate of 1280.00 per M/Ton CIF Port Klang, Malaysia</td>
                    <td>120 PIECES</td>
                    <td>1280.00</td>
                    <td>28,697.60</td>
                </tr> --}}
                <tr>
                    <td></td>
                    <td>{{$invoice->net_weight}} M/Tons of {{strtoupper($invoice->name)}} at the rate of {{$invoice->rate}} per M/Ton {{$invoice->incoterms}}</td>
                    {{-- <td>{{$invoice->packs}} PIECES</td> --}}
                    <td>{{number_format($invoice->rate,3)}}</td>
                    <td>{{number_format($invoice->net_weight * $invoice->rate,3)}}</td>
                </tr>
                <tr>
                    <td>As Per B/L</td>
                    <td></td>
                    {{-- <td>{{$invoice->packs}} PIECES</td> --}}
                    <td></td>
                    <td></td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total-label">Total</td>
                    <td class="total-amount">{{number_format($invoice->net_weight * $invoice->rate,3)}}</td>
                </tr>
            </tfoot>
        </table>
        <div class="invoice-header">
            <p style="text-align: right;"><span style=" text-transform: capitalize; font-weight: 700;"> USD 
                    {{ strtoupper($invoice->text) }}</span></p>
        </div>
        <div class="invoice-header">
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">BANK
                    DETAILS:</span></p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Bank
                    Name & Address</span> : {{ $invoice->bank_name }}, {{ $invoice->bank_address }}
            </p>
            <p style="text-align:left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Beneficiary
                    Name</span> : {{ $invoice->company_name }}
            </p>

            <p style="text-align:left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Account
                    Number</span> : {{ $invoice->account_no }}
            </p>

            <p style="text-align:left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Swift</span>
                : {{ $invoice->swift_code }}
            </p>
            <p style="text-align:left;"><span
                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">IFSC</span>
            : {{ $invoice->ifsc }}
        </p>
            </
        </div>
    </div>

    <!-- PACKING LIST section start -->

    <div class="invoice-container">
        <div class="invoice-header">
            <h2 style="text-decoration: underline;">PACKING LIST</h2>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">Invoice No:
                {{$invoice->invoice_id}}</span></p>
            <p style="text-align: right;"><span style="text-transform: capitalize; font-weight: 700;">Date:
                {{date('Y-m-d',strtotime($invoice->created_at))}}</span></p>
            <p style="text-align: center;"><span style=" text-transform: capitalize; font-weight: 500;">The Following
                    Items are loaded as per our Invoice No.  {{$invoice->invoice_id}} Dated   {{date('d M Y',strtotime($invoice->created_at))}}.</span>
            </p>
            <p> <span style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Details are as
                    under:</p>
                    <p style="text-align: left;"><span
                        style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">MARKS AND
                        NUMBERS</span>. {{ $invoice->mark }}</p>
                        <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">CONTAINER
                            NO./SEAL
                            NO.</span> :
                        @foreach($invoice['container'] as $key => $obj)
                            {{ $obj['container_no'] }} / {{ $obj['seal_no'] }} ,
                        @endforeach
                    </p>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Gross Weight {{strtoupper($invoice->unit_measure)}}</th>
                    <th>Net Weight {{strtoupper($invoice->unit_measure)}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">{{$invoice->name}}</td>
                    <td style="text-align: center;">{{number_format($invoice->gross_weight,3)}}</td>
                    <td style="text-align: center;">{{number_format($invoice->net_weight,3)}}</td>
                </tr>
            </tbody>
        </table>
        <div class="invoice-header">
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Total Net
                    Weight</span> : {{number_format($invoice->net_weight,3)}} {{strtoupper($invoice->unit_measure)}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Total Gross
                    Weight</span> : {{number_format($invoice->gross_weight,3)}} {{strtoupper($invoice->unit_measure)}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Packages</span> :
                    {{$invoice->packs}} {{ $invoice->packageType }}</p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">SHIPPED ON BOARD
                    ON VESSEL VIDE B/L NO. {{$invoice->bl_no}} Dated {{$invoice->bl_date}}</span></p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Loaded on Account
                    of</span> :   {{$invoice->buyer_name}} , {{$invoice->address}}
            </p>
        </div>
    </div>

    <!-- CERTIFICATE OF ORIGIN SECTION START  -->

    <div class="invoice-container">
        <div class="invoice-header">
            <h2 style="text-decoration: underline;">CERTIFICATE OF ORIGIN</h2>
            <p style="text-align: left; font-weight: 700;">Invoice No:    {{$invoice->invoice_id}}</p>
            <p style="text-align: right; font-weight: 700;">Date:     {{date('Y-m-d',strtotime($invoice->created_at))}}</p>
        </div>

        <div class="invoice-header">
            <p style="text-align: left;">We hereby certify and declare that <span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">{{$invoice->name}}
                    </span>
                supplied to
                <span style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">  {{$invoice->buyer_name}} , {{$invoice->address}}</span> against our Invoice No.
                <span style="text-decoration: underline; text-transform: capitalize; font-weight: 700;"> {{$invoice->invoice_id}}</span>
                Dated
                <span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">     {{date('Y-m-d',strtotime($invoice->created_at))}}</span>
                is of
                {{$invoice->origin}} origin.
            </p>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Table new 2</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    .invoice-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        border: 3px solid #ddd;
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
        text-align: left;
        font-weight: bold;
    }

    .total-amount {
        font-weight: bold;
        color: #cc0000;
    }
</style>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <h2 style="text-decoration: underline;">COMMERCIAL INVOICE</h2>
            <p style="text-align: left;">
                <span: style=" width: 50%; text-transform: capitalize; font-weight: 700;">
                    Invoice No:
                    {{$invoice->invoice_id}}</span:>
            </p>
            <p style="text-align: right;"><span style=" width: 50%; text-transform: capitalize; font-weight: 700;">Date:
                {{date('Y-m-d',strtotime($invoice->created_at))}}</span></p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;"> {{$invoice->buyer_name}} , {{$invoice->address}}</span></p>

        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>DESCRIPTION OF GOODS </th>
                    <th>QTY  {{strtoupper($invoice->unit_measure)}}</th>
                    <th>U/PRICE USD</th>
                    <th>Total VALUE USD</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$invoice->name}}</td>
                    <td>{{$invoice->net_weight}}</td>
                    <td>{{$invoice->rate}}</td>
                    <td>{{$invoice->net_weight * $invoice->rate}}</td>
                </tr>
               
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="total-label">TOTAL {{$invoice->incoterms}}</td>
                    <td class="total-amount">{{$invoice->net_weight * $invoice->rate}}</td>
                </tr>

                <tr>
                    <td colspan="4" class="total-label">FREIGHT USD</td>
                    <td class="total-amount">{{$invoice->freight}}</td>
                </tr>

                <tr>
                    <td colspan="4" class="total-label">FOB  {{strtoupper($invoice->port_loading)}}</td>
                    <td class="total-amount">{{($invoice->net_weight * $invoice->rate) - $invoice->freight }}</td>
                </tr>

                <tr>
                    <td colspan="4" class="total-label">TOTAL VALUE {{$invoice->incoterms}}
                    </td>
                    <td class="total-amount">{{$invoice->net_weight * $invoice->rate}}</td>
                </tr>
            </tfoot>
        </table>
        <div class="invoice-header">
            <p style="text-align: right;"><span style=" text-transform: capitalize; font-weight: 700;">USD: FIFTY EIGHT
                    THOUSAND NINE HUNDRED SIXTY ONLY.</span></p>
        </div>
        <div class="invoice-header">
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">H.S.CODE</span> :
               {{$invoice->hs_code}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PORT OF
                    LOADING</span> :  {{$invoice->port_loading}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PORT OF
                    DISCHARGE</span> :  {{$invoice->port_discharge}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PARTICULARS OF
                    GOODS</span> :
                    {{$invoice->name}} </p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">NET
                            WEIGHT</span>
                        :
                        {{$invoice->net_weight}} {{strtoupper($invoice->unit_measure)}} </p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">GROSS
                            WEIGHT</span> :
                       {{$invoice->gross_weight}} {{strtoupper($invoice->unit_measure)}} </p>
                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PACKAGE</span>
                        :
                        1X20’ CNTR.</p>
                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">QUANTITY</span>
                        :
                        {{$invoice->packs}} BLOCKS</p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">CONTAINER
                            NO./SEAL
                            NO.</span> :
                        {{$invoice->container_no}} / {{$invoice->seal_no}}</p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">TOTAL
                            VALUE</span>
                        :{{$invoice->net_weight * $invoice->rate}}</p>
                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">ORIGIN OF
                            GOODS</span>
                        :
                        {{$invoice->origin}}</p>
                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">MARKS &
                            NO.</span>
                        :
                        {{$invoice->origin}}</p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">DOCUMENTARY
                            CREDIT
                            NO.</span>
                        :
                        {{$invoice->doc_credit_no}} DATE {{date('M d Y' ,strtotime($invoice->doc_credit_no_date))}}
                    </p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">CONTRACT
                            NO.</span>
                        :
                        {{$invoice->contract_no}} DATE {{date('M d Y' ,strtotime($invoice->contract_no_date))}}
                    </p>

                    <p style="text-align: left;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">BILL OF
                            LADING
                            NO.</span> : {{$invoice->bl_no}}
                    </p>
                    <hr>

                    <div class="invoice-header">
                        <p style="text-align: center;"><span style=" text-transform: capitalize; font-weight: 700;">BANK
                                DETAILS:</span></p>

                        <p style="text-align: center;"><span
                                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Bank
                                Name & Address</span> : {{$invoice->bank_name}}, {{$invoice->bank_address}}
                        </p>
                        <p style="text-align: center;"><span
                                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Beneficiary
                                Name</span> : {{$invoice->company_name}}
                        </p>

                        <p style="text-align: center;"><span
                                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Account
                                Number</span> : {{$invoice->account_no}}
                        </p>

                        <p style="text-align: center;"><span
                                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Swift</span>
                            : {{$invoice->swift_code}}
                        </p>
                    </div>
                    <hr>
                    <p style="text-align: center;"><span
                            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;"></span>
                        We certify that this invoice is true and correct and is in accordance with our books.
                    </p>
                    <hr>
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
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">SHIPPER:
                 
                </span>   {{$invoice->company_name}} {{$invoice->trading_address}}
            </p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;">APPLICANT:
              
            </span>  {{$invoice->buyer_name}} , {{$invoice->address}}
        </p>
         
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>DESCRIPTION OF GOODS </th>
                    <th>QTY  {{strtoupper($invoice->unit_measure)}}</th>
                    <th>GROSS WEIGHT</th>
                    <th>PACKAGE</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$invoice->name}}</td>
                    <td>{{$invoice->net_weight}}</td>
                    <td>{{$invoice->rate}}</td>
                    <td>{{$invoice->packs}}</td>
                </tr>
               
            </tbody>
        </table>
        <div class="invoice-header">

            <p style="text-align: left;"><span
                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">MARKS AND NUMBERS</span>. {{$invoice->mark}}</p>
            <p style="text-align: left;"><span
                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Container
                No</span>. {{$invoice->container_no}}</p>
        <p style="text-align: left;"><span
                style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">Seal No</span>.
            {{$invoice->seal_no}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">FINAL
                    DESTINATION</span> :
              {{$invoice->port_discharge}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">VESSEL NAME</span>
                :
                {{$invoice->vessel_name}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">DOCUMENTARY CREDIT
                    NO.</span> :
                    {{$invoice->doc_credit_no}} DATE {{date('M d Y' ,strtotime($invoice->doc_credit_no_date))}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">
                    BILL OF LADING NO.
                </span> :
                {{$invoice->bl_no}}</p>
            <hr>
            <p style="text-align: center;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;"></span>
                We hereby certify that the details contained in this packing list are true and correct.

            </p>
            <hr>
        </div>
    </div>

    <!-- CERTIFICATE OF ORIGIN SECTION START  -->

    <div class="invoice-container">
        <div class="invoice-header">
            <h2 style="text-decoration: underline;">CERTIFICATE OF ORIGIN</h2>
            <p style="text-align: left; font-weight: 700;">Invoice No: {{$invoice->invoice_id}}</p>
            <p style="text-align: right; font-weight: 700;">Date: {{date('Y-m-d',strtotime($invoice->created_at))}}</p>
        </div>

        <div class="invoice-header">
            <p style="text-align: center; text-decoration: underline;"><span
                    style=" text-transform: capitalize; font-weight: 700;">APPLICANT</span>
            </p>
            <p style="text-align: left;"><span style=" text-transform: capitalize; font-weight: 700;"> {{$invoice->buyer_name}} , {{$invoice->address}}</span></p>
          
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ITEM</th>
                    <th>DESCRIPTION OF GOODS</th>
                    <th>QTY {{strtoupper($invoice->unit_measure)}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td style="text-align: center;"> {{$invoice->name}}</td>
                    <td style="text-align: center;">{{$invoice->net_weight}}</td>
                </tr>
            </tbody>
        </table>

        <p style="text-align: left;"><span
            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">H.S.CODE</span> :
       {{$invoice->hs_code}}</p>
    <p style="text-align: left;"><span
            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PORT OF
            LOADING</span> :  {{$invoice->port_loading}}</p>
    <p style="text-align: left;"><span
            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PORT OF
            DISCHARGE</span> :  {{$invoice->port_discharge}}</p>
    <p style="text-align: left;"><span
            style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PARTICULARS OF
            GOODS</span> :
            {{$invoice->name}} </p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">NET
                    WEIGHT</span>
                :
                {{$invoice->net_weight}} {{strtoupper($invoice->unit_measure)}} </p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">GROSS
                    WEIGHT</span> :
               {{$invoice->gross_weight}} {{strtoupper($invoice->unit_measure)}} </p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">PACKAGE</span>
                :
                1X20’ CNTR.</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">QUANTITY</span>
                :
                {{$invoice->packs}} BLOCKS</p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">CONTAINER
                    NO./SEAL
                    NO.</span> :
                {{$invoice->container_no}} / {{$invoice->seal_no}}</p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">TOTAL
                    VALUE</span>
                :{{$invoice->net_weight * $invoice->rate}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">ORIGIN OF
                    GOODS</span>
                :
                {{$invoice->origin}}</p>
            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">MARKS &
                    NO.</span>
                :
                {{$invoice->origin}}</p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">DOCUMENTARY
                    CREDIT
                    NO.</span>
                :
                {{$invoice->doc_credit_no}} DATE {{date('M d Y' ,strtotime($invoice->doc_credit_no_date))}}
            </p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">CONTRACT
                    NO.</span>
                :
                {{$invoice->contract_no}} DATE {{date('M d Y' ,strtotime($invoice->contract_no_date))}}
            </p>

            <p style="text-align: left;"><span
                    style="text-decoration: underline; text-transform: capitalize; font-weight: 700;">BILL OF
                    LADING
                    NO.</span> : {{$invoice->bl_no}}
            </p>
                <hr>
                <p style="text-align: center;"><span
                        style="text-decoration: underline; text-transform: capitalize; font-weight: 700;"></span>
                    We certify that above material is of {{$invoice->origin}} Origin.
                </p>
                <hr>
    </div>
</body>

</html>
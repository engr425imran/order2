<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style type="text/css">
        

        html {
            margin: 0px;
            padding: 0px;
            margin-top: 50px;
        }

        table {
            border-collapse: collapse;
        }

        hr {
            color: rgba(0, 0, 0, 0.2);
            border: 0.5px solid #EAF1FB;
        }

        /* -- Header -- */

        .header-container {
            margin-top: -30px;
            width: 100%;
            padding: 0px 30px;
        }
        .header-logo {
            height: 50px;
            text-transform: capitalize;
            color: #817AE3;
            padding-top: 0px;
        }
        .company-address-container {
            width: 50%;
            text-transform: capitalize;
            padding-left: 80px;
            margin-bottom: 2px;
        }
        .company-address {
            margin-top: 12px;
            font-size: 14px;
            line-height: 15px;
            color: #595959;
            word-wrap: break-word;
        }

        /* -- Content Wrapper  */

        .content-wrapper {
            display: block;
            padding-top: 0px;
            padding-bottom: 20px;
        }

        .customer-address-container {
            display: block;
            float: left;
            width: 45%;
            padding: 10px 0 0 30px;
        }

        /* -- Shipping -- */
        .shipping-address-container {
            float:right;
            display: block;
        }

        .shipping-address-container--left {
            float:left;
            display: block;
            padding-left: 0;
        }

        .shipping-address {
            font-size: 14px;
            line-height: 15px;
            color: #595959;
            margin-top: 5px;
            width: 160px;
            word-wrap: break-word;
        }

        /* -- Billing -- */

        .billing-address-container {
            display: block;
            float: left;
        }

        .billing-address {
            font-size: 14px;
            line-height: 15px;
            color: #595959;
            margin-top: 5px;
            width: 160px;
            word-wrap: break-word;
        }

        /*  -- Estimate Details -- */

        .invoice-details-container {
            display: block;
            float: right;
            padding: 10px 30px 0 0;
        }

        .attribute-label {
            font-size: 14px;
            line-height: 18px;
            text-align: left;
            color: #55547A
        }

        .attribute-value {
            font-size: 14px;
            line-height: 18px;
            text-align: right;
        }

        /* -- Items Table -- */

        .items-table {
            margin-top: 35px;
            padding: 0px 30px 10px 30px;
            page-break-before: avoid;
            page-break-after: auto;
            border-bottom: 2px solid #f1f1f1;
        }

        .items-table hr {
            height: 0.1px;
        }
        .modal .modal-dialog .modal-content .modal-header{
            padding: 28px;
        }
        .modal-content{
            background-color: #ffffff;
        }

        .item-table-heading {
            font-size: 13.5;
            text-align: center;
            color: rgba(0, 0, 0, 0.85);
            padding: 5px;
            color: #55547A;
        }

        tr.item-table-heading-row th {
            border-bottom: 0.620315px solid #E8E8E8;
            font-size: 14px;
            line-height: 18px;
        }

        tr.item-row td {
            font-size: 14px;
            line-height: 18px;
        }

        .item-cell {
            font-size: 13;
            text-align: center;
            padding: 5px;
            padding-top: 10px;
            color: #040405;
        }

        .item-description {
            color: #595959;
            font-size: 14px;
            line-height: 12px;
        }

        .item-cell-table-hr {
            margin: 0 30px 0 30px;
        }

        /* -- Total Display Table -- */


        .total-display-table {
            border-top: none;
            box-sizing: border-box;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            border: 1px solid #d9dee5;
            border-top: none;
            float: right;
        }

        .total-table-attribute-label {
            font-size: 14px;
            color: #55547A;
            text-align: right;
            padding-left: 10px;
        }

        .total-table-attribute-value {
            font-weight: bold;
            text-align: right;
            font-size: 14px;
            color: #040405;
            padding-right: 10px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .total-border-left {
            border: 1px solid #E8E8E8 !important;
            border-right: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        .total-border-right {
            border: 1px solid #E8E8E8 !important;
            border-left: 0px !important;
            padding-top: 0px;
            padding: 8px !important;
        }

        /* -- Notes -- */
        .notes {
            font-size: 14px;
            color: #595959;
            margin-top: 15px;
            margin-left: 30px;
            width: 442px;
            text-align: left;
            page-break-inside: avoid;
        }

        .notes-label {
            font-size: 15px;
            line-height: 22px;
            letter-spacing: 0.05em;
            color: #040405;
            width: 108px;
            height: 19.87px;
            padding-bottom: 10px;
        }

         /* -- Helpers -- */

        .text-primary {
            color: #5851DB;
        }

        .text-center {
            text-align: center
        }

        table .text-left {
            text-align: left;
        }

        table .text-right {
            text-align: right;
        }

        .border-0 {
            border: none;
        }

        .py-1 {
            padding-top: 1px;
            padding-bottom: 1px;
        }

        .py-8 {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .py-3 {
            padding: 3px 0;
        }

        .pr-20 {
            padding-right: 20px;
        }

        .pr-10 {
            padding-right: 10px;
        }

        .pl-20 {
            padding-left: 20px;
        }

        .pl-10 {
            padding-left: 10px;
        }

        .pl-0 {
            padding-left: 0;
        }
        
        .tax h3 {
            font-size: 26px;
        }
    </style>
</head>

<body>
    <div class="header-container">
         <div class="tax">
            <h3>
            @if($inv->status != 3) Pro Forma Invoice @else Tax Invoice @endif</h3>
        </div>
        <table width="100%">
            <tr>
                <td width="50%" class="header-section-left">
                    @if (isset($com_info))
                        @if($com_info->com_logo)
                            <img class="header-logo" src="{{ url($com_info->com_logo) }}" alt="Company Logo">
                        @else
                            @if($com_info->display_name)
                                <h2 class="header-logo"> {{$com_info->display_name}} </h2>
                            @endif
                        @endif
                    @endif
                </td>
                <td width="50%" class="company-address-container company-address text-right">
                    <h3>{{$com_info->display_name ?? ''}}</h3>
                    @if(isset($com_info) and $com_info->vat_no)<p>VAT No: {{$com_info->vat_no}}</p>@endif
                    @if(isset($com_info) and $com_info->business_reg_number)<p>Registration No: {{$com_info->business_reg_number}}</p>@endif
                    @if(isset($com_info) and $com_info->postal_city != '' or $com_info->postal_stase != '')
                        <label>Postal Address</label>
                        <p>
                        {!! $com_info->postal_address. ' ' .  $com_info->postal_city.' '.$com_info->postal_stase .' '.$com_info->postal_code !!}</p>
                    @endif
                    <br>
                    @if(isset($com_info) and $com_info->phy_city != '' or $com_info->phy_stase != '')
                        <label>Physical Address</label>
                        <p>
                            {!! $com_info->phy_address. ' ' .  $com_info->phy_city.' '.$com_info->phy_stase .' '.$com_info->phy_code!!}
                        </p>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <hr class="header-bottom-divider">

    <div class="content-wrapper">
        <div class="main-content">
            <div class="customer-address-container">
                <div class="customer-details-container-1">
                    <h5>To,</h5>
                    <h3>{{ $customer->company ?? '' }}</h3>
                    @if($customer->vat_reg_no)<p>VAT No: {{$customer->vat_reg_no ?? ''}}</p>@endif
                    <label>Postal Address</label>
                    <p>
                    {!! $customer->b_street.', '. $customer->b_city.', '.$customer->b_state .', '.$customer->b_postal .' '.$customer->b_country !!}</p>

                    <label>Physical Address</label>
                    <p>
                     {!! $customer->c_street.', '. $customer->c_city.', '.$customer->c_state .', '.$customer->c_postal .' '.$customer->c_country !!}</p>
                </div>
                <div style="clear: both;"></div>
            </div>
                <div class="invoice-details-container">
                    <table>
                        <tr>
                            <td class="attribute-label">Invoice Number</td>
                            <td class="attribute-value"> &nbsp;{{$invs->inv_name}}-{{$inv->invoice_code}}</td>
                        </tr>
                        <tr>
                            <td class="attribute-label">Invoice Date</td>
                            <td class="attribute-value"> &nbsp;{{$inv->invoice_date}}</td>
                        </tr>
                        <tr>
                            <td class="attribute-label">Due Date</td>
                            <td class="attribute-value"> &nbsp;{{$inv->due_date}}</td>
                        </tr>
                        @if($inv->reference)
                        <tr>
                            <td class="attribute-label">Reference</td>
                            <td class="attribute-value"> &nbsp;{{$inv->reference}}</td>
                        </tr>
                        @endif

                        @if($salesrep)
                            <tr>
                                <td class="attribute-label">Resp Sales</td>
                                <td class="attribute-value"> &nbsp;{{$salesrep??''}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div style="clear: both;"></div>
                <div class="sales-resp">
                    
                </div>
            </div>
            <div style="position: relative; clear: both;">
                <table width="100%" class="items-table" cellspacing="0" border="0">
                    <tr class="item-table-heading-row">
                        <th width="40%" class="pl-0 text-left item-table-heading">Description</th>
                        <th class="pr-20 text-right item-table-heading">Quantity</th>
                        <th class="pr-20 text-right item-table-heading">Excl. Price</th>
                        <th class="pl-10 text-right item-table-heading">Disc %</th>
                        <th class="pl-10 text-right item-table-heading">Tax</th>
                        <th class="text-right item-table-heading">Amount</th>
                    </tr>
                    @php
                        $index = 1
                    @endphp

                    @foreach ($inv_details as $item) 
                        <tr class="item-row">
                           
                            <td
                                class="pl-0 text-left item-cell"
                                style="vertical-align: top;"
                            >
                                <span class="item-description">{!! nl2br(htmlspecialchars($item->id_description)) !!}</span>
                            </td>
                            <td
                                class="pr-20 text-right item-cell"
                                style="vertical-align: top;"
                            >
                                {{$item->id_quantity}}
                            </td>
                            <td
                                class="pr-20 text-right item-cell"
                                style="vertical-align: top;"
                            >
                                {!! number_format($item->id_rate, 2) !!}
                            </td>
                            <td
                                class="pl-10 text-right item-cell"
                                style="vertical-align: top;"
                            >
                                {!! $item->id_discount !!}
                            </td>
                            <td
                                class="text-right item-cell"
                                style="vertical-align: top;"
                            >
                                {!! $item->tax_name!!}
                            </td>
                            <td
                                class="text-right item-cell"
                                style="vertical-align: top;"
                            >
                                {!! $item->id_amount !!}
                            </td>
                        </tr>
                        @php
                            $index += 1
                        @endphp
                    @endforeach
                </table>

                <div class="total-display-container">
                    <table width="29%" cellspacing="0px" border="0" class="total-display-table">
                        <tr>
                            <td class="border-0 total-table-attribute-label">Total Exclusive</td>
                            <td class="py-1 border-0 item-cell total-table-attribute-value">
                                {!! number_format($inv->sub_total, 2) !!}
                            </td>
                        </tr>

                        <tr>
                            <td class="border-0 total-table-attribute-label">
                                Total VAT
                            </td>
                            <td class="border-0 item-cell total-table-attribute-value">
                                {!! number_format($t_tax, 2) !!}
                            </td>
                        </tr>

                        
                        <tr>
                            <td class="border-0 py-2 total-table-attribute-label">
                                Grand Total
                            </td>
                            <td
                                class="py-8 border-0 item-cell total-table-attribute-value"
                                style="color: #5851D8"
                            >
                                {!! number_format( $inv->final_total?? '', 2) !!}
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div style="position: relative; clear: both; margin-top: 20px" class="invoice-note">
            <label>Invoice Note:</label>
            <p>{{$inv->invoice_note ?? $invs->note ?? ''}}</p>
        </div>
        </div>
    </div>
</body>

</html>

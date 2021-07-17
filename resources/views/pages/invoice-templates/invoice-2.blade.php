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
            margin: 0 30px 0 30px;
            color: rgba(0, 0, 0, 0.2);
            border: 0.5px solid #EAF1FB;
        }

        /* -- Header -- */

        .header-container {
            background: linear-gradient(88deg, #1345b7, #05bdfd);
            position: absolute;
            width: 100%;
            height: 141px;
            left: 0px;
            top: -60px;
        }

        .header-section-left {
            padding-top: 45px;
            padding-bottom: 45px;
            padding-left: 30px;
            display: inline-block;
            width: 30%;
        }

        .header-logo {
            position: absolute;
            height: 50px;
            text-transform: capitalize;
            color: #fff;
        }

        .header-section-right {
            display: inline-block;
            width: 35%;
            float: right;
            padding: 20px 30px 20px 0px;
            text-align: right;
            color: white;
        }

        .header {
            font-size: 20px;
            color: rgba(0, 0, 0, 0.7);
        }

        /*  -- Estimate Details -- */

        .invoice-details-container {
            text-align: center;
            width: 40%;
        }

        .invoice-details-container h1 {
            margin-top: 12px;
            font-size: 28px;
            line-height: 36px;
            text-align: right;
        }

        .invoice-details-container h4 {
            margin: 0;
            font-size: 13px;
            line-height: 15px;
            text-align: right;
        }

        .invoice-details-container h3 {
            margin-bottom: 1px;
            margin-top: 0;
        }

        /* -- Content Wrapper -- */

        .content-wrapper {
            display: block;
            margin-top: 60px;
            padding-bottom: 20px;
        }

        .address-container {
            display: block;
            padding-top: 20px;
            margin-top: 18px;
        }

        /* -- Company -- */

        .company-address-container {
            padding: 0 0 0 30px;
            display: inline;
            float: left;
            width: 30%;
        }

        .company-address-container h1 {
            font-weight: bold;
            font-size: 15px;
            letter-spacing: 0.05em;
            margin-bottom: 0;
            /* margin-top: 18px; */
        }

        .company-address{
            font-size: 10px;
            line-height: 15px;
            color: #595959;
            margin-top: 0px;
            word-wrap: break-word;
        }

        /* -- Billing -- */

        .billing-address-container {
            display: block;
            /* position: absolute; */
            float: right;
            padding: 0 40px 0 0;
        }

        .billing-address-label {
            font-size: 13px;
            line-height: 18px;
            padding: 0px;
            margin-bottom: 0px;
        }

        .billing-address-name {
            max-width: 250px;
            font-size: 15px;
            line-height: 22px;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .billing-address{
            font-size: 13px;
            line-height: 15px;
            color: #595959;
            padding: 0px;
            margin: 0px;
            width: 170px;
            word-wrap: break-word;
        }

        /* -- Shipping -- */

        .shipping-address-container {
            display: block;
            float: right;
            padding: 0 30px 0 0;
        }

        .shipping-address-label {
            font-size: 13px;
            line-height: 18px;
            padding: 0px;
            margin-bottom: 0px;
        }

        .shipping-address-name {
            max-width: 250px;
            font-size: 15px;
            line-height: 22px;
            padding: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        .shipping-address {
            font-size: 13px;
            line-height: 15px;
            color: #595959;
            padding: 0px 30px 0px 30px;
            width: 300px;
            word-wrap: break-word;
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

        .item-table-heading {
            font-size: 13.5;
            text-align: center;
            color: rgba(0, 0, 0, 0.85);
            padding: 5px;
            color: #55547A;
        }

        tr.item-table-heading-row th {
            border-bottom: 0.620315px solid #E8E8E8;
            font-size: 15px;
            line-height: 18px;
        }

        tr.item-row td {
            font-size: 15px;
            line-height: 18px;
        }

        .item-cell {
            font-size: 15px;
            text-align: center;
            padding: 5px;
            padding-top: 10px;
            color: #040405;
        }

        .item-description {
            color: #595959;
            font-size: 13px;
            line-height: 12px;
        }

        /* -- Total Display Table -- */

       

        .item-cell-table-hr {
            margin: 0 25px 0 30px;
        }
        .modal .modal-dialog .modal-content .modal-header{
            padding: 28px;
        }

        .total-display-table {
            box-sizing: border-box;
            page-break-inside: avoid;
            page-break-before: auto;
            page-break-after: auto;
            border: 1px solid #d9dee5;
            border-top: none;
            float: right;
        }
        .modal-content{
            background-color: #ffffff;
        }

        .total-table-attribute-label {
            font-size: 13px;
            color: #55547A;
            padding-left: 10px;
            font-weight: 600;
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
            font-size: 13px;
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

        .py-2 {
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
    </style>
</head>

<body>
    <div class="header-container">
        <table width="100%">
            <tr>
                @if(isset($com_info))
                    @if($com_info->com_logo)
                        <td width="60%" class="header-section-left">
                            <img class="header-logo" src="{{ url($com_info->com_logo) }}" alt="Company Logo">
                        </td>
                    @else
                        <td width="60%" class="header-section-left" style="padding-top: 0px;">
                                @if($com_info->display_name)
                                <h1 class="header-logo"> {{$com_info->display_name}} </h1>
                                @endif
                        </td>
                    @endif
                @endif
                <td width="40%" class="header-section-right invoice-details-container">
                    <h1>@if($inv->status != 3) Pro Forma invoice @else Tax Invoice @endif</h1>
                    <h4>{{$invs->inv_name}}-{{$inv->invoice_code}}</h4>
                    <h4>{{$inv->invoice_date}}</h4>
                    @if($inv->reference)<h4>Reference: {{$inv->reference}}</h4>@endif
                    @if($inv->reference)<h4>Sales Rep: {{$salesrep??''}}</h4>@endif
                </td>

            </tr>
        </table>
    </div>
    <hr>
    <div class="content-wrapper">
        <div class="address-container">
            <div class="company-address-container company-address">
                <h3>{{$com_info->display_name ?? ''}}</h3>
                @if(isset($com_info) and $com_info->vat_no)
                    <p>VAT No: {{$com_info->vat_no}}</p>
                @endif
                @if(isset($com_info) and $com_info->business_reg_number)
                    <p>Registration No: {{$com_info->business_reg_number}}</p>
                @endif
                @if(isset($com_info) and $com_info->postal_city != '' or $com_info->postal_stase != '' or $com_info->postal_country != '')
                    <label>Postal Address</label>
                    <p>
                    {!! $com_info->postal_address. ' ' .  $com_info->postal_city.' '.$com_info->postal_stase .' '.$com_info->postal_code !!}</p>
                @endif
                <br>
                @if(isset($com_info) and $com_info->phy_city != '' or $com_info->phy_stase != '')
                    <label>Physical Address</label>
                    <p>
                        {!! $com_info->phy_address. ' '.  $com_info->phy_city.' '.$com_info->phy_stase .' '.$com_info->phy_code !!}
                    </p>
                @endif
            </div>
            <div class="shipping-address-container shipping-address">
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
                            {!! number_format( $inv->final_total, 2) !!}
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
</body>

</html>

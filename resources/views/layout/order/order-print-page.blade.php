<?php header('content-type: text/html; charset=UTF-8;'); ?>

<style type="text/css" media="print">
    @page {
        size: auto;   /* auto is the initial value */
        margin: 0;  /* this affects the margin in the printer settings */
        align:"center";
    }
</style>

<style type="text/css">
    table {
        border-collapse: collapse;
        font-family: arial;
        font-size: 13px;
        width: 600px;
        align:"center";
    }

    table.main {
        margin: 20px auto 0;
    }

    table.second {
        border: 1px solid #CCC;
        margin-top: 2px;
    }

    table.second td {
        border: 1px solid #CCC;
    }

    td.head {
        font-weight: bold;
        text-align: right;
    }

    td.head1 {
        background: #EFEFEF;
        font-weight: bold;
        text-align: center;
    }

    img.logo {

        width: 250px;
        /*margin-right: -2px;*/
        display: block;
        margin: 0 auto;
    }

    td.add {
        font-size: 11px;
        padding-bottom: 30px;
        text-align: center;
    }
</style>
<body onload="window.print();">
<div id="container">
    <?php ?>
        <img class="logo"
             src="{{URL::asset('dashboard-layout/images/bg-logo.png')}}"/>
        Order Date: {{$create_date}} <br>
        Order Id : {{$order_id}} <br>
        Customer Name : {{$customer_name}} <br> <br><br>
{{--    <table class="main"  style="    line-height: 2;--}}
{{--    font-size: 13px;" >--}}

{{--        <tr style="font-size: 14px;">--}}
{{--            <td class="head">--}}

{{--            </td>--}}
{{--        </tr>--}}
{{--        <tr style="font-size: 15px;">--}}
{{--            <td class="head">--}}
{{--                --}}{{--                style=" width: 208px;"--}}



{{--            </td>--}}
{{--            <td class="head">--}}
{{--                --}}{{--                style=" width: 208px;"--}}



{{--            </td>--}}
{{--        </tr>--}}
{{--    </table>--}}
    <table border="1">
        <tr>
            <th>id</th>
            <th>Item Name</th>
            <th>Item count</th>
            <th>Components</th>
        </tr>
        <?php $i = 0?>
        @foreach($items as $item)
            <tr>
                <td style="text-align:center" >{{++$i}}</td>
                <td style="text-align:center" colrow="{{count($item->component)}}">{{$item->item_name_en}}</td>
                <td style="text-align:center" colrow="{{count($item->component)}}">{{$item->item_count}}</td>
                <td  style="text-align:center" >
                    @foreach($item->component as $com)
                   {{$com->component_name_en}} <br>
                @endforeach
                </td>
            </tr>
        @endforeach

    </table>

<br><br>
        Customer Note: {{$customer_note}} <br>
        Restaurant Note: {{$rest_note}} <br>
        Location: {{$location}} <br>
        Cost : {{$cost}} <br> <br><br>
</div>

</body>

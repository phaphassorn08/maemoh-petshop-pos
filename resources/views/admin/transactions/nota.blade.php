<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <?php
    $style = '
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 3px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm 
    ';
    ?>
    <?php 
    $style .= 
        ! empty($_COOKIE['innerHeight'])
            ? $_COOKIE['innerHeight'] .'mm; }'
            : '}';
    ?>
    <?php
    $style .= '
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    ';
    ?>

    {!! $style !!}
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: absolute; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        <h4 style="margin-bottom: 5px;">ร้านอาหารสัตว์แม่เมาะเพ็ทช็อป</h4>
        <p>288/1 หมู่7 ตำบลแม่เมาะ อำเภอแม่เมาะ จังหวัดลำปาง 52220</p>
        <p class="text-center">===================================</p>
        <h4 style="margin-bottom: 5px;">ใบเสร็จรับเงิน</h4>
    </div>
    <div>
        <p style="float: left;">วันที่: {{ date('d-m-Y') }}</p>
        <p style="float: right">พนักงานขาย: {{ strtoupper(auth()->user()->name) }}</p>
    </div>
    <div class="clear-both" style="clear: both;"></div>
    <p>เลขที่ใบเสร็จ: {{ $transaction->transaction_code }}</p>
    <p class="text-center">===================================</p>
    
    <table width="100%" style="border: 0;">
        @foreach ($transaction->transaction_details as $transaction_detail)
            <tr>
                <td colspan="3">{{ $transaction_detail->name }}</td>
            </tr>
            <tr>
                <td>{{ $transaction_detail->qty }} x {{ $transaction_detail->base_price }}</td>
                <td></td>
                <td class="text-right">{{ $transaction_detail->qty * $transaction_detail->base_price }}</td>
            </tr>
        @endforeach
    </table>
    <p class="text-center">-----------------------------------</p>

    <table width="100%" style="border: 0;">
        <tr>
            <td>ยอดรวม:</td>
            <td class="text-right">{{ $transaction->total_price }}</td>
        </tr>
        <tr>
            <td>รับเงิน:</td>
            <td class="text-right">{{ $transaction->accept }}</td>
        </tr>
        <tr>
            <td>ทอนเงิน:</td>
            <td class="text-right">{{ $transaction->return }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">-- ขอบคุณที่มาอุดหนุนค่ะ --</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>
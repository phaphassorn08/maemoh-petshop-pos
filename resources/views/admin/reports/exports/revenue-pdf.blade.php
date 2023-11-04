<!DOCTYPE html>
<html lang="th">
<head>
    
    <meta http-equiv="Content-Language" content="th" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>รายงานสรุปยอดขายสินค้า</title>
	<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif; 
			font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Sarabun', sans-serif; 
        }

        table tr td,
        table tr th {
            font-family: 'Sarabun', sans-serif; 
            font-size: 10pt;
            text-align: center;
            border: 1px solid #000;
            padding: 5px;
        } 
             
        h3{
            font-family: 'Sarabun', sans-serif; 
            text-align: center;
        }
        h5{
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>
<body>
    <h3>รายงานสรุปยอดขายสินค้า<br>ร้านอาหารสัตว์แม่เมาะเพ็ทช็อป</h3>
    <hr>
    <h5>ระหว่างวันที่: {{ $startDate }} ถึง {{ $endDate }}</h5>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>วันที่</th>
                <th>รวมยอด</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report['date'] }}</td>
                    <td>{{ number_format($report['revenue'], 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">ไม่พบรายการ</td>
                </tr>
            @endforelse

            @if ($reports)
                <tr>
                    <td colspan="2">รวมเงินทั้งสิ้น</td>
                    <td><strong>{{ number_format($total_revenue, 2) }} บาท</strong></td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>

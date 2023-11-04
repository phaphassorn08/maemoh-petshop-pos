@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="m-0 font-weight-bold text-primary">
                            {{ __('หน้าหลัก') }}
                        </h2>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                ผู้ใช้</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}} ราย</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                จำนวนสินค้า</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$products}} รายการ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                ประวัติการขาย</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$transactions}} รายการ</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-receipt fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                ยอดขาย</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$income}} บาท</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-xl-6 col-sm-12">
                            <div class="card shadow h-100 py-2">
                            <div class="card-body">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">รายได้ประจำวัน</h6>
                            </div>
                                <canvas id="myChart"></canvas>
                            </div>
                            </div>
                        </div>
                        <div class=" col-xl-6 col-sm-12">
                            <div class="card shadow h-100 py-2">
                            <div class="card-body">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">รายได้ประจำเดือน</h6>
                            </div>
                                <canvas id="myBarChart"></canvas>

                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->

<script src="{{asset('public')}}/vendor/chart.js/Chart.min.js"></script>

    <script type="text/javascript">
        var _labels={!! json_encode($labels) !!};
        var _data={!! json_encode($data) !!};

        var _plabels={!! json_encode($plabels) !!};
        var _pdata={!! json_encode($pdata) !!};
    </script>
    <!-- Page level custom scripts -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myChart');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: _labels, // ใส่ข้อมูล labels ที่คุณมี
                    datasets: [{
                        label: 'ยอดขายรายวัน',
                        data: _data, // ใส่ข้อมูลตัวเลขที่คุณมี
                        backgroundColor: 'rgba(54, 162, 235, 0.2', // สีพื้นหลัง
                        borderColor: 'rgba(54, 162, 235, 1)', // สีขอบกราฟ
                        borderWidth: 1
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }, true);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('myBarChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: _plabels,
                    datasets: [{
                        label: 'ยอดขายรายเดือน',
                        data: _pdata,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 145, 45, 0.2)',
                            'rgba(50, 90, 255, 0.2)',
                            'rgba(255, 145, 45, 0.2)',
                            'rgba(255, 145, 45, 0.2)',
                            'rgba(255, 145, 45, 0.2)',
                            'rgba(255, 145, 45, 0.2)',
                            'rgba(255, 145, 45, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 145, 45, 1)',
                            'rgba(50, 90, 255, 1)',
                            'rgba(255, 145, 45, 1)',
                            'rgba(255, 145, 45, 1)',
                            'rgba(255, 145, 45, 1)',
                            'rgba(255, 145, 45, 1)',
                            'rgba(255, 145, 45, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        }, true);
    </script>

    <!-- Page level custom scripts -->
    @endsection

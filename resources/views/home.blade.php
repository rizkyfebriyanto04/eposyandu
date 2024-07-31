@extends('master')

@section('content')
    <div class="row">
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Jumlah Semua<br> Pasien</h6>
                            <h6 class="font-extrabold mb-0">{{ $semuapasien }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon green mb-2">
                                <i class="fas fa-venus"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Jumlah Pasien<br> Perempuan</h6>
                            <h6 class="font-extrabold mb-0">{{ $pasienpr }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="fas fa-mars"></i>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                            <h6 class="text-muted font-semibold">Jumlah Pasien<br> Laki - Laki</h6>
                            <h6 class="font-extrabold mb-0">{{ $pasienlk }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Jumlah Pasien Berdasarkan Jenis Kelamin</h4>
                </div>
                <div class="card-body">
                    <div id="chart-visitors-profile2"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Data dari controller
            var jklakilaki = {{ $pasienlk }};
            var jkperempuan = {{ $pasienpr }};

            var optionsVisitorsProfile = {
                series: [jklakilaki, jkperempuan],
                labels: ["Laki - Laki", "Perempuan"],
                colors: ["#435ebe", "#55c6e8"],
                chart: {
                    type: "donut",
                    width: "100%",
                    height: "350px",
                },
                legend: {
                    position: "bottom",
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "30%",
                        },
                    },
                },
            };

            var chartVisitorsProfile = new ApexCharts(
                document.getElementById("chart-visitors-profile2"),
                optionsVisitorsProfile
            );

            chartVisitorsProfile.render();
        });

    var chartColors = {
        red: "rgb(255, 99, 132)",
        orange: "rgb(255, 159, 64)",
        yellow: "rgb(255, 205, 86)",
        green: "rgb(75, 192, 192)",
        info: "#41B1F9",
        blue: "#3245D1",
        purple: "rgb(153, 102, 255)",
        grey: "#EBEFF6",
    };

    </script>
@endsection

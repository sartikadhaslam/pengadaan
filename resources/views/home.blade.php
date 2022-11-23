@extends('layouts.app')

@section('content')
@php
$arrpembelian = [];
    foreach ($pembelian as $pembelian) {
        
        $arrpembelian[] = [
            "name" => $pembelian['tanggal_pembelian'],
            "y" => floatval($pembelian['id'])
        ];
    }
$arrPembelian = json_encode($arrpembelian);
@endphp
<div class="">
    
        <div class="documentation-container">


            <div class="docs-sidebar">

                <div class="docs-content-area">

                    <div class="docs-list">
                    <h5>DASHBOARD {{$month}} {{$year}}</h5>
                    <ul>
                        <li><a href="{{url('/')}}">Dashboard</a></li>
                    </ul>
                    @if(Auth::user()->role == 'pengadaan')
                    <h5>MASTER</h5>
                    <ul>
                        <li><a href="{{url('/master-barang')}}">Master Barang</a></li>
                        <li><a href="{{url('/master-customer')}}">Master Customer</a></li>
                        <li><a href="{{url('/master-principle')}}">Master Principle</a></li>
                        <li><a href="{{url('/master-user')}}">Master User</a></li>
                    </ul>
                    @endif
                    <h5>TRANSAKSI</h5>
                    <ul>
                    @if(Auth::user()->role != 'principle')
                        <li><a href="{{url('/pemesanan')}}">Pemesanan oleh Customer</a></li>
                        <li><a href="{{url('/pengiriman')}}">Pengiriman ke Customer</a></li>
                    @endif
                    @if(Auth::user()->role != 'customer')
                        <li><a href="{{url('/pembelian')}}">Pembelian ke Principle</a></li>
                        <li><a href="{{url('/penerimaan')}}">Penerimaan dari Principle</a></li>
                    @endif
                    </ul>
                    @if(Auth::user()->role == 'pengadaan')
                    <h5>LAPORAN</h5>

                    <ul>
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pemesanan</a></li>
                        <li><a href="{{url('/laporan-pengadaan')}}">Laporan Pengadaan</a></li>
                    </ul>
                    @endif
                        
                    </div>
                </div>
                
            </div>

            <div class="docs-container-content">

                <div class="docs-content-area">

                    <div class="d-flex justify-content-sm-end justify-content-between">                      

                        <div class="action-btns">
                            <a class="btn btn-primary btn-preview" href="https://designreset.com/cork-admin">Preview</a>
                            <a class="btn btn-success btn-buy-now" href="##">Buy Now</a>
                        </div>

                    </div>
                    

                    <h1>Dashboard {{$month}} {{$year}}</h1>

                    
                    <hr/>

                    <div class="row">
                        @if($role == 'customer' || $role == 'pengadaan')
                        <div class="col-md-3">
                            <div class="alert alert-danger" style="display:block!important;color:#e7515a!important;">
                                <strong>Pemesanan Baru</strong>
                                <h3 class="text-center">{{count($pemesananBaru)}}</h3>
                            </div>
                        </div>
                        @endif
                        @if($role == 'principle' || $role == 'pengadaan')
                        <div class="col-md-3">
                            <div class="alert alert-warning" style="display:block!important;color:#e2a03f!important;">
                                <strong>Pembelian Baru</strong>
                                <h3 class="text-center">{{count($pembelianBaru)}}</h3>
                            </div>
                        </div>
                        @endif
                        @if($role == 'principle' || $role == 'pengadaan')
                        <div class="col-md-3">
                            <div class="alert alert-primary" style="display:block!important;color:#4361ee!important;">
                                <strong>Pembelian Approve</strong>
                                <h3 class="text-center">{{count($pembelianAppr)}}</h3>
                            </div>
                        </div>
                        @endif
                        @if($role == 'customer' || $role == 'pengadaan')
                        <div class="col-md-3">
                            <div class="alert alert-success" style="display:block!important;color:#1abc9c!important;">
                                <strong>Menunggu di Kirim</strong>
                                <h3 class="text-center">{{count($pemesananKiri)}}</h3>
                            </div>
                        </div>
                        @endif
                    </div>
                    <br>
                    <figure class="highcharts-figure">
                        @if($role == 'customer' || $role == 'pengadaan')
                        <div id="container"></div>
                        @elseif($role == 'principle' || $role == 'pengadaan')
                        <div id="container2"></div>
                        @endif
                    </figure>

                    <div class="alert alert-primary" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> <span>&#169; Copy Right by <b>Sintya Ayu Daniar</b> for Skripsi ITB Swadharma 2022.</span> 
                    </div>
                </div>
                
            </div>
            
            
        </div>

    </div>
    <script type="text/javascript">
    $(document).ready(function () {
        role = '{{ $role }}';

        console.log(role);

        if(role == 'customer' || role == 'pengadaan'){
            pemesanan_tanggal = @json($pemesanan->pluck('tanggal_pemesanan'));
            pemesanan_count = @json($pemesanan->pluck('id'));

            var pemesananCount = pemesanan_count.map(function (y) { 
                return parseInt(y); 
            });
            
            Highcharts.chart('container', {
                chart: {
                    backgroundColor: null,
                    style: {
                        color: "#4361ee"
                    }
                },
                title: {
                    text: 'Pemesanan Harian',
                    align: 'left',
                    style: {
                        color: "#4361ee"
                    }
                },
                xAxis: {
                    categories: pemesanan_tanggal,
                    labels:{
                        style: {
                            color: "#4361ee"
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'Total Pemesanan',
                        style: {
                            color: "#4361ee"
                        }
                    },
                    labels:{
                        style: {
                            color: "#4361ee"
                        }
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#4361ee',
                    },
                },
                exporting: { 
                    enabled: false 
                },
                credits: {
                    enabled: false
                },
                labels: {
                    items: [{
                        html: '',
                        style: {
                            left: '50px',
                            top: '18px',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'black'
                        }
                    }]
                },
                series: [{
                    type: 'column',
                    name: 'Column',
                    data: pemesananCount
                }, {
                    type: 'spline',
                    name: 'Line',
                    data: pemesananCount,
                    marker: {
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                }]
            });
        }
        if(role == 'principle' || role == 'pengadaan'){
            Highcharts.chart('container2', {
                chart: {
                    type: 'column',
                    backgroundColor: null,
                    style: {
                        color: "#4361ee"
                    }
                },
                title: {
                    align: 'left',
                    text: 'Pembelian Harian',
                    style: {
                        color: "#4361ee"
                    }
                },
                accessibility: {
                    announceNewData: {
                        enabled: true
                    }
                },
                xAxis: {
                    type: 'category',
                    labels:{
                        style: {
                            color: "#4361ee"
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'Total Pembelian',
                        style: {
                            color: "#4361ee"
                        }
                    },
                    labels:{
                        style: {
                            color: "#4361ee"
                        }
                    }

                },
                legend: {
                    enabled: false,
                    itemStyle: {
                        color: '#4361ee',
                    },
                },
                exporting: { 
                    enabled: false 
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>'
                },

                series: [
                    {
                        name: "Tanggal Pembelian",
                        colorByPoint: true,
                        data: <?= $arrPembelian ?>,
                    }
                ],
            });
        }
    });
</script>
@endsection

@extends('layouts.app')

@section('content')
<div class="">
    
        <div class="documentation-container">


            <div class="docs-sidebar">

                <div class="docs-content-area">

                    <div class="docs-list">
                    <h5>DASHBOARD</h5>
                    <ul>
                        <li><a href="{{url('/')}}">Dashboard</a></li>
                    </ul>
                    @if(Auth::user()->role == 'pengadaan')
                    <h5>MASTER</h5>
                    <ul>
                        <li><a href="{{url('/master-barang')}}">Master Barang</a></li>
                        <li><a href="{{url('/master-customer')}}">Master Customer</a></li>
                        <li><a href="{{url('/master-principle')}}">Master Principle</a></li>
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
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pengadaan</a></li>
                        <li><a href="{{url('/laporan-pengiriman')}}">Laporan Pengiriman</a></li>
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
                    

                    <h1>Dashboard</h1>

                    
                    <hr/>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="alert alert-danger" style="display:block!important;color:#e7515a!important;">
                                <strong>Pemesanan Baru</strong>
                                <h3 class="text-center">1</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="alert alert-warning" style="display:block!important;color:#e2a03f!important;">
                                <strong>Pembelian Baru</strong>
                                <h3 class="text-center">1</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="alert alert-primary" style="display:block!important;color:#4361ee!important;">
                                <strong>Pembelian Approve</strong>
                                <h3 class="text-center">1</h3>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="alert alert-success" style="display:block!important;color:#1abc9c!important;">
                                <strong>Mengunggu di Kirim</strong>
                                <h3 class="text-center">1</h3>
                            </div>
                        </div>
                    </div>
                    <br>
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <div id="container2"></div>
                    </figure>

                    <div class="alert alert-primary" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> <span>&#169; Copy Right by <b>Sintya Ayu Daniar</b> for Skripsi ITB Swadharma 2022.</span> 
                    </div>
                </div>
                
            </div>
            
            
        </div>

    </div>
    <script>
        Highcharts.chart('container', {
            chart: {
                backgroundColor: null,
                style: {
                    color: "#4361ee"
                }
            },
            title: {
                text: 'Pemesanan Harian Oktober 2022',
                align: 'left',
                style: {
                    color: "#4361ee"
                }
            },
            xAxis: {
                categories: ['1', '2', '3', '4', '5'],
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
                data: [59, 83, 65, 228, 184]
            }, {
                type: 'spline',
                name: 'Line',
                data: [47, 83.33, 70.66, 239.33, 175.66],
                marker: {
                    lineWidth: 2,
                    lineColor: Highcharts.getOptions().colors[3],
                    fillColor: 'white'
                }
            }]
        });


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
                text: 'Pembelian Harian Oktober 2022',
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
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
                {
                    name: "Browsers",
                    colorByPoint: true,
                    data: [
                        {
                            name: "Chrome",
                            y: 63.06,
                            drilldown: "Chrome"
                        },
                        {
                            name: "Safari",
                            y: 19.84,
                            drilldown: "Safari"
                        },
                        {
                            name: "Firefox",
                            y: 4.18,
                            drilldown: "Firefox"
                        },
                        {
                            name: "Edge",
                            y: 4.12,
                            drilldown: "Edge"
                        },
                        {
                            name: "Opera",
                            y: 2.33,
                            drilldown: "Opera"
                        },
                        {
                            name: "Internet Explorer",
                            y: 0.45,
                            drilldown: "Internet Explorer"
                        },
                        {
                            name: "Other",
                            y: 1.582,
                            drilldown: null
                        }
                    ]
                }
            ],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: [
                    {
                        name: "Chrome",
                        id: "Chrome",
                        data: [
                            [
                                "v65.0",
                                0.1
                            ],
                            [
                                "v64.0",
                                1.3
                            ],
                            [
                                "v63.0",
                                53.02
                            ],
                            [
                                "v62.0",
                                1.4
                            ],
                            [
                                "v61.0",
                                0.88
                            ],
                            [
                                "v60.0",
                                0.56
                            ],
                            [
                                "v59.0",
                                0.45
                            ],
                            [
                                "v58.0",
                                0.49
                            ],
                            [
                                "v57.0",
                                0.32
                            ],
                            [
                                "v56.0",
                                0.29
                            ],
                            [
                                "v55.0",
                                0.79
                            ],
                            [
                                "v54.0",
                                0.18
                            ],
                            [
                                "v51.0",
                                0.13
                            ],
                            [
                                "v49.0",
                                2.16
                            ],
                            [
                                "v48.0",
                                0.13
                            ],
                            [
                                "v47.0",
                                0.11
                            ],
                            [
                                "v43.0",
                                0.17
                            ],
                            [
                                "v29.0",
                                0.26
                            ]
                        ]
                    },
                    {
                        name: "Firefox",
                        id: "Firefox",
                        data: [
                            [
                                "v58.0",
                                1.02
                            ],
                            [
                                "v57.0",
                                7.36
                            ],
                            [
                                "v56.0",
                                0.35
                            ],
                            [
                                "v55.0",
                                0.11
                            ],
                            [
                                "v54.0",
                                0.1
                            ],
                            [
                                "v52.0",
                                0.95
                            ],
                            [
                                "v51.0",
                                0.15
                            ],
                            [
                                "v50.0",
                                0.1
                            ],
                            [
                                "v48.0",
                                0.31
                            ],
                            [
                                "v47.0",
                                0.12
                            ]
                        ]
                    },
                    {
                        name: "Internet Explorer",
                        id: "Internet Explorer",
                        data: [
                            [
                                "v11.0",
                                6.2
                            ],
                            [
                                "v10.0",
                                0.29
                            ],
                            [
                                "v9.0",
                                0.27
                            ],
                            [
                                "v8.0",
                                0.47
                            ]
                        ]
                    },
                    {
                        name: "Safari",
                        id: "Safari",
                        data: [
                            [
                                "v11.0",
                                3.39
                            ],
                            [
                                "v10.1",
                                0.96
                            ],
                            [
                                "v10.0",
                                0.36
                            ],
                            [
                                "v9.1",
                                0.54
                            ],
                            [
                                "v9.0",
                                0.13
                            ],
                            [
                                "v5.1",
                                0.2
                            ]
                        ]
                    },
                    {
                        name: "Edge",
                        id: "Edge",
                        data: [
                            [
                                "v16",
                                2.6
                            ],
                            [
                                "v15",
                                0.92
                            ],
                            [
                                "v14",
                                0.4
                            ],
                            [
                                "v13",
                                0.1
                            ]
                        ]
                    },
                    {
                        name: "Opera",
                        id: "Opera",
                        data: [
                            [
                                "v50.0",
                                0.96
                            ],
                            [
                                "v49.0",
                                0.82
                            ],
                            [
                                "v12.1",
                                0.14
                            ]
                        ]
                    }
                ]
            }
        });

    </script>
@endsection

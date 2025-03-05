@extends('layouts.admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">Users</h6>
                                <span class="font-weight-bold mb-0 font-20">1,562</span>
                            </div>
                            <i class="fas fa-address-card card-icon col-orange font-30 p-r-30"></i>
                        </div>
                        <canvas id="cardChart1" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">Recipes</h6>
                                <span class="font-weight-bold mb-0 font-20">895</span>
                            </div>
                            <i class="fas fa-diagnoses card-icon col-green font-30 p-r-30"></i>
                        </div>
                        <canvas id="cardChart2" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">Growth</h6>
                                <span class="font-weight-bold mb-0 font-20">+22.58%</span>
                            </div>
                            <i class="fas fa-chart-bar card-icon col-indigo font-30 p-r-30"></i>
                        </div>
                        <canvas id="cardChart3" height="80"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-bg">
                        <div class="p-t-20 d-flex justify-content-between">
                            <div class="col">
                                <h6 class="mb-0">Revenue</h6>
                                <span class="font-weight-bold mb-0 font-20">$2,687</span>
                            </div>
                            <i class="fas fa-hand-holding-usd card-icon col-cyan font-30 p-r-30"></i>
                        </div>
                        <canvas id="cardChart4" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card ">
                    <div class="card-header">
                        <h4>Revenue chart</h4>
                        <div class="card-header-action">
                            <div class="dropdown">
                                <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle">Options</a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i> View</a>
                                    <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                                        Delete</a>
                                </div>
                            </div>
                            <a href="#" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <div id="chart1"></div>
                                <div class="row mb-0">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                                    class="col-green"></i>
                                                <h5 class="m-b-0">$675</h5>
                                                <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                                                    class="col-orange"></i>
                                                <h5 class="m-b-0">$1,587</h5>
                                                <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="list-inline text-center">
                                            <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                                                    class="col-green"></i>
                                                <h5 class="mb-0 m-b-0">$45,965</h5>
                                                <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row mt-5">
                                    <div class="col-7 col-xl-7 mb-3">Total customers</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">8,257</span>
                                        <sup class="col-green">+09%</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Total Income</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">$9,857</span>
                                        <sup class="text-danger">-18%</sup>
                                    </div>

                                    <div class="col-7 col-xl-7 mb-3">Total expense</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">$6,287</span>
                                        <sup class="col-green">+09%</sup>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">New Customers</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">684</span>
                                        <sup class="col-green">+22%</sup>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
@endsection
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1 class="mt-4">Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}!</p>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body">
                        <div class="text-uppercase">Total Orders</div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-3x"></i>
                            </div>
                            <div class="col-auto ml-auto">
                                <h2>{{ $totalOrders }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body">
                        <div class="text-uppercase">Pending Orders</div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-clock fa-3x"></i>
                            </div>
                            <div class="col-auto ml-auto">
                                <h2>{{ $pendingOrders }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success text-white h-100">
                    <div class="card-body">
                        <div class="text-uppercase">Completed Orders</div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-3x"></i>
                            </div>
                            <div class="col-auto ml-auto">
                                <h2>{{ $completedOrders }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="text-uppercase">Total Revenue</div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-3x"></i>
                            </div>
                            <div class="col-auto ml-auto">
                                <h2>${{ number_format($totalRevenue, 2) }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-xl-6 mb-4">
                <div class="card bg-info text-white h-100">
                    <div class="card-body">
                        <div class="text-uppercase">Total Kedai</div>
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-store fa-3x"></i>
                            </div>
                            <div class="col-auto ml-auto">
                                <h2>{{ $kedaiCount }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area mr-1"></i>
                Sales Overview
            </div>
            <div class="card-body">
                <!-- Tambahkan grafik atau tabel data disini -->
                <div class="chart-area">
                    <canvas id="myAreaChart" width="100%" height="30"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Главная</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="small-box bg-info ">
                                        <div class="inner">
                                            <h3 class="text-center">ACCOUNT </h3>
                                            <p>{{ number_format($account->balance/100) }} UZS</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <p href="#" class="small-box-footer " style="text-align: right"></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3 class="text-center">Account To Card </h3>
                                            <p>{{ number_format($toCardAmount/100) }} UZS</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <p href="#" class="small-box-footer " style="text-align: right"></p>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="small-box bg-gradient-indigo">
                                        <div class="inner">
                                            <h3 class="text-center">Debit</h3>
                                            <p>{{ number_format($transferAmount/100) }} UZS</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <p href="#" class="small-box-footer " style="text-align: right"></p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </section>

@endsection

@extends('layouts.admin')

@section('content')
    @can('home')
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
                                            @if($mko)
                                                <div class="inner">
                                                    <h3 class="text-center">UCOIN</h3>
                                                    <p>{{ number_format($mko->balance/100) }} UZS</p>
                                                </div>
                                            @endif
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <p href="#" class="small-box-footer " style="text-align: right"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="small-box bg-success">
                                            @if($info)
                                                <div class="inner">
                                                    <h3 class="text-center">CREDIT</h3>
                                                    <p>{{ number_format($info->credit/100) }} UZS</p>
                                                </div>
                                            @endif
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <p href="#" class="small-box-footer " style="text-align: right"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="small-box bg-danger">
                                            @if($info)
                                                <div class="inner">
                                                    <h3 class="text-center">DEBIT</h3>
                                                    <p>{{ number_format($info->debit/100) }} UZS</p>
                                                </div>
                                            @endif
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <p href="#" class="small-box-footer " style="text-align: right"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="small-box bg-gradient-indigo">
                                            @if($limit)
                                                <div class="inner">
                                                    <h3 class="text-center">LIMIT</h3>
                                                    <p>{{ number_format($limit->limit/100) }} UZS</p>
                                                </div>
                                            @endif
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <p href="#" class="small-box-footer " style="text-align: right"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="small-box bg-gradient-blue">
                                            @if($limit)
                                                <div class="inner">
                                                    <h3 class="text-center">PAYMENT</h3>
                                                    <p>{{ number_format($payment->amount/100) }} UZS</p>
                                                </div>
                                            @endif
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <p href="#" class="small-box-footer " style="text-align: right"></p>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="small-box bg-yellow">
                                            @if($limit)
                                                <div class="inner">
                                                    <h3 class="text-center">SALDO</h3>
                                                    <p>{{ number_format(($info->credit - $payment->amount)/100) }} UZS</p>
                                                </div>
                                            @endif
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <p href="#" class="small-box-footer " style="text-align: right"></p>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- card-body -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped dataTable dtr-inline" role="grid"
                                       aria-describedby="dataTable_info">
                                    <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Cчёт(debit)</th>
                                        <th>Cчёт(credit)</th>
                                        <th>Cумма(debit)</th>
                                        <th>Cумма(credit)</th>
                                        <th>@lang('global.action')</th>
                                    </tr>
                                    <tr class="text-center">
                                        <form action="">
                                            <th>
                                                <input type="date" class="form-control" name="date"
                                                       value="{{ request()->date }}">
                                            </th>
                                            <th>
                                                <input value="{{ request()->dtAcc }}" type="text" placeholder="account"
                                                       class="clear-class form-control" name="dtAcc">
                                            </th>
                                            <th>
                                                <input value="{{ request()->ctAcc }}" type="text" placeholder="account"
                                                       class="clear-class form-control" name="ctAcc">
                                            </th>
                                            <th></th>
                                            <th></th>
                                            <th>

                                                <button name="accountSearch" id="searchSubmit" class="btn btn-default"
                                                        type="submit">
                                                    <span class="fa fa-search"></span>
                                                </button>
                                                <a href="{{ route("home") }}" class="btn btn-danger">
                                                    <span class="fa fa-reply"></span>
                                                </a>
                                            </th>

                                        </form>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($histories as $history)
                                        <tr>
                                            <td>{{ $history->date }}</td>
                                            <td>{{ $history->dtAcc }}</td>
                                            <td>{{ $history->ctAcc }}</td>
                                            <td>{{ number_format($history->debit/100) }}</td>
                                            <td>{{ number_format($history->credit/100) }}</td>
                                            @can('home.show')
                                                <td class="text-center">
                                                    <a href="{{ route('homeShow',$history->id) }}"
                                                       class="btn btn-info btn-sm">
                                                        <span class="fa fa-eye"></span>
                                                    </a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{ $histories->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    @endcan
@endsection

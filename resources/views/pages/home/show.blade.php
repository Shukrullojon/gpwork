@extends('layouts.admin')

@section('content')
    @can('home.show')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.show')</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="">
                                    <thead>
                                    <tr>
                                        <th>date</th>
                                        <td>{{ $history->date }}</td>
                                    </tr>
                                    <tr>
                                        <th>dtAcc</th>
                                        <td>{{ $history->dtAcc }}</td>
                                    </tr>
                                    <tr>
                                        <th>dtAccName</th>
                                        <td>{{ $history->dtAccName }}</td>
                                    </tr>
                                    <tr>
                                        <th>dtMfo</th>
                                        <td>{{ $history->dtMfo }}</td>
                                    </tr>
                                    <tr>
                                        <th>credit</th>
                                        <td>{{ number_format($history->credit/100) }} UZS</td>
                                    </tr>
                                    <tr>
                                        <th>debit</th>
                                        <td>{{ number_format($history->debit/100) }} UZS</td>
                                    </tr>
                                    <tr>
                                        <th>type</th>
                                        <td>{{ $history->type }}</td>
                                    </tr>
                                    <tr>
                                        <th>pupose</th>
                                        <td>{{ $history->purpose }}</td>
                                    </tr>
                                    <tr>
                                        <th>numberTrans</th>
                                        <td>{{ $history->numberTrans }}</td>
                                    </tr>
                                    <tr>
                                        <th>ctAcc</th>
                                        <td>{{ $history->ctAcc }}</td>
                                    </tr>
                                    <tr>
                                        <th>ctAccName</th>
                                        <td>{{ $history->ctAccName }}</td>
                                    </tr>
                                    <tr>
                                        <th>ctMfo</th>
                                        <td>{{ $history->ctMfo }}</td>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endcan
@endsection

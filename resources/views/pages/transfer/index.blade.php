@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transfers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Transfer</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (\Session::has('error'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{!! \Session::get('error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-center">
                                    <th>Sender</th>
                                    <th>Receiver</th>
                                    <th>Amount</th>
                                    <th>Credit(Amount)</th>
                                    <th>Debit(Amount)</th>
                                    <th>Commission(Amount)</th>
                                    <th>Rate</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($transfers as $key=>$transfer)
                                    <tr>
                                        <td>@if(!empty($transfer->card))
                                                {{ $transfer->card->number }}
                                            @endif</td>
                                        <td>{{ $transfer->receiver }}</td>
                                        <td>{{ number_format($transfer->amount/100) }} RUB</td>
                                        <td>{{ number_format($transfer->credit_amount/100) }} RUB</td>
                                        <td>{{ number_format($transfer->debit_amount/100) }} UZS</td>
                                        <td>{{ number_format($transfer->commission_amount/100) }} UZS</td>
                                        <td>{{ $transfer->rate  }}</td>
                                        <td>{{ $transfer->status }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="9">
                                            {{ $transfers->links() }}
                                        </td>
                                    </tr>
                                </tfooter>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')

@endsection

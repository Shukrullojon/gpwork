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
                            {{--<a href="{{ route("excelExportTransfer") }}" class="btn btn-success" style="float: right">Excel</a>--}}
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
                                <tr class="text-center">
                                    <form action="">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <select name="status" class="form-control">
                                                <option></option>
                                                <option
                                                    @if(isset(request()->status) and request()->status == 4) selected
                                                    @endif value="4">@lang('cruds.status.1')</option>
                                                <option
                                                    @if(isset(request()->status) and request()->status == 0) selected
                                                    @endif value="0">@lang('cruds.status.0')</option>
                                            </select>
                                        </th>
                                        <th>
                                            <button name="accountSearch" id="searchSubmit" class="btn btn-default"
                                                    type="submit">
                                                <span class="fa fa-search"></span>
                                            </button>
                                        </th>

                                    </form>
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
                                        <td>
                                            @if($transfer->status == 4)  @lang('cruds.status.1') @endif
                                            @if($transfer->status != 4)  @lang('cruds.status.0') @endif
                                        </td>
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

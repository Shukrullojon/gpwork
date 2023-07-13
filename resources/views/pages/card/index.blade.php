@extends('layouts.admin')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ucoins</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Ucoin</li>
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
                                    <th>Number</th>
                                    <th>Expire</th>
                                    <th>Owner</th>
                                    <th>Balance</th>
                                    <th>Phone</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($cards as $key=>$card)
                                    <tr>
                                        <td>{{ $card->number }}</td>
                                        <td>{{ $card->expire }}</td>
                                        <td>{{ $card->owner }}</td>
                                        <td>{{ number_format($card->balance/100) }} UZS</td>
                                        <td>{{ $card->phone }}</td>
                                        <td>
                                            <div class="btn-group ">
                                                <a href="{{ route('cardShow',$card->id) }}"
                                                   class="btn btn-info btn-sm">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="9">
                                            {{ $cards->links() }}
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

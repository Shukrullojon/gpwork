@extends('layouts.admin')
@section('content')
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Number</th>
                                    <td>{!! $card->number !!}</td>
                                </tr>

                                <tr>
                                    <th>Expire</th>
                                    <td>{!! $card->expire !!}</td>
                                </tr>

                                <tr>
                                    <th>Owner</th>
                                    <td>{!! $card->owner !!}</td>
                                </tr>

                                <tr>
                                    <th>Balance</th>
                                    <td>{!! number_format($card->balance/100) !!} UZS</td>
                                </tr>

                                <tr>
                                    <th>Phone</th>
                                    <td>{!! $card->phone !!}</td>
                                </tr>

                                <tr>
                                    <th>Pnfl</th>
                                    <td>{!! $card->pnfl !!}</td>
                                </tr>

                                <tr>
                                    <th>Pasport Series</th>
                                    <td>{!! $card->pasport_series !!}</td>
                                </tr>

                                <tr>
                                    <th>Pasport Number</th>
                                    <td>{!! $card->pasport_number !!}</td>
                                </tr>

                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('partial.headerFooter')

@section('content')
    <div class="container" style="margin-top: 20px;margin-bottom:20px">
        <div class="row pt-3">
            <div class="col-12">
                <div class="section-title">
                    <h2>@lang('donationHistory.my_donations')</h2>
                    @empty($donations[0])
                        <p>@lang('donationHistory.empty1')<br>@lang('donationHistory.empty2')</p>
                        <div style="width: 300px; opacity: .3; margin:auto">
                            <img src="{{ asset('/img/icon.png') }}" alt="" class="pt-5 mt-3">
                            <img src="{{ asset('/img/logo.png') }}" alt="" style="height: 135px; width:300px;object-fit: cover; object-position: 100% 0;">
                        </div>
                    @endempty
                </div>
            </div>
        </div>
        <div class="container-fluid d-flex flex-wrap justify-content-between">
            @foreach ($donations as $donation)
                <div class="container-fluid"
                    style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:{{ $donation->amount > 150000 ? 'rgb(246, 39, 39)' : 'rgb(37, 43, 202)' }};border-radius:5px;padding:20px;color:white;width:45%">
                    <div class="d-flex align-items-center">
                        <?php
                            $promotional = json_decode($donation->game->promotional);
                        ?>
                        <a href="/game/{{ $donation->game->id }}"><img src="{{ $promotional->logo }}" alt="" class="rounded-circle"
                            style="height: 50px; width:50px"></a>
                        <div class="d-flex flex-column">
                            <strong style="margin-left:15px;font-size:18px">
                                <a href="/game/{{ $donation->game->id }}" class="text-light">{{ $donation->game->game_name }}</a>
                            </strong>
                            <strong style="margin-left:15px;font-size:20px">Rp{{ number_format($donation->amount, 2, ',', '.') }} ({{ str_replace('_', ' ',$donation->payment_method) }})</strong>
                        </div>
                    </div>
                    <div class="div" style="margin-top:10px">
                        <span>{{ $donation->message }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

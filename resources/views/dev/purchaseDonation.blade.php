@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <div class="row pt-3">
        <div class="col-12">
            <div class="section-title mb-1">
                <h2>@lang('purchaseDonation.title')</h2>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center mb-5">
        <div style="margin-right:20px">
            <img src="{{ url($developer->company_pic_url) }}" alt=""
                style="height: 100px; width:100px;border-radius:50%">
        </div>
        <div>
            <h2 class="title" style="font-size:40px;margin-bottom:5px">{{ $developer->company_name }}</h2>
            <p class="category">{{ $developer->company_address }}</p>
        </div>
    </div>
    @foreach ($games as $game)
        <?php
            $promotional = json_decode($game->promotional);
        ?>
        <div class="row shadow pt-2 pb-2" style="background-color: #f9f9f9">
            <div class="d-flex align-items-center">
                <div style="margin-right:20px">
                    <img src="{{ url($promotional->logo) }}" alt=""
                        style="height: 50px; width:50px;border-radius:30px">
                </div>
                <div>
                    <h5 class="title">{{ $game->game_name }}</h5>
                    <p class="category">{{ $game->status }}</p>
                </div>
            </div>
        </div>
        <div class="row pt-4 pb-5">
            <div class="col-6">
                <h3 class="text-center pb-3">@lang('purchaseDonation.purchases')</h3>
                @empty($game->gamePayments[0])
                    <h5 class="text-center pb-4 pt-2">@lang('purchaseDonation.noData')</h5>
                @endempty
                @foreach ($game->gamePayments as $payment)
                    <div class="container-fluid"
                        <?php
                            $user = $payment->user;
                        ?>
                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color: rgb(37, 43, 202);border-radius:5px;padding:20px;color:white;">
                        <div class="d-flex align-items-center">
                            <img src="{{ url($user->profile_url) }}" alt="" class="rounded-circle"
                                style="height: 50px; width:50px">
                            <div class="d-flex flex-column">
                                <strong class="text-light" style="margin-left:15px;font-size:18px">{{ $user->username }}</strong>
                                <strong class="text-light" style="margin-left:15px;font-size:18px">Bought: {{$payment->game->game_name}}</strong>
                                <strong style="margin-left:15px;font-size:20px">Rp{{ number_format($payment->amount, 2, ',', '.') }} ({{ str_replace('_', ' ',$payment->payment_method) }})</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-6">
                <h3 class="text-center pb-3">@lang('purchaseDonation.donations')</h3>
                @empty($game->gameDonations[0])
                    <h5 class="text-center pb-4 pt-2">@lang('purchaseDonation.noData')</h5>
                @endempty
                @foreach ($game->gameDonations as $donation)
                    <div class="container-fluid"
                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:{{ $donation->amount > 150000 ? 'rgb(246, 39, 39)' : 'rgb(37, 43, 202)' }};border-radius:5px;padding:20px;color:white;">
                        <h6 class="text-white" style="margin-bottom:20px">{{$donation->game->game_name}}</h6>
                        <div class="d-flex align-items-center">
                            <?php
                                $user = $donation->user;
                            ?>
                            <img src="{{ url($user->profile_url) }}" alt="" class="rounded-circle"
                                style="height: 50px; width:50px">
                            <div class="d-flex flex-column">
                                <strong class="text-light" style="margin-left:15px;font-size:18px">{{ $user->name }}</strong>
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
    @endforeach
</div>
@endsection

@extends('partial.headerFooter')

@section('content')
    <div class="container pt-3" style="margin-top: 20px;margin-bottom:20px; background-color: #f9f9f9">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>@lang('pendingGame.title')</h2>
                    @empty($games[0])
                        <p>@lang('pendingGame.empty')</p>
                        <div style="width: 300px; opacity: .3; margin:auto">
                            <img src="{{ asset('/img/icon.png') }}" alt="" class="pt-5 mt-3">
                            <img src="{{ asset('/img/logo.png') }}" alt=""
                                style="height: 135px; width:300px;object-fit: cover; object-position: 100% 0;">
                        </div>
                    @endempty
                </div>
            </div>
        </div>
        <div class="row pb-5">
            @foreach ($games as $game)
                <?php
                $promotional = json_decode($game->promotional);
                ?>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Product -->
                    <div class="single-product" style="height: 370px">
                        <a href="/admin/detail/{{ $game->id }}" class="product-image">
                            <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                        </a>
                        <div class="product-info">
                            <span class="category">
                                Date Submit: <strong>{{$game->updated_at->format('Y:m:d H:i')}}</strong>
                            </span>
                            <h4 class="title">
                                <a href="/admin/detail/{{ $game->id }}">{{ $game->game_name }}</a>
                            </h4>
                            <div class="price mt-1">
                                <span>Rp{{ number_format($game->price, 2, ',', '.') }}</span>
                            </div>
                            <div class="pt-3 d-flex justify-content-between">
                                <a href="/admin/detail/{{ $game->id }}" class="btn btn-primary">Check Game</a>
                                {{-- <form action="/admin/detail/deny" method="POST" style="width: 45%">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <button value="{{ $game->game_name }}" class="btn btn-danger denyBtn" style="font-size: 13px;width: 83px">@lang('pendingGame.deny')</button>
                            </form>
                            <form action="/admin/detail/publish" method="POST" style="width: 45%">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                <button type="submit" class="btn btn-primary" style="font-size: 13px; width: 83px">@lang('pendingGame.publish')</button>
                            </form> --}}
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                </div>
            @endforeach
        </div>
    </div>
@endsection

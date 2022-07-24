@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <section class="pt-3" style="margin-top: 12px;" id="onsale">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>@lang('allGames.title')</h2>
                        @empty($games[0])
                            <p>@lang('allGames.empty')</p>
                            <div style="width: 300px; opacity: .3; margin:auto">
                                <img src="{{ asset('/img/icon.png') }}" alt="" class="pt-5 mt-3">
                                <img src="{{ asset('/img/logo.png') }}" alt="" style="height: 135px; width:300px;object-fit: cover; object-position: 100% 0;">
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($games as $game)
                    <?php
                    $promotional = json_decode($game->promotional);
                    ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="single-product" style="height: 370px">
                            <a href="/game/{{ $game->id }}" class="product-image">
                                <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                                @if ($sale_game->where('game_id', $game->id)->count() > 0)
                                    <span class="sale-tag">-50%</span>
                                @endif
                            </a>
                            <div class="product-info">
                                <span class="category">
                                    <a href="/category/{{ $game->genre_id }}" class="text-dark">{{ $game->gameGenre->genre_name }}</a>
                                </span>
                                <h4 class="title">
                                    <a href="/game/{{ $game->id }}">{{ $game->game_name }}</a>
                                </h4>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>{{ $game->gameReviews->avg('rating') }}/5 @lang('allGames.game.rating')</span></li>
                                </ul>
                                <div class="price">
                                    <span>Rp{{number_format( $game->price,2,',','.') }}</span>
                                    @if ($sale_game->where('game_id', $game->id)->count() > 0)
                                        <span class="discount-price">Rp{{number_format( $game->price,2,',','.') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

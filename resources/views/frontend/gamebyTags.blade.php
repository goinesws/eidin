@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <!-- Start Banner Area -->
    <section class="banner section pb-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ $tag->tag_name }} Games</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($games as $game)
                    <?php
                    $promotional = json_decode($game->promotional);
                    ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <div class="single-product" style="height: 370px">
                            <a href="/game/{{ $game->game_id }}" class="product-image">
                                <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                                @if ($sale_game->where('game_id', $game->id)->count() > 0)
                                    <span class="sale-tag">-50%</span>
                                @endif
                            </a>
                            <div class="product-info">
                                <span class="category">
                                    <a href="/category/{{ $game->genre_id }}" class="text-dark">{{$game->genre_name}}</a>
                                </span>
                                <h4 class="title">
                                    <a href="/game/{{ $game->game_id }}">{{ $game->game_name }}</a>
                                </h4>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>{{-- $game->gameReviews->avg('rating') --}}error/5 Ratings</span></li>
                                </ul>
                                <div class="price">
                                    <span>Rp{{number_format( $game->price,2,',','.') }}</span>
                                    @if ($sale_game->where('game_id', $game->id)->count() > 0)
                                        <span class="discount-price">Rp{{number_format( $game->price,2,',','.') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Single Product -->
                    </div>
                @endforeach
                @if(count($games) == 0)
                    <h4 class="text-center">No Games Found :(</h4>
                @endif
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
</div>
@endsection

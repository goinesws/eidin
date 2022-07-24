@extends('partial.headerFooter')

@section('content')
    <div class="container" style="margin-top:20px">
    </div>
    <section class="hero-area mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 custom-padding-right">
                    <div class="slider-head">
                        <div class="hero-slider">
                            @if ($promo_game->isEmpty())
                                <div class="single-slider"
                                    style="background-image: url(frontend/images/hero/bg.jpg);">
                                    <div class="content" style="padding-right:50%">
                                        <h2><span>@lang('dashboard.sponsored')</span>
                                            {{ $games[0]->game_name }}
                                        </h2>
                                        <?php
                                            $promotional = json_decode($games[0]->promotional);
                                        ?>
                                        <div class="pt-3 pb-1">{{ $games[0]->short_desc }}</div>
                                        <h3><span>@lang('dashboard.now_only')</span> Rp{{ number_format($games[0]->price,2,',','.') }}</h3>
                                        <div class="button">
                                            <a href="/game/{{ $games[0]->id }}" class="btn">@lang('dashboard.buy_btn')</a>
                                        </div>
                                    </div>
                                    <img src="{{ $promotional->img[0] }}" alt=""
                                        style="width: 50%; height:60%; position:absolute; right:0; top:20%">
                                </div>
                            @else
                                @foreach ($promo_game as $pgame)
                                    <div class="single-slider"
                                        style="background-image: url(frontend/images/hero/bg.jpg);">
                                        <div class="content" style="padding-right:50%">
                                            <h2><span>@lang('dashboard.sponsored')</span>
                                                {{ $pgame->game_name }}
                                            </h2>
                                            <?php
                                                $promotional = json_decode($pgame->promotional);
                                            ?>
                                            <div class="pt-3 pb-1">{{ $pgame->short_desc }}</div>
                                            <h3><span>@lang('dashboard.now_only')</span> Rp{{ number_format($pgame->price,2,',','.') }}</h3>
                                            <div class="button">
                                                <a href="/game/{{ $pgame->id }}" class="btn">@lang('dashboard.buy_btn')</a>
                                            </div>
                                        </div>
                                        <img src="{{$promotional->img[0] }}" alt=""
                                            style="width: 50%; height:60%; position:absolute; right:0; top:20%">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="row">
                        @if ($free_game)
                            <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                                <?php
                                $promotional = json_decode($free_game->promotional);
                                ?>
                                <div class="hero-small-banner"
                                    style="background-image: url({{ $promotional->img[0] }});">
                                    <a href="/game/{{ $free_game->id}}" class="content" style="background-color: rgba(255, 255, 255, 0.8)">
                                        <h2>
                                            <span>@lang('dashboard.free_games')</span>
                                            {{ $free_game->game_name }}
                                        </h2>
                                        <h3>Rp{{ number_format($free_game->price,2,',','.')  }}</h3>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12 col-md-6 col-12 md-custom-padding">
                                <div class="hero-small-banner style2 mt-0">
                                    <div class="content">
                                        <h2>@lang('dashboard.free_games')</h2>
                                        <p>@lang('dashboard.free_game_text')</p>
                                        <h2 class="pt-4">@lang('dashboard.coming_soon')</h2>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12 col-md-6 col-12">
                            <div class="hero-small-banner style2">
                                <div class="content">
                                    <h2>@lang('dashboard.seasonal_sale')</h2>
                                    <p>@lang('dashboard.seasonal_text')</p>
                                    @if ($sale_game->isEmpty())
                                        <h2 class="pt-4">@lang('dashboard.coming_soon')</h2>
                                    @else
                                        <div class="button">
                                            <a class="btn" href="#onsale">@lang('dashboard.sale_btn')</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (!$new_game->isEmpty())
        <section class="banner section pb-1 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>@lang('dashboard.new_game')</h2>
                            <p>@lang('dashboard.new_game_text')</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($new_game as $ngame)
                        <div class="col-lg-6 col-md-6 col-12 mb-4">
                            <div class="single-banner position-relative"
                                style="background-image:url('frontend/images/banner/bg.jpg'); height:300px">
                                <span class="position-absolute text-light bg-danger pt-2 pb-2 ps-4 pe-4">@lang('dashboard.new')</span>
                                <div class="content pt-5" style="padding-right:55%">
                                    <h2 class="d-flex align-items-center" style="height: 50px">{{ $ngame->game_name }}</h2>
                                    <p style="height: 70px;overflow:hidden">{{ $ngame->short_desc }}</p>
                                    <div class="button">
                                        <a href="/game/{{ $ngame->id }}" class="btn">@lang('dashboard.view_details')</a>
                                    </div>
                                    <?php
                                    $promotional = json_decode($ngame->promotional);
                                    ?>
                                    <img src="{{ $promotional->img[0] }}" alt=""
                                        class="position-absolute top-0 end-0" style="width: 45%; height:100%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Banner Area -->
    @endif

    @if (!$sale_game->isEmpty())
        <section class="trending-product section pt-5" style="margin-top: 12px;" id="onsale">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title">
                            <h2>@lang('dashboard.on_sale')</h2>
                            <p>@lang('dashboard.on_sale_text')</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($sale_game as $sgame)
                        <?php
                        $promotional = json_decode($sgame->promotional);
                        ?>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-product"  style="height: 370px">
                                <a href="/game/{{ $sgame->id }}" class="product-image">
                                    <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                                    <span class="sale-tag">-50%</span>
                                </a>
                                <div class="product-info">
                                    <span class="category">
                                        <a href="/category/{{ $sgame->genre_id }}" class="text-dark">{{ $genres[$sgame->genre_id - 1]->genre_name }}</a>
                                    </span>
                                    <h4 class="title">
                                        <a href="/game/{{ $sgame->id }}">{{ $sgame->game_name }}</a>
                                    </h4>
                                    <ul class="review">
                                        <li><i class="lni lni-star-filled"></i></li>
                                        <li><span>{{ $sgame->gameReviews->avg('rating') }} @lang('dashboard.ratings')</span></li>
                                    </ul>
                                    <div class="price">
                                        <span>Rp{{number_format( $sgame->price,2,',','.') }}</span>
                                        <span class="discount-price">Rp{{ number_format( $sgame->price*2,2,',','.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

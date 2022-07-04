@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <!-- Start Banner Area -->
    <section class="banner section pb-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{ $genre->genre_name }} Games</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- @foreach ($games as $item)
                    <div class="col-lg-6 col-md-6 col-12 mb-4">
                        <div class="single-banner position-relative"
                            style="background-image:url({{ asset('frontend/images/banner/banner-1-bg.jpg') }}); height:300px">
                            <span class="position-absolute text-light bg-danger pt-2 pb-2 ps-4 pe-4">
                                @foreach ($item->tagDetail as $i)
                                    <span style="margin-right:5px">
                                        {{$i->tag->tag_name}}
                                    </span>
                                @endforeach
                            </span>
                            <div class="content" style="padding-right:55%">
                                <h2>{{ $item->game_name }}</h2>
                                <p>{{ $item->short_desc }}</p>
                                <div class="button">
                                    <a href="/game/{{$item->id}}" class="btn">View Details</a>
                                </div>
                                <?php
                                    // $promotional = json_decode($item->promotional)
                                ?>
                                <img src="{{ $promotional->img[0] }}" alt=""
                                    class="position-absolute top-0 end-0" style="width: 45%; height:100%;">
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                @foreach ($games as $game)
                    <?php
                    $promotional = json_decode($game->promotional);
                    ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <div class="single-product" style="height: 370px">
                            <a href="/game/{{ $game->id }}" class="product-image">
                                <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                                @if ($sale_game->where('game_id', $game->id)->count() > 0)
                                    <span class="sale-tag">-50%</span>
                                @endif
                            </a>
                            <div class="product-info">
                                <span class="category">
                                    <a href="/category/{{ $game->genre_id }}" class="text-dark">{{ $genre->genre_name }}</a>
                                </span>
                                <h4 class="title">
                                    <a href="/game/{{ $game->id }}">{{ $game->game_name }}</a>
                                </h4>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>{{ $game->gameReviews->avg('rating') }}/5 Ratings</span></li>
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

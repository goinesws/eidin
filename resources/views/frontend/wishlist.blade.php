@extends('partial.headerFooter')

@section('content')
<div class="container pt-3" style="margin-top: 20px;margin-bottom:20px; background-color: #f9f9f9">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h2>Wishlists</h2>
            </div>
        </div>
    </div>
    <div class="row pb-5">
        @foreach ($wishlists as $item)
            <?php
            $promotional = json_decode($item->game->promotional);
            ?>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Product -->
                <div class="single-product" style="height: 370px">
                    <a href="/game/{{ $item->game_id }}" class="product-image">
                        <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                        @if ($sale_game->where('game_id', $item->game_id)->count() > 0)
                            <span class="sale-tag">-50%</span>
                        @endif
                    </a>
                    <div class="product-info">
                        <span class="category">
                            <a href="/category/{{ $item->game->genre_id }}" class="text-dark">{{ $genres[$item->game->genre_id - 1]->genre_name }}</a>
                        </span>
                        <h4 class="title">
                            <a href="/game/{{ $item->game_id }}">{{ $item->game->game_name }}</a>
                        </h4>
                        <div class="price mt-1">
                            <span>Rp{{number_format( $item->game->price,2,',','.') }}</span>
                            @if ($sale_game->where('game_id', $item->game_id)->count() > 0)
                                <span class="discount-price">Rp{{number_format( $item->game->price*2,2,',','.') }}</span>
                            @endif
                        </div>
                        <div class="pt-3 d-flex justify-content-between">
                            <form action="/wishlist/remove" method="POST" style="width: 45%">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->game_id }}">
                                <button type="submit" class="btn btn-danger" style="font-size: 13px;">Remove</button>
                            </form>
                            <form action="/game/buy" method="POST" style="width: 45%">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $item->game_id }}">
                                <button type="submit" class="btn btn-primary" style="font-size: 13px;">Purchase</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
        @endforeach
    </div>
</div>
@endsection

@extends('partial.headerFooter')

@section('content')
<div class="container pt-3" style="margin-top: 20px;margin-bottom:20px; background-color: #f9f9f9">
    <div class="row">
        <div class="col-12">
            <div class="section-title">
                <h2>@lang('wishlist.wishlist')</h2>
                @empty($wishlists[0])
                    <p>@lang(('wishlist.empty_message.1'))<br>@lang('wishlist.empty_message.2')</p>
                    <div style="width: 300px; opacity: .3; margin:auto">
                        <img src="{{ asset('/img/icon.png') }}" alt="" class="pt-5 mt-3">
                        <img src="{{ asset('/img/logo.png') }}" alt="" style="height: 135px; width:300px;object-fit: cover; object-position: 100% 0;">
                    </div>
                @endempty
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
                        <img src="{{ url($promotional->img[0]) }}" alt="#" style="height: 170px;width:288px">
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
                                <button value="{{ $item->game->game_name }}" class="btn btn-danger removeBtn" style="font-size: 13px;width: 83px">@lang('wishlist.btn.remove')</button>
                            </form>
                            {{-- <form action="/game/buy" method="POST" style="width: 45%">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $item->game_id }}">
                                <button type="submit" class="btn btn-primary" style="font-size: 13px; width: 83px">@lang('wishlist.btn.purchase')</button>
                            </form> --}}
                            <button class="btn btn-primary" style="width: 83px;font-size: 13px" data-toggle="modal" data-target="#exampleModal">@lang('wishlist.btn.purchase')</button>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
            <!-- Buy Game Modal -->
            <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@lang('gameDetail.buy_game') "{{ $item->game->game_name }}"</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/game/buy" method="POST">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="game_id" value="{{ $item->game_id }}">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="price"
                                        value="Rp {{ number_format($item->game->price, 2, ',', '.') }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <select name="payment" id=""
                                        class="form-control  @error('payment') is-invalid @enderror">
                                        <option selected disabled>@lang('gameDetail.payment_method')</option>
                                        <option value="credit_card" @if (old('payment') == 'credit_card') selected @endif>
                                            @lang('gameDetail.pay.1')
                                        </option>
                                        <option value="bank_transfer" @if (old('payment') == 'bank_transfer') selected @endif>
                                            @lang('gameDetail.pay.2')</option>
                                        <option value="paypal" @if (old('payment') == 'paypal') selected @endif>
                                            @lang('gameDetail.pay.3')</option>
                                    </select>
                                    @error('payment')
                                        <div class="invalid-feedback" style="color: white">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                            </div>
                            <div class="modal-footer button">
                                <button class="btn" type="submit">@lang('gameDetail.buy_btn')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Buy Game Modal -->
        @endforeach
    </div>
</div>
@endsection

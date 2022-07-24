@extends('partial.headerFooter')

@section('content')
    <?php
    $promotional = json_decode($game->promotional);
    ?>
    <!-- Start Item Details -->
    <section class="item-details section" style="padding-top:30px">
        <div class="container">
            <button onclick="history.back()" class="btn btn-outline-dark mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                &nbsp;
                @lang('gameDetail.go_back')
            </button>
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <?php
                                    $str = 'https://';
                                    $is_url = substr($promotional->img[0], 0, strlen($str)) === $str;
                                    ?>
                                    <img src="{{ $is_url ? '' : '/' }}{{ $promotional->img[0] }}" id="current"
                                        alt="#" data-id='0'>
                                </div>
                                <div class="images">
                                    @for ($i = 1; $i < count($promotional->img); $i++)
                                        <?php
                                        $str = 'https://';
                                        $is_url = substr($promotional->img[$i], 0, strlen($str)) === $str;
                                        ?>
                                        <img class="images-list" src="{{ $is_url ? '' : '/' }}{{ $promotional->img[$i] }}"
                                            alt="#" data-id='{{ $i }}'>
                                    @endfor
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <div class="d-flex align-items-center">
                                <div style="margin-right:20px">
                                    <?php
                                    $str = 'https://';
                                    $is_url = substr($promotional->logo, 0, strlen($str)) === $str;
                                    ?>
                                    <img src="{{$is_url ? '' : '/'}}{{ $promotional->logo }}" alt=""
                                        style="height: 100px; width:100px;border-radius:10px">
                                </div>
                                <div>
                                    <h2 class="title" style="font-size:40px;margin-bottom:5px">{{ $game->game_name }}
                                    </h2>
                                    <span class="text-primary">
                                        <a
                                            href="/developer/{{ $game->developer->id }}">{{ $game->developer->company_name }}</a>
                                    </span>
                                    <p class="category">
                                        <i class="lni lni-tag"></i>
                                        <a class="text-primary" href="/category/{{ $game->genre_id }}">
                                            {{ $game->gameGenre->genre_name }}
                                        </a>
                                        @foreach ($game->tagDetail as $item)
                                            <a class="text-primary" href="/tag/{{ $item->tag->id }}">
                                                {{ $item->tag->tag_name }}
                                            </a>
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            <p class="info-text text-success">
                                @lang('gameDetail.downloaded') {{ $total_download }} @lang('gameDetail.users') <br>
                                <span class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <em class="lni lni-star{{ floor($reviews->avg('rating')) < $i ? ' ' : '-filled' }}"
                                            style="width: 20px"></em>
                                    @endfor
                                </span>
                                <span class="text-secondary"> ({{ $reviews->avg('rating') }}/5), @lang('gameDetail.reviewed')
                                    {{ $reviews->count() }} @lang('gameDetail.users')</span>
                                <br>
                                @lang('gameDetail.content_rating') {{ $game->content_rating }}
                            </p>

                            <p class="info-text">{{ $game->short_desc }}</p>
                            <div class="bottom-content">
                                <h3 class="price">
                                    @if ($game->price == 0)
                                        Rp0,00 (@lang('gameDetail.free'))
                                    @else
                                        Rp{{ number_format($game->price, 2, ',', '.') }}
                                    @endif
                                </h3>
                                @if (!Auth::check())
                                    <p class="text-danger">* @lang('gameDetail.login')</p>
                                @else
                                    @if (Auth::user()->role == 'user')
                                        <div class="row align-items-end">
                                            @if (!$isBought)
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="button cart-button">
                                                        <button class="btn" style="width: 100%;" data-toggle="modal"
                                                            data-target="#exampleModal">@lang('gameDetail.buy_btn')</button>
                                                    </div>
                                                </div>
                                                @if (!$isOnWishlist)
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="wish-button">
                                                            <form action="/wishlist/add" method="post" style="width: 300px">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $game->id }}">
                                                                <button class="btn" type="submit"><i
                                                                        class="lni lni-heart"></i>
                                                                    @lang('gameDetail.add_wishlist')</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="wish-button">
                                                            <form action="/wishlist/remove" method="post" style="width: 300px">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $game->id }}">
                                                                <button class="btn removeBtn" value="{{ $game->game_name }}"><i
                                                                        class="lni lni-heart"></i>
                                                                    @lang('gameDetail.remove_wishlist')</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="button cart-button">
                                                        <a class="btn" href="/downloadGame/{{$game->game_data_path}}" style="padding-top:10px">@lang('gameDetail.download')</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="info-body custom-responsive-margin">
                                <h4>@lang('gameDetail.details')</h4>
                                <p>@lang('gameDetail.version') {{ $game->game_version }}</p>
                                <p>{{ $game->about_game }}</p>
                                <hr>
                                <h4>@lang('gameDetail.specification')</h4>
                                <ul class="normal-list">
                                    <li><span>@lang('gameDetail.spek.processor')</span> {{ $game->requirement_processor }}</li>
                                    <li><span>@lang('gameDetail.spek.os')</span> {{ $game->requirement_os }}</li>
                                    <li><span>@lang('gameDetail.spek.graphic')</span> {{ $game->requirement_graphic }}</li>
                                    <li><span>@lang('gameDetail.spek.memory')</span> {{ $game->requirement_memory }}</li>
                                    <li><span>@lang('gameDetail.spek.storage')</span> {{ $game->requirement_storage }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="info-body">
                                <h4>@lang('gameDetail.trailer')</h4>
                                <iframe width="100%" height="300" src="{{ $promotional->trailer }}">
                                </iframe>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="product-details-info">
                        <div class="single-block">
                            <div class="info-body custom-responsive-margin">
                                <h4>@lang('gameDetail.review')</h4>
                                {{-- @dump($myReview) --}}
                                <hr>

                                @if ($isBought)
                                    @if ($myReview == null)
                                        <div class="container-fluid"
                                            style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(56, 146, 53);border-radius:15px;padding:20px;color:white">
                                            <div style="color: white;">
                                                <span style="font-size: 20px">@lang('gameDetail.review1.1')</span>
                                            </div>
                                            <form action="/review/add" method="POST" style="margin-top:20px">
                                                @csrf
                                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                                <div class="mb-3">
                                                    <select name="rating"
                                                        class="form-control @error('rating') is-invalid @enderror"
                                                        required>
                                                        <option selected disabled>@lang('gameDetail.review1.2')</option>
                                                        <option value="5"
                                                            @if (old('rating') == '5') selected @endif>
                                                            @lang('gameDetail.review1.3')
                                                        </option>
                                                        <option value="4"
                                                            @if (old('rating') == '4') selected @endif>
                                                            @lang('gameDetail.review1.4')
                                                        </option>
                                                        <option value="3"
                                                            @if (old('rating') == '3') selected @endif>
                                                            @lang('gameDetail.review1.5')
                                                        </option>
                                                        <option value="2"
                                                            @if (old('rating') == '2') selected @endif>
                                                            @lang('gameDetail.review1.6')
                                                        </option>
                                                        <option value="1"
                                                            @if (old('rating') == '1') selected @endif>
                                                            @lang('gameDetail.review1.7')
                                                        </option>
                                                    </select>
                                                    @error('rating')
                                                        <div class="invalid-feedback" style="color: white">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <textarea placeholder="@lang('gameDetail.review_textarea')..." class="form-control" id="review-message" rows="8"
                                                        @error('comment') is-invalid @enderror" id="exampleInputText" name="comment" value={{ old('comment') }}></textarea>
                                                    @error('comment')
                                                        <div class="invalid-feedback" style="color: white">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">@lang('gameDetail.submit')</button>
                                            </form>
                                        </div>
                                    @else
                                        <?php
                                        $user = $myReview->user;
                                        ?>
                                        <div class="container-fluid"
                                            style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(81, 81, 206);border-radius:15px;padding:20px;color:white">
                                            <div style="margin-bottom:20px">
                                                <button class="btn btn-sm btn-secondary" data-toggle="modal"
                                                    data-target="#editReview">
                                                    <em class="lni lni-pencil" style="margin-right:5px"></em>
                                                    @lang('gameDetail.edit_review')</button>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->profile_url }}" alt=""
                                                    class="rounded-circle" style="height: 40px; width:40px">
                                                <strong style="margin-left:15px">{{ $user->name }}</strong>
                                            </div>
                                            <div style="margin-top:-5px;margin-left:0px"
                                                class="d-flex align-items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <em class="lni lni-star{{ floor($myReview->rating) < $i ? ' ' : '-filled' }} text-warning"
                                                        style="width: 20px"></em>
                                                @endfor
                                                <p>- {{ $myReview->created_at->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="div" style="margin-top:-35px">
                                                <p>{{ $myReview->comment }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @foreach ($reviews as $item)
                                    @if ($myReview == null || $item->id != $myReview->id)
                                        <?php
                                        $user = $item->user;
                                        ?>
                                        <div class="container-fluid"
                                            style="margin-top:10px;margin-bottom:25px;padding-left:0px;">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->profile_url }}" alt=""
                                                    class="rounded-circle" style="height: 40px; width:40px">
                                                <strong style="margin-left:15px">{{ $user->name }}</strong>
                                            </div>
                                            <div style="margin-top:-5px;margin-left:0px"
                                                class="d-flex align-items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <em class="lni lni-star{{ floor($item->rating) < $i ? ' ' : '-filled' }} text-warning"
                                                        style="width: 20px"></em>
                                                @endfor
                                                <p>- {{ $item->created_at->format('d/m/Y') }}</p>
                                            </div>
                                            <div class="div" style="margin-top:-35px">
                                                <p>{{ $item->comment }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                @if (!count($reviews))
                                    <h4>@lang('gameDetail.review_empty')</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="product-details-info">
                        <div class="single-block">
                            <div class="info-body custom-responsive-margin">
                                <h4>@lang('gameDetail.donation')</h4>
                                <hr>

                                @if ($isBought)
                                    <div class="container-fluid"
                                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(56, 146, 53);border-radius:15px;padding:20px;color:white">
                                        <div style="color: white;">
                                            <span style="font-size: 20px">@lang('gameDetail.support')</span>
                                        </div>
                                        <form action="/donation/add" method="POST" style="margin-top:20px">
                                            @csrf
                                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                                            <div class="mb-3">
                                                <select name="payment" id=""
                                                    class="form-control  @error('payment') is-invalid @enderror">
                                                    <option selected disabled>@lang('gameDetail.payment_method')</option>
                                                    <option value="credit_card"
                                                        @if (old('payment') == 'credit_card') selected @endif>
                                                        @lang('gameDetail.pay.1')
                                                    </option>
                                                    <option value="bank_transfer"
                                                        @if (old('payment') == 'bank_transfer') selected @endif>
                                                        @lang('gameDetail.pay.2')
                                                    </option>
                                                    <option value="paypal"
                                                        @if (old('payment') == 'paypal') selected @endif>
                                                        @lang('gameDetail.pay.3')</option>
                                                </select>
                                                @error('payment')
                                                    <div class="invalid-feedback" style="color: white">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input placeholder="@lang('gameDetail.donation_input')..." type="number"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="exampleInputText" name="amount" value="{{ old('amount') }}">
                                                @error('amount')
                                                    <div class="invalid-feedback" style="color: white">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <textarea placeholder="@lang('gameDetail.donation_textarea')..." class="form-control" id="review-message" rows="8"
                                                    @error('message') is-invalid @enderror id="exampleInputText" name="message" value={{ old('message') }}></textarea>
                                                @error('message')
                                                    <div class="invalid-feedback" style="color: white">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">@lang('gameDetail.submit')</button>
                                        </form>
                                    </div>
                                @endif

                                @foreach ($donations as $item)
                                    <?php $user = $item->user; ?>
                                    <div class="container-fluid"
                                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:{{ $item->amount < 150000 ? 'rgb(37, 43, 202)' : 'rgb(246, 39, 39)' }};border-radius:5px;padding:20px;color:white">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->profile_url }}" alt="" class="rounded-circle"
                                                style="height: 50px; width:50px">
                                            <div class="d-flex flex-column">
                                                <strong style="margin-left:15px">{{ $user->name }} - <span
                                                        style="font-size:11px">{{ $item->created_at->format('d/m/Y') }}</span>
                                                </strong>
                                                <strong style="margin-left:15px;font-size:20px">Rp{{ number_format($item->amount, 2, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                        <div class="div" style="margin-top:10px">
                                            <span>{{ $item->message }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                @if (!count($donations))
                                    <h4>@lang('gameDetail.no_donation')</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Item Details -->

    <!-- Buy Game Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('gameDetail.buy_game') "{{ $game->game_name }}"</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/game/buy" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="price"
                                value="Rp {{ number_format($game->price, 2, ',', '.') }}" disabled>
                        </div>
                        <div class="mb-3">
                            <select name="payment" id=""
                                class="form-select  @error('payment') is-invalid @enderror">
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
                    </div>
                    <div class="modal-footer button">
                        <button class="btn" type="submit">@lang('gameDetail.buy_btn')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Buy Game Modal -->

    @if ($myReview != null)
        <!-- Review Modal -->
        <div class="modal fade review-modal" id="editReview" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang('gameDetail.edit_review') : "{{ $game->game_name }}"</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/review/edit" method="POST">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="review_id" value="{{ $myReview->id }}">
                            <div class="mb-3">
                                <select name="rating" class="form-control @error('rating') is-invalid @enderror"
                                    required>
                                    <option selected disabled>@lang('gameDetail.review1.2')</option>
                                    <option value="5" @if (floor($myReview->rating) == 5) selected @endif>
                                        @lang('gameDetail.review1.3')
                                    </option>
                                    <option value="4" @if (floor($myReview->rating) == 4) selected @endif>
                                        @lang('gameDetail.review1.4')
                                    </option>
                                    <option value="3" @if (floor($myReview->rating) == 3) selected @endif>
                                        @lang('gameDetail.review1.5')
                                    </option>
                                    <option value="2" @if (floor($myReview->rating) == 2) selected @endif>
                                        @lang('gameDetail.review1.6')
                                    </option>
                                    <option value="1" @if (floor($myReview->rating) == 1) selected @endif>
                                        @lang('gameDetail.review1.7')
                                    </option>
                                </select>
                                @error('rating')
                                    <div class="invalid-feedback" style="color: white">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <textarea placeholder="@lang('gameDetail.review_textarea')..." class="form-control" id="review-message" rows="8"
                                    @error('comment') is-invalid @enderror" id="exampleInputText" name="comment">{{ $myReview->comment }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback" style="color: white">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer button">
                            <button class="btn" type="submit">@lang('gameDetail.edit_review')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Review Modal -->
    @endif

@endsection

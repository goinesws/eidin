@extends('partial.headerFooter')

@section('content')
    <?php
    $promotional = json_decode($game->promotional);
    ?>
    <!-- Start Item Details -->
    <section class="item-details section" style="padding-top:30px">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ $promotional->img[0] }}" id="current" alt="#" data-id='0'>
                                </div>
                                <div class="images">
                                    @for ($i = 1; $i < count($promotional->img); $i++)
                                        <img class="images-list" src="{{ $promotional->img[$i] }}" alt="#"
                                            data-id='{{ $i }}'>
                                    @endfor
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <div class="d-flex align-items-center">
                                <div style="margin-right:20px">
                                    <img src="{{ $promotional->logo }}" alt=""
                                        style="height: 100px; width:100px;border-radius:10px">
                                </div>
                                <div>
                                    <h2 class="title" style="font-size:40px;margin-bottom:5px">{{ $game->game_name }}
                                    </h2>
                                    <span class="text-primary">
                                        <a href="#">{{ $game->developer->company_name }}</a>
                                    </span>
                                    <p class="category">
                                        <i class="lni lni-tag"></i>
                                        <a class="text-primary" href="/category/{{ $game->genre_id }}">
                                            {{ $game->gameGenre->genre_name }}
                                        </a>
                                        @foreach ($game->tagDetail as $item)
                                            <a class="text-primary" href="/tag/{{ $game->genre_id }}">
                                                {{ $item->tag->tag_name }}
                                            </a>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            
                            <p class="info-text text-success">
                                Downloaded by {{$total_download}} user(s) <br>
                                <span class="text-warning">
                                    @for ($i = 1; $i <=5; $i++)
                                        <em class="lni lni-star{{ floor($reviews->avg('rating')) < $i ? ' ' : '-filled' }}"
                                            style="width: 20px"></em>
                                    @endfor
                                </span> 
                                <span class="text-secondary"> ({{$reviews->avg('rating')}}/5), reviewed by {{$reviews->count()}} user(s)</span>
                                <br>
                                Content Rating: {{ $game->content_rating }}
                            </p>
                            
                            <p class="info-text">{{ $game->short_desc }}</p>
                            <div class="bottom-content">
                                <h3 class="price">
                                    @if ($game->price == 0)
                                        Rp: 0,00 (Free)
                                    @else
                                        Rp: {{ number_format($game->price, 2, ',', '.') }}
                                    @endif
                                </h3>
                                @if (!Auth::check())
                                    <p class="text-danger">* Please login first to add the game to the wishlist</p>
                                @else
                                    @if (Auth::user()->role == 'user')
                                        <div class="row align-items-end">
                                            @if (!$isBought)
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="button cart-button">
                                                        <button class="btn" style="width: 100%;" data-toggle="modal"
                                                            data-target="#exampleModal">Buy Game</button>
                                                    </div>
                                                </div>
                                                @if (!$isOnWishlist)
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="wish-button">
                                                            <form action="/wishlist/add" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $game->id }}">
                                                                <button class="btn" type="submit"><i
                                                                        class="lni lni-heart"></i>
                                                                    Add To
                                                                    Wishlist</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="wish-button">
                                                            <form action="/wishlist/remove" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $game->id }}">
                                                                <button class="btn" type="submit"><i
                                                                        class="lni lni-heart"></i>
                                                                    Remove
                                                                    Wishlist</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="button cart-button">
                                                        <button class="btn" style="width: 100%;">Download Game</button>
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
                                <h4>Details</h4>
                                <p>Version: {{ $game->game_version }}</p>
                                <p>{{ $game->about_game }}</p>
                                <hr>
                                <h4>Minimum Specifications</h4>
                                <ul class="normal-list">
                                    <li><span>Processor:</span> {{ $game->requirement_processor }}</li>
                                    <li><span>Operating System:</span> {{ $game->requirement_os }}</li>
                                    <li><span>Graphic:</span> {{ $game->requirement_graphic }}</li>
                                    <li><span>Memory:</span> {{ $game->requirement_memory }}</li>
                                    <li><span>Storage:</span> {{ $game->requirement_storage }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="info-body">
                                <h4>Trailer Videos</h4>
                                <iframe width="100%" height="300" src="{{$promotional->trailer}}">
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
                                <h4>Reviews</h4>
                                {{-- @dump($myReview) --}}
                                <hr>

                                @if ($isBought)
                                    @if ($myReview == null)
                                        <div class="container-fluid"
                                            style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(56, 146, 53);border-radius:15px;padding:20px;color:white">
                                            <div style="color: white;">
                                                <span style="font-size: 20px">How was your experience?</span>
                                            </div>
                                            <form action="/review/add" method="POST" style="margin-top:20px">
                                                @csrf
                                                <input type="hidden" name="game_id" value="{{ $game->id }}">
                                                <div class="mb-3">
                                                    <select name="rating"
                                                        class="form-control @error('rating') is-invalid @enderror" required>
                                                        <option selected disabled>Select Star...</option>
                                                        <option value="5"
                                                            @if (old('rating') == '5') selected @endif>5 Star
                                                        </option>
                                                        <option value="4"
                                                            @if (old('rating') == '4') selected @endif>4 Star
                                                        </option>
                                                        <option value="3"
                                                            @if (old('rating') == '3') selected @endif>3 Star
                                                        </option>
                                                        <option value="2"
                                                            @if (old('rating') == '2') selected @endif>2 Star
                                                        </option>
                                                        <option value="1"
                                                            @if (old('rating') == '1') selected @endif>1 Star
                                                        </option>
                                                    </select>
                                                    @error('rating')
                                                        <div class="invalid-feedback" style="color: white">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <textarea placeholder="Write your review here.." class="form-control" id="review-message" rows="8"
                                                        @error('comment') is-invalid @enderror" id="exampleInputText" name="comment" value={{ old('comment') }}></textarea>
                                                    @error('comment')
                                                        <div class="invalid-feedback" style="color: white">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    @else
                                        <?php
                                        $user = $myReview->user;
                                        ?>
                                        <div class="container-fluid"
                                            style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(81, 81, 206);border-radius:15px;padding:20px;color:white">
                                            <div style="margin-bottom:20px">
                                                <button class="btn btn-sm btn-secondary"><em class="lni lni-pencil"
                                                        style="margin-right:5px"></em> Edit Review</button>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->profile_url }}" alt=""
                                                    class="rounded-circle" style="height: 40px; width:40px">
                                                <strong style="margin-left:15px">{{ $user->name }}</strong>
                                            </div>
                                            <div style="margin-top:-5px;margin-left:0px"
                                                class="d-flex align-items-center">
                                                @for ($i = 0; $i < 5; $i++)
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
                                                @for ($i = 0; $i < 5; $i++)
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
                                    <h4>Review Empty...</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="product-details-info">
                        <div class="single-block">
                            <div class="info-body custom-responsive-margin">
                                <h4>Donation List</h4>
                                <hr>

                                @if ($isBought)
                                    <div class="container-fluid"
                                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(56, 146, 53);border-radius:15px;padding:20px;color:white">
                                        <div style="color: white;">
                                            <span style="font-size: 20px">Support this Game!</span>
                                        </div>
                                        <form action="/donation/add" method="POST" style="margin-top:20px">
                                            @csrf
                                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                                            <div class="mb-3">
                                                <select name="payment" id=""
                                                    class="form-control  @error('payment') is-invalid @enderror">
                                                    <option selected disabled>Select Payment Method...</option>
                                                    <option value="credit_card"
                                                        @if (old('payment') == 'credit_card') selected @endif>Credit Card
                                                    </option>
                                                    <option value="bank_transfer"
                                                        @if (old('payment') == 'bank_transfer') selected @endif>Bank Transfer
                                                    </option>
                                                    <option value="paypal"
                                                        @if (old('payment') == 'paypal') selected @endif>Paypal</option>
                                                </select>
                                                @error('payment')
                                                    <div class="invalid-feedback" style="color: white">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input placeholder="Drop your donation..." type="number"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="exampleInputText" name="amount" value="{{ old('amount') }}">
                                                @error('amount')
                                                    <div class="invalid-feedback" style="color: white">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <textarea placeholder="Write your message here.." class="form-control" id="review-message" rows="8"
                                                    @error('message') is-invalid @enderror" id="exampleInputText" name="message" value={{ old('message') }}></textarea>
                                                @error('message')
                                                    <div class="invalid-feedback" style="color: white">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                                <strong style="margin-left:15px;font-size:20px">Rp:
                                                    {{ number_format($item->amount, 2, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                        <div class="div" style="margin-top:10px">
                                            <span>{{ $item->message }}</span>
                                        </div>
                                    </div>
                                @endforeach
                                @if (!count($donations))
                                    <h4>No Donations Yet..</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Item Details -->

    <!-- Review Modal -->
    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buy Game : "{{ $game->game_name }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                class="form-control  @error('payment') is-invalid @enderror">
                                <option selected disabled>Select Payment Method...</option>
                                <option value="credit_card" @if (old('payment') == 'credit_card') selected @endif>Credit Card
                                </option>
                                <option value="bank_transfer" @if (old('payment') == 'bank_transfer') selected @endif>Bank
                                    Transfer</option>
                                <option value="paypal" @if (old('payment') == 'paypal') selected @endif>Paypal</option>
                            </select>
                            @error('payment')
                                <div class="invalid-feedback" style="color: white">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                    </div>
                    <div class="modal-footer button">
                        <button class="btn" type="submit">Buy Game!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Review Modal -->

@endsection

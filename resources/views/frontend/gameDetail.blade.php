@extends('partial.headerFooter')

@section('content')
    <!-- Start Item Details -->
    <section class="item-details section" style="padding-top:30px">
        {{-- <div class="container" style="margin-bottom:30px">
            <h3>Game Detail</h3>
        </div> --}}
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <?php
                                    $promotional = json_decode($game->promotional);
                                    ?>
                                    <img src="{{ $promotional->placeholder }}" id="current" alt="#">
                                </div>
                                <div class="images">
                                    {{--  --}}
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{ $game->game_name }}</h2>
                            <p class="category">
                                <i class="lni lni-tag"></i> 
                                Category:
                                <a class="text-primary" href="/category/{{ $game->genre_id }}">
                                    {{ $game->gameGenre->genre_name }}
                                </a>
                            </p>
                            <p class="category">
                                #Tags :
                                @foreach ($game->tagDetail as $item)
                                    <a class="text-primary" href="/tag/{{ $game->genre_id }}">
                                        {{ $item->tag->tag_name }}
                                    </a>
                                @endforeach
                            </p>
                            <h3 class="price">Rp {{ number_format($game->price, 2, ',', '.') }}</h3>
                            <p class="info-text">Rating: {{ $game->content_rating }}</p>
                            <p class="info-text">{{ $game->short_desc }}</p>
                            <div class="bottom-content">
                                @if (!Auth::check())
                                    <p class="text-danger">* Please login first to add the game to the wishlist</p>
                                @else
                                    <div class="row align-items-end">
                                        @if (!$isBought)
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="button cart-button">
                                                    <button class="btn" style="width: 100%;">Buy Game</button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="button cart-button">
                                                    <button class="btn" style="width: 100%;">Download Game</button>
                                                </div>
                                            </div>
                                        @endif

                                        @if (!$isOnWishlist)
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="wish-button">
                                                    <form action="/wishlist/add" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $game->id }}">
                                                        <button class="btn" type="submit"><i class="lni lni-heart"></i>
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
                                                        <input type="hidden" name="id" value="{{ $game->id }}">
                                                        <button class="btn" type="submit"><i class="lni lni-heart"></i>
                                                            Remove
                                                            Wishlist</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
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
                                <p>{{ $game->about_game }}</p>
                                {{-- <h4>Features</h4>
                            <ul class="features">
                                <li>Capture 4K30 Video and 12MP Photos</li>
                                <li>Game-Style Controller with Touchscreen</li>
                                <li>View Live Camera Feed</li>
                                <li>Full Control of HERO6 Black</li>
                                <li>Use App for Dedicated Camera Operation</li>
                            </ul> --}}
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="info-body">
                                <h4>Minimum Specifications</h4>
                                <ul class="normal-list">
                                    <li><span>Processor:</span> {{ $game->requirement_processor }}</li>
                                    <li><span>Operating System:</span> {{ $game->requirement_os }}</li>
                                    <li><span>Graphic:</span> {{ $game->requirement_graphic }}</li>
                                    <li><span>Memory:</span> {{ $game->requirement_memory }}</li>
                                    <li><span>Storage:</span> {{ $game->requirement_storage }}</li>
                                </ul>
                                {{-- <h4>Shipping Options:</h4>
                            <ul class="normal-list">
                                <li><span>Courier:</span> 2 - 4 days, $22.50</li>
                                <li><span>Local Shipping:</span> up to one week, $10.00</li>
                                <li><span>UPS Ground Shipping:</span> 4 - 6 days, $18.00</li>
                                <li><span>Unishop Global Export:</span> 3 - 4 days, $25.00</li>
                            </ul> --}}
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
                                <hr>

                                <div class="container-fluid"
                                    style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(81, 81, 206);border-radius:15px;padding:20px;color:white">
                                    <div style="color: white;">
                                        <span style="font-size: 20px">My Reviews:</span>
                                    </div>
                                    <div style="margin-top:-5px;margin-left:0px" class="d-flex align-items-center">
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <p>2022/20/20</p>
                                    </div>
                                    <div class="div" style="margin-top:-35px">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, tempore! Eos maxime
                                            dolorum doloribus magni quis, provident deserunt odio laudantium repellendus
                                            ipsa tempora ipsam inventore nemo consectetur expedita nobis. Cupiditate!</p>
                                    </div>
                                </div>

                                <div class="container-fluid"
                                    style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(56, 146, 53);border-radius:15px;padding:20px;color:white">
                                    <div style="color: white;">
                                        <span style="font-size: 20px">How was your experience?</span>
                                    </div>
                                    <form action="/review/add" method="POST" style="margin-top:20px">
                                        @csrf
                                        <div class="mb-3">
                                            <select name="rating" id="" class="form-control">
                                                <option value="-">Select Star...</option>
                                                <option value="1">1 Star</option>
                                                <option value="2">2 Star</option>
                                                <option value="3">3 Star</option>
                                                <option value="4">4 Star</option>
                                                <option value="5">5 Star</option>
                                            </select>
                                            @error('star')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="Write Your Review..." type="text"
                                                class="form-control @error('review') is-invalid @enderror"
                                                id="exampleInputText" name="review">
                                            @error('review')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>


                                <div class="container-fluid" style="margin-top:10px;margin-bottom:25px;padding-left:0px;">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Auth::user()->profile_url }}" alt="" class="rounded-circle"
                                            style="height: 40px; width:40px">
                                        <strong style="margin-left:15px">{{ Auth::user()->name }}</strong>
                                    </div>
                                    <div style="margin-top:-5px;margin-left:0px" class="d-flex align-items-center">
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <em class="lni lni-star" style="width: 20px"></em>
                                        <p>2022/20/20</p>
                                    </div>
                                    <div class="div" style="margin-top:-35px">
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, tempore! Eos maxime
                                            dolorum doloribus magni quis, provident deserunt odio laudantium repellendus
                                            ipsa tempora ipsam inventore nemo consectetur expedita nobis. Cupiditate!</p>
                                    </div>
                                </div>


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

                                <div class="container-fluid"
                                    style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(56, 146, 53);border-radius:15px;padding:20px;color:white">
                                    <div style="color: white;">
                                        <span style="font-size: 20px">Support this Game!</span>
                                    </div>
                                    <form action="/donation/add" method="POST" style="margin-top:20px">
                                        @csrf
                                        <div class="mb-3">
                                            <select name="rating" id="" class="form-control">
                                                <option value="-">Select Payment Method...</option>
                                                <option value="credit_card">Credit Card</option>
                                                <option value="bank_transfer">Bank Transfer</option>
                                                <option value="paypal">Paypal</option>
                                            </select>
                                            @error('star')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="Drop your donation..." type="number"
                                                class="form-control @error('amount') is-invalid @enderror"
                                                id="exampleInputText" name="amount">
                                            @error('amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <input placeholder="Write a message..." type="text"
                                                class="form-control @error('comment') is-invalid @enderror"
                                                id="exampleInputText" name="comment">
                                            @error('comment')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>

                                {{-- loop --}}
                                <div class="container-fluid"
                                    style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(246, 39, 39);border-radius:5px;padding:20px;color:white">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Auth::user()->profile_url }}" alt="" class="rounded-circle"
                                            style="height: 50px; width:50px">
                                        <div class="d-flex flex-column">
                                            <strong style="margin-left:15px">{{ Auth::user()->name }}</strong>
                                            <strong style="margin-left:15px;font-size:20px">Rp:150k++</strong>
                                        </div>
                                    </div>
                                    <div class="div" style="margin-top:10px">
                                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, tempore! Eos
                                            maxime dolorum doloribus magni quis, provident deserunt odio laudantium
                                            repellendus ipsa tempora ipsam inventore nemo consectetur expedita nobis.
                                            Cupiditate!</span>
                                    </div>
                                </div>
                                <div class="container-fluid"
                                    style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:rgb(37, 43, 202);border-radius:5px;padding:20px;color:white">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Auth::user()->profile_url }}" alt="" class="rounded-circle"
                                            style="height: 50px; width:50px">
                                        <div class="d-flex flex-column">
                                            <strong style="margin-left:15px">{{ Auth::user()->name }}</strong>
                                            <strong style="margin-left:15px;font-size:20px">Rp:10k-150k</strong>
                                        </div>
                                    </div>
                                    <div class="div" style="margin-top:10px">
                                        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, tempore! Eos
                                            maxime dolorum doloribus magni quis, provident deserunt odio laudantium
                                            repellendus ipsa tempora ipsam inventore nemo consectetur expedita nobis.
                                            Cupiditate!</span>
                                    </div>
                                </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-name">Your Name</label>
                                <input class="form-control" type="text" id="review-name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-email">Your Email</label>
                                <input class="form-control" type="email" id="review-email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-subject">Subject</label>
                                <input class="form-control" type="text" id="review-subject" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-rating">Rating</label>
                                <select class="form-control" id="review-rating">
                                    <option>5 Stars</option>
                                    <option>4 Stars</option>
                                    <option>3 Stars</option>
                                    <option>2 Stars</option>
                                    <option>1 Star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">Review</label>
                        <textarea class="form-control" id="review-message" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer button">
                    <button type="button" class="btn">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Review Modal -->

@endsection

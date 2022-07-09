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
            <div class="product-details-info" style="margin-bottom:30px">
                <div class="single-block">
                    <h4>Developer Section</h4>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Info</h6>
                            <p style="margin-top:10px">
                                Date Published : {{ date_format(new DateTime($game->date_published), 'Y-m-d') }} <br>
                                Status : <span style="font-weight: bold"
                                    class="{{ ($game->status == 'pending' ? 'text-primary' : $game->status == 'published') ? 'text-success' : 'text-danger' }}">{{ ucwords($game->status) }}</span>
                                <br>
                                Last Version : {{ $game->game_version }} <br>
                                Last Update : {{ $game->updated_at->format('Y-m-d') }}
                            </p>
                        </div>
                        <div class="col-6">
                            <h6>Manage</h6>
                            <div class="d-flex" style="margin-top:10px">
                                <a href="/dev/game/updateInfo/{{request()->id}}" class="btn btn-primary" style="margin-right:20px">Update Game</a>
                                <a href="/dev/game/manageTrailerImage/{{request()->id}}" class="btn btn-primary">Manage Image & Trailer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <br>
                            <p class="info-text">{{ $game->short_desc }}</p>
                            <div class="bottom-content">
                                <h3 class="price">
                                    @if ($game->price == 0)
                                        Rp0,00 (@lang('gameDetail.free'))
                                    @else
                                        Rp{{ number_format($game->price, 2, ',', '.') }}
                                    @endif
                                </h3>
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

                                @foreach ($reviews as $item)
                                    <?php
                                    $user = $item->user;
                                    ?>
                                    <div class="container-fluid"
                                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ url($user->profile_url) }}" alt=""
                                                class="rounded-circle" style="height: 40px; width:40px">
                                            <strong style="margin-left:15px">{{ $user->name }}</strong>
                                        </div>
                                        <div style="margin-top:-5px;margin-left:0px" class="d-flex align-items-center">
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

                                @foreach ($donations as $item)
                                    <?php $user = $item->user; ?>
                                    <div class="container-fluid"
                                        style="margin-top:10px;margin-bottom:25px;padding-left:0px;background-color:{{ $item->amount < 150000 ? 'rgb(37, 43, 202)' : 'rgb(246, 39, 39)' }};border-radius:5px;padding:20px;color:white">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ url($user->profile_url) }}" alt=""
                                                class="rounded-circle" style="height: 50px; width:50px">
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
                                    <h4>@lang('gameDetail.no_donation')</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!-- End Item Details -->
@endsection

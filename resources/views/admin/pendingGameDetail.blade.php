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
                    <h4>Developer Info Section</h4>
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
                            @if ($game->admin_note != null)
                                <div class="alert alert-danger" role="alert" style="margin-top:10px">
                                        This game is already denied before, please review again the mistakes
                                    <br> <br>
                                    <strong>Message From Admin:</strong> <br>
                                    {{ $game->admin_note }}
                                </div>
                            @endif
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
                                <div class="col-lg-12 col-md-12 col-12 d-flex">
                                    <div class="button me-4">
                                        <button class="btn" style="width: 100%;">@lang('gameDetail.download')</button>
                                    </div>
                                    <div class="button me-4">
                                        <form action="/admin/detail/publish" method="post">
                                            @csrf
                                            <input type="hidden" name="game_id" value="{{ $game->id }}">
                                            <button type="submit" class="btn btn-success publishBtn" value="{{ $game->game_name }}"
                                                style="width: 100%; background-color:#06ca3a">@lang('gameDetail.publish')</button>
                                        </form>
                                    </div>
                                    <div class="button me-4">
                                        <button data-toggle="modal" data-target="#denyGame"
                                             class="btn btn-danger"
                                            style="width: 100%; background-color:#ce1919">@lang('gameDetail.deny')</button>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                </div>
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
    </section>
    <!-- End Item Details -->

    <!-- Buy Game Modal -->
    <div class="modal fade review-modal" id="denyGame" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deny Game "{{ $game->game_name }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/admin/detail/deny" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="game_id" value="{{ $game->id }}">
                        <div class="mb-3">
                            <label for="exampleInputText" class="form-label">Please Provide an information to the developer:</label>
                            <textarea placeholder="Insert Message Here..." name="admin_note" id="" cols="30" rows="10" class="form-control @error('admin_note') is-invalid @enderror"></textarea>
                            @error('admin_note')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer button">
                        <button class="btn" type="submit">Deny Game</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

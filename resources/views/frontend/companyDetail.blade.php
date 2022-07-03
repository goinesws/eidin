@extends('partial.headerFooter')

@section('content')
<?php
    $social_media = json_decode($company->social_media);
?>
<div style="margin-top: 50px;margin-bottom:50px">
    <div class="container d-flex justify-content-between">
        <div class="col-5 d-flex flex-column align-items-center justify-content-center">
            <img src="{{ $company->company_pic_url }}" alt="" class="rounded-circle" style="height: 350px; width:350px">
        </div>
        <div class="col-6">
            <div class="d-flex justify-content-between pb-3">
                <div style="width: 60%">
                    <h1>{{ $company->company_name }}</h1>
                    <h4>{{ $company->company_address }}, {{ $company->country }}</h4>
                </div>
                <a href="" class="btn btn-warning fs-5 m-auto" style="height: 45px"><i class="lni lni-pencil-alt"></i> Update</a>
            </div>
            <p>{{ $company->company_description }}</p>
            <div class="mt-3 mb-5 border border-3 border-primary"></div>
            <div class="d-flex">
                <div style="width: 30%">
                    <h5 class="text-secondary">Website</h5> <br>
                    <h5 class="text-secondary">Partner since</h5> <br>
                    <h5 class="text-secondary">Game uploaded</h5>
                </div>
                <div style="width: 70%">
                    <h5>: {{ $company->company_website }}</h5> <br>
                    <h5>: {{ $company->approval_date }}</h5> <br>
                    <h5>: {{ $games->count() }}</h5>
                </div>
            </div>
            <div class="mt-5 mb-3 border border-3 border-primary"></div>
            <div class="d-flex justify-content-start">
                @if ($social_media->facebook != null)
                    <a href="{{ $social_media->facebook }}" class="pe-2" style="width: 10%">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Facebook_f_logo_%282019%29.svg/900px-Facebook_f_logo_%282019%29.svg.png" alt="" style="height: 50px; width: 50px">
                    </a>
                @endif
                @if ($social_media->twitter != null)
                    <a href="{{ $social_media->twitter }}" class="pe-2" style="width: 10%">
                        <img src="http://tourbanyuwangi.com/wp-content/uploads/2018/05/twitter-round-logo-png-transparent-background-7.png" alt="" style="height: 50px; width: 50px">
                    </a>
                @endif
                @if ($social_media->instagram != null)
                    <a href="{{ $social_media->instagram }}" style="width: 10%">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/600px-Instagram_icon.png" alt="" style="height: 50px; width: 50px">
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <section class="pt-3" style="margin-top: 12px;" id="onsale">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title mb-3">
                        <h2>All Games</h2>
                    </div>
                </div>
            </div>
            <div class="row pb-5">
                @foreach ($games as $game)
                    <?php
                    $promotional = json_decode($game->promotional);
                    ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <div class="single-product" style="height: 370px;">
                            <a href="/game/{{ $game->id }}" class="product-image">
                                <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                                @if ($sale_game->where('game_id', $game->id)->count() > 0)
                                    <span class="sale-tag">-50%</span>
                                @endif
                            </a>
                            <div class="product-info">
                                <span class="category">
                                    <a href="/category/{{ $game->genre_id }}" class="text-dark">{{ $genres[$game->genre_id - 1]->genre_name }}</a>
                                </span>
                                <h4 class="title">
                                    <a href="/game/{{ $game->id }}">{{ $game->game_name }}</a>
                                </h4>
                                <ul class="review">
                                    <li><i class="lni lni-star-filled"></i></li>
                                    <li><span>{{ $ratings[$game->id] }} Ratings</span></li>
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
            </div>
        </div>
    </section>
</div>
@endsection

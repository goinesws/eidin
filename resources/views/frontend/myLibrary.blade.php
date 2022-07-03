@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    {{-- <h3 class="mb-5">Library</h3> --}}
    {{-- <p>@dump($item)</p> --}}
    <section class="pt-3" style="margin-top: 12px;" id="onsale">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Library</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($myGames as $item)
                    <?php
                    $promotional = json_decode($item->promotional);
                    ?>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Start Single Product -->
                        <div class="single-product" style="height: 270px;">
                            <a href="/game/{{ $item->id }}" class="product-image">
                                <img src="{{ $promotional->img[0] }}" alt="#" style="height: 170px;width:288px">
                            </a>
                            <div class="product-info" style="display:flex; justify-content:center; align-items:center; text-align:center">
                                <h4 class="title">
                                    <a href="/game/{{ $item->id }}">{{ $item->game_name }}</a>
                                </h4>                                
                            </div>
                        </div>
                        <!-- End Single Product -->
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- <div class="row">
        @foreach ($myGames as $item)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail mb-5" style="height: 400px; width:400px;">
                <?php
                    $promotional = json_decode($item->promotional);
                    ?>
                    <img class="card-img-top" src="{{ $promotional->img[0] }}"alt="#">
                    <div class="caption" style="display: flex; justify-content:center; align-items:center">
                        <h3><a href="/game/{{ $item->id }}">{{ $item->game_name }}</a></h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
</div>
@endsection
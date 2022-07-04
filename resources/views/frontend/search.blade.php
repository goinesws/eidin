@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <section class="pt-3" style="margin-top: 12px;" id="onsale">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Search Results for "{{ $request }}"</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    @foreach ($search_result as $sgame)
                        <div class="col-lg-6 col-md-6 col-12 mb-4">
                            <div class="single-banner position-relative"
                                style="background-image:url('frontend/images/banner/banner-1-bg.jpg'); height:270px">
                                <div class="content pt-4" style="padding-right:55%">
                                    <h2  class="d-flex align-items-center" style="height: 50px">{{ $sgame->game_name }}</h2>
                                    <p style="height: 70px;overflow:hidden">{{ $sgame->short_desc }}</p>
                                    <div class="button">
                                        <a href="/game/{{ $sgame->game_id }}" class="btn">View Details</a>
                                    </div>
                                    <?php
                                    $promotional = json_decode($sgame->promotional);
                                    ?>
                                    <img src="{{ $promotional->img[0] }}" alt=""
                                        class="position-absolute top-0 end-0" style="width: 45%; height:100%;">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

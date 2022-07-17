@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <section class="pt-3" style="margin-top: 12px;" id="onsale">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>@lang('search.request') "{{ $request }}"</h2>
                        @empty($search_result[0])
                            <p>@lang('search.zeroResults')<br>@lang('search.keyword')</p>
                            <div style="width: 300px; opacity: .3; margin:auto">
                                <img src="{{ asset('/img/icon.png') }}" alt="" class="pt-5 mt-3">
                                <img src="{{ asset('/img/logo.png') }}" alt="" style="height: 135px; width:300px;object-fit: cover; object-position: 100% 0;">
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="row">
                    @foreach ($search_result as $sgame)
                        <div class="col-lg-6 col-md-6 col-12 mb-4">
                            <div class="single-banner position-relative"
                                style="background-image:url('frontend/images/banner/bg.jpg'); height:270px">
                                <div class="content pt-4" style="padding-right:55%">
                                    <h2  class="d-flex align-items-center" style="height: 50px">{{ $sgame->game_name }}</h2>
                                    <p style="height: 70px;overflow:hidden">{{ $sgame->short_desc }}</p>
                                    <div class="button">
                                        <a href="/game/{{ $sgame->game_id }}" class="btn">View Details</a>
                                    </div>
                                    <?php
                                    $promotional = json_decode($sgame->promotional);
                                    ?>
                                    <img src="{{ url($promotional->img[0]) }}" alt=""
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

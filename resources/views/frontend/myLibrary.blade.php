@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <h3 class="mb-5">Library</h3>
    {{-- <p>@dump($item)</p> --}}

    <div class="row">
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
    </div>
</div>
@endsection
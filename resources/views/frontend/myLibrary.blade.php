@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <h3>library</h3>
    @foreach ($myGames as $item)
        <p>@dump($item)</p>
    @endforeach
</div>
@endsection
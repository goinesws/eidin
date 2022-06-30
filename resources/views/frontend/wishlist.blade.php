@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <h3>wishlist</h3>
    @foreach ($wishlists as $item)
        <p>@dump($item)</p>
    @endforeach
</div>
@endsection
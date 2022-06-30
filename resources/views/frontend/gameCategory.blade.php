@extends('partial.headerFooter')

@section('content')
<div class="container" style="margin-top: 20px;margin-bottom:20px">
    <h3>category</h3>
    @foreach ($games as $item)
        <p>@dump($item)</p>
    @endforeach
</div>
@endsection
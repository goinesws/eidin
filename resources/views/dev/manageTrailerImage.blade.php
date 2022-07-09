@extends('partial.headerFooter')

@section('content')
    <?php
    $promotional = json_decode($game->promotional);
    ?>
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <a href="/dev/game/{{$game->id}}" class="btn btn-outline-dark mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                &nbsp;
                @lang('gameDetail.go_back')
            </a>
            <h4 style="margin-top:20px">Update Game: {{ $game->game_name }}</h4>
            <h6>(Manage Trailers, Images and Logo)</h6>
            <p class="mb-5 mt-1">@lang('uploadGame.explanation')</p>


            {{-- logo --}}
            <h5>1. Logo
                <hr>
            </h5>
            <div class="d-flex justify-content-center">
                <img src="{{ $promotional->logo }}" id="current" alt="#" style="width:15vw">
            </div>
            <form action="/dev/updateGameLogo/{{ $game->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">Change Logo</label>
                    <input id="profileChange" type="file" name='logo'
                        class="custom-file-input form-control @error('logo') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;margin-top:5px">Change Logo!</button>
            </form>

            {{-- trailer --}}
            {{-- logo --}}
            <h5 style="margin-top:50px">2. Trailer
                <hr>
            </h5>
            <div class="info-body" style="margin-bottom:20px">
                <h4>@lang('gameDetail.trailer')</h4>
                <iframe width="100%" height="300" src="{{ $promotional->trailer }}">
                </iframe>
            </div>
            <form action="/dev/updateTrailerLink/{{ $game->id }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.trailer') *</label>
                    <input placeholder="https://www.youtube.com/embed/@lang('uploadGame.your_trailer')" type="text"
                        value="{{ $promotional->trailer }}" class="form-control @error('trailer') is-invalid @enderror"
                        name="trailer">
                    @error('trailer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;margin-top:5px">Update Link!</button>
            </form>

            <h5 style="margin-top:50px">3. In Game Images
                <hr>
            </h5>
            <?php
            $i = 0;
            ?>
            @foreach ($promotional->img as $item)
                <div style="margin-bottom:30px">
                    <div class="d-flex flex-column align-items-center">
                        <h5 style="text-center">Image - {{ $i+1 }} </h5>
                        <img src="{{ $item }}" id="current" alt="#" style="width:30vw;margin-top:10px">
                    </div>
                    <form action="/dev/updateGameImage/{{ $game->id }}/{{ $i }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file mb-3" style="margin-top:20px">
                            <label for="exampleInputText" class="form-label">@lang('uploadGame.promo_image') {{ $i + 1 }}</label>
                            <div class="row">
                                <div class="col-9">
                                    <input id="profileChange" type="file" name='updateImg'
                                        class="custom-file-input form-control @error('updateImg') is-invalid @enderror"
                                        id="customFile" accept="image/png, image/jpeg">
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-primary" type="submit">Change Image</button>
                                </div>
                            </div>
                            @error('updateImg')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                    @if (count($promotional->img) != 1)
                        <form action="/dev/deleteGameImg/{{ $game->id }}/{{ $i }}" method="POST"
                            style="margin-top:15px">
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete Image</button>
                        </form>
                    @endif
                </div>
                <?php $i++?>
            @endforeach
            <hr>
            @if (count($promotional->img) < 3)
                <form action="/dev/AddNewImg/{{ $game->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file mb-3" style="margin-top:20px">
                        <label for="exampleInputText" class="form-label">ADD NEW IMAGE</label>
                        <div class="row">
                            <div class="col-9">
                                <input id="profileChange" type="file" name='addImg'
                                    class="custom-file-input form-control @error('addImg') is-invalid @enderror"
                                    accept="image/png, image/jpeg">
                                @error('addImg')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-3">
                                <button class="btn btn-primary" type="submit" style="width: 100%">Add Image!</button>
                            </div>
                        </div>

                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

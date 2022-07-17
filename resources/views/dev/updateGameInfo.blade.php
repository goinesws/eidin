@extends('partial.headerFooter')

@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <button onclick="history.back()" class="btn btn-outline-dark mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                &nbsp;
                @lang('gameDetail.go_back')
            </button>
            <h4 style="margin-top:20px">@lang('gameDetail.update_game') : {{$game->game_name}}</h4>
            <p class="mb-5 mt-1">@lang('uploadGame.explanation')</p>
            <form action="/dev/updateGame/{{$game->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5>@lang('uploadGame.part1')
                    <hr>
                </h5>
                <p>@lang('uploadGame.part1_desc')</p>
                <div class="mb-3" style="margin-top: 20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.category') *</label>
                    <select name="genre_id" class="form-select @error('genre_id') is-invalid @enderror" disabled>
                        <option selected disabled>{{$game->gameGenre->genre_name}}</option>
                    </select>
                    @error('genre_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.name') *</label>
                    <input placeholder="@lang('uploadGame.game_name_placeholder')" type="text" value="{{$game->game_name}}"
                        class="form-control @error('game_name') is-invalid @enderror" name="game_name">
                    @error('game_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_version') *</label>
                    <input placeholder="@lang('uploadGame.game_version_placeholder')" type="text"  value="{{$game->game_version}}"
                        class="form-control @error('game_version') is-invalid @enderror" name="game_version">
                    @error('game_version')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_price') *</label>
                    <input placeholder="@lang('uploadGame.game_price_placeholder')" type="number" value="{{$game->price}}"
                        class="form-control @error('game_price') is-invalid @enderror" name="game_price">
                    @error('game_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.short_desc') *</label>
                    <textarea placeholder="@lang('uploadGame.short_desc_placeholder')" name="short_desc" id="" cols="30" rows="5"
                        class="form-control @error('short_desc') is-invalid @enderror">{{$game->short_desc}}</textarea>
                    @error('short_desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.about_game') *</label>
                    <textarea placeholder="@lang('uploadGame.about_game_placeholder')" name="about_game" id="" cols="30"
                        rows="10" class="form-control @error('about_game') is-invalid @enderror">{{$game->about_game}}</textarea>
                    @error('about_game')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.content_rating') *</label>
                    <select name="content_rating" class="form-select @error('content_rating') is-invalid @enderror">
                        <option selected disabled>@lang('uploadGame.contentratingplaceholder')</option>
                        <option value="PEGI 7" {{$game->content_rating == 'PEGI 7' ? 'selected' : ''}}>PEGI 7</option>
                        <option value="PEGI 12" {{$game->content_rating == 'PEGI 12' ? 'selected' : ''}}>PEGI 12</option>
                        <option value="ESRB EVERYONE 10+" {{$game->content_rating == 'ESRB EVERYONE 10+' ? 'selected' : ''}}>ESRB EVERYONE 10+</option>
                        <option value="ESRB MATURE 17+" {{$game->content_rating == 'ESRB MATURE 17+' ? 'selected' : ''}}>ESRB MATURE 17+</option>
                        <option value="TEEN" {{$game->content_rating == 'TEEN' ? 'selected' : ''}}>TEEN</option>
                    </select>
                    @error('content_rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">@lang('uploadGame.part4')
                    <hr>
                </h5>
                <p>@lang('uploadGame.part4_desc')</p>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_processor')*</label>
                    <input placeholder="@lang('uploadGame.minimum_processor_placeholder')" type="text"
                        class="form-control @error('processor') is-invalid @enderror" value="{{$game->requirement_processor}}" name="processor">
                    @error('processor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_os')*</label>
                    <input placeholder="@lang('uploadGame.minimum_os_placeholder')" type="text" value="{{$game->requirement_os}}"
                        class="form-control @error('os') is-invalid @enderror" name="os">
                    @error('os')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_memory')*</label>
                    <input placeholder="@lang('uploadGame.minimum_memory_placeholder')" type="text" value="{{$game->requirement_memory}}"
                        class="form-control @error('memory') is-invalid @enderror" name="memory">
                    @error('memory')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_graphics')*</label>
                    <input placeholder="@lang('uploadGame.minimum_graphics_placeholder')" type="text" value="{{$game->requirement_graphic}}"
                        class="form-control @error('graphic') is-invalid @enderror" name="graphic">
                    @error('graphic')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_storage')*</label>
                    <input placeholder="@lang('uploadGame.minimum_storage_placeholder')" type="text"
                        class="form-control @error('storage') is-invalid @enderror" value="{{$game->requirement_storage}}" name="storage">
                    @error('storage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"
                    style="width: 100%;margin-top:20px">@lang('gameDetail.update_game')!</button>
            </form>
        </div>
    </div>
@endsection

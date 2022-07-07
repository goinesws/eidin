@extends('partial.headerFooter')

@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <h4>@lang('uploadGame.title')</h4>
            <p class="mb-5 mt-1">@lang('uploadGame.explanation')</p>
            <form action="/dev/createGameData" method="POST" enctype="multipart/form-data">
                @csrf
                <h5>@lang('uploadGame.part1')
                    <hr>
                </h5>
                <p>@lang('uploadGame.part1_desc')</p>
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.category') *</label>
                    <select name="genre_id" class="form-select @error('genre_id') is-invalid @enderror">
                        <option selected disabled>@lang('uploadGame.categoryPlaceholder')</option>
                        @foreach ($category_nav as $item)
                            <option value="{{ $item->id }}" {{@old('genre_id') == $item->id ? 'selected' : ''}}>{{ $item->genre_name }}</option>
                        @endforeach
                    </select>
                    @error('genre_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.name') *</label>
                    <input placeholder="@lang('uploadGame.game_name_placeholder')" type="text" value="{{@old('game_name')}}"
                        class="form-control @error('game_name') is-invalid @enderror" name="game_name">
                    @error('game_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_version') *</label>
                    <input placeholder="@lang('uploadGame.game_version_placeholder')" type="text"  value="{{@old('game_version')}}"
                        class="form-control @error('game_version') is-invalid @enderror" name="game_version">
                    @error('game_version')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_price') *</label>
                    <input placeholder="@lang('uploadGame.game_price_placeholder')" type="number" value="{{@old('game_price')}}"
                        class="form-control @error('game_price') is-invalid @enderror" name="game_price">
                    @error('game_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.short_desc') *</label>
                    <textarea placeholder="@lang('uploadGame.short_desc_placeholder')" name="short_desc" id="" cols="30" rows="5"
                        class="form-control @error('short_desc') is-invalid @enderror">{{@old('short_desc')}}</textarea>
                    @error('short_desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.about_game') *</label>
                    <textarea placeholder="@lang('uploadGame.about_game_placeholder')" name="about_game" id="" cols="30"
                        rows="10" class="form-control @error('about_game') is-invalid @enderror">{{@old('about_game')}}</textarea>
                    @error('about_game')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.content_rating') *</label>
                    <select name="content_rating" class="form-select @error('content_rating') is-invalid @enderror">
                        <option selected disabled>@lang('uploadGame.contentratingplaceholder')</option>
                        <option value="PEGI 7" {{@old('content_rating') == 'PEGI 7' ? 'selected' : ''}}>PEGI 7</option>
                        <option value="PEGI 12" {{@old('content_rating') == 'PEGI 12' ? 'selected' : ''}}>PEGI 12</option>
                        <option value="ESRB EVERYONE 10+" {{@old('content_rating') == 'ESRB EVERYONE 10+' ? 'selected' : ''}}>ESRB EVERYONE 10+</option>
                        <option value="ESRB MATURE 17+" {{@old('content_rating') == 'ESRB MATURE 17+' ? 'selected' : ''}}>ESRB MATURE 17+</option>
                        <option value="TEEN" {{@old('content_rating') == 'TEEN' ? 'selected' : ''}}>TEEN</option>
                    </select>
                    @error('content_rating')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">@lang('uploadGame.part2')
                    <hr>
                </h5>

                <p>@lang('uploadGame.part2_desc')</p>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.logo') *</label>
                    <input id="profileChange" type="file" name='logo'
                        class="custom-file-input form-control @error('logo') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('logo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.trailer') *</label>
                    <input placeholder="https://www.youtube.com/embed/@lang('uploadGame.your_trailer')" type="text" value="{{@old('trailer')}}"
                        class="form-control @error('trailer') is-invalid @enderror" name="trailer">
                    @error('trailer')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.promo_image') 1 *</label>
                    <input id="profileChange" type="file" name='img1'
                        class="custom-file-input form-control @error('img1') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('img1')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.promo_image') 2 (@lang('uploadGame.optional'))</label>
                    <input id="profileChange" type="file" name='img2'
                        class="custom-file-input form-control @error('img2') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('img2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.promo_image') 3 (@lang('uploadGame.optional'))</label>
                    <input id="profileChange" type="file" name='img3'
                        class="custom-file-input form-control @error('img3') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('img3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">@lang('uploadGame.part3')
                    <hr>
                </h5>

                <p>@lang('uploadGame.part3_desc')</p>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_data')*</label>
                    <input id="profileChange" type="file" name='game_data'
                        class="custom-file-input form-control @error('game_data') is-invalid @enderror" id="customFile"
                        accept=".zip, .rar">
                    @error('game_data')
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
                        class="form-control @error('processor') is-invalid @enderror" value="{{@old('processor')}}" name="processor">
                    @error('processor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_os')*</label>
                    <input placeholder="@lang('uploadGame.minimum_os_placeholder')" type="text" value="{{@old('os')}}"
                        class="form-control @error('os') is-invalid @enderror" name="os">
                    @error('os')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_memory')*</label>
                    <input placeholder="@lang('uploadGame.minimum_memory_placeholder')" type="text" value="{{@old('memory')}}"
                        class="form-control @error('memory') is-invalid @enderror" name="memory">
                    @error('memory')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_graphics')*</label>
                    <input placeholder="@lang('uploadGame.minimum_graphics_placeholder')" type="text" value="{{@old('graphic')}}"
                        class="form-control @error('graphic') is-invalid @enderror" name="graphic">
                    @error('graphic')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.minimum_storage')*</label>
                    <input placeholder="@lang('uploadGame.minimum_storage_placeholder')" type="text"
                        class="form-control @error('storage') is-invalid @enderror" value="{{@old('storage')}}" name="storage">
                    @error('storage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary"
                    style="width: 100%;margin-top:20px">@lang('uploadGame.submit')</button>
            </form>
        </div>
    </div>
@endsection

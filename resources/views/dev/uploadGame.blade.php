@extends('partial.headerFooter')

@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <h4>@lang('uploadGame.title')</h4> <br>
            <p class="mb-5">@lang('uploadGame.explanation')</p>
            <form action="/dev/createGameData" method="POST" enctype="multipart/form-data">
                @csrf
                <h5>Part 1. Game info
                    <hr>
                </h5>
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
                    <input placeholder="Insert your cool game title!" type="text" value="{{@old('game_name')}}"
                        class="form-control @error('game_name') is-invalid @enderror" name="game_name">
                    @error('game_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_version') *</label>
                    <input placeholder="Example: 1.0" type="text"  value="{{@old('game_version')}}"
                        class="form-control @error('game_version') is-invalid @enderror" name="game_version">
                    @error('game_version')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_price') *</label>
                    <input placeholder="Define Your Price!" type="number" value="{{@old('game_price')}}"
                        class="form-control @error('game_price') is-invalid @enderror" name="game_price">
                    @error('game_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.short_desc') *</label>
                    <textarea placeholder="Tell us about this game!" name="short_desc" id="" cols="30" rows="5"
                        class="form-control @error('short_desc') is-invalid @enderror">{{@old('short_desc')}}</textarea>
                    @error('short_desc')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.about_game') *</label>
                    <textarea placeholder="Tell us about this game more detail!" name="about_game" id="" cols="30"
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

                <h5 style="margin-top:40px">Part 2. Promotional
                    <hr>
                </h5>

                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci optio praesentium consectetur autem
                    facere perspiciatis maiores temporibus quidem incidunt aspernatur doloremque expedita velit odit
                    commodi, blanditiis enim iusto, doloribus reiciendis!</p>

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
                    <input placeholder="https://www.youtube.com/embed/your-trailer" type="text" value="{{@old('trailer')}}"
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
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.promo_image') 2 (optional)</label>
                    <input id="profileChange" type="file" name='img2'
                        class="custom-file-input form-control @error('img2') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('img2')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.promo_image') 3 (optional)</label>
                    <input id="profileChange" type="file" name='img3'
                        class="custom-file-input form-control @error('img3') is-invalid @enderror" id="customFile"
                        accept="image/png, image/jpeg">
                    @error('img3')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">Part 3. Game Data
                    <hr>
                </h5>

                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci optio praesentium consectetur autem
                    facere perspiciatis maiores temporibus quidem incidunt aspernatur doloremque expedita velit odit
                    commodi, blanditiis enim iusto, doloribus reiciendis!</p>

                <div class="custom-file mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">@lang('uploadGame.game_data')*</label>
                    <input id="profileChange" type="file" name='game_data'
                        class="custom-file-input form-control @error('game_data') is-invalid @enderror" id="customFile"
                        accept=".zip, .rar">
                    @error('game_data')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">Part 4. Set Minimum Spec
                    <hr>
                </h5>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci optio praesentium consectetur autem
                    facere perspiciatis maiores temporibus quidem incidunt aspernatur doloremque expedita velit odit
                    commodi, blanditiis enim iusto, doloribus reiciendis!</p>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">Minimum Processor*</label>
                    <input placeholder="Example: Dual Core 2.4 GHz" type="text"
                        class="form-control @error('processor') is-invalid @enderror" value="{{@old('processor')}}" name="processor">
                    @error('processor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">Minimum OS*</label>
                    <input placeholder="Example: Windows 7, macOS Mojave" type="text" value="{{@old('os')}}"
                        class="form-control @error('os') is-invalid @enderror" name="os">
                    @error('os')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">Minimum Memory*</label>
                    <input placeholder="Example: 2.5 GB RAM" type="text" value="{{@old('memory')}}"
                        class="form-control @error('memory') is-invalid @enderror" name="memory">
                    @error('memory')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">Minimum Graphic*</label>
                    <input placeholder="Example: 256 MB Video Memory" type="text" value="{{@old('graphic')}}"
                        class="form-control @error('graphic') is-invalid @enderror" name="graphic">
                    @error('graphic')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" style="margin-top:20px">
                    <label for="exampleInputText" class="form-label">Minimum Storage*</label>
                    <input placeholder="Example: 4 GB" type="text"
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

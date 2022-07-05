@extends('partial.headerFooter')

@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <div class="d-flex flex-row mb-3 me-4">
                <h4 class="pt-1">
                    Developer Registration
                </h4> <br>
            </div>
            <p style="margin-bottom:20px">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus quae, quidem nobis natus illo fugit ab omnis vel iste, sapiente molestias modi illum laboriosam cupiditate quos dolores? Tempore, ratione possimus.</p>
            <form action="/editMyProfile/edit" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="disabled form-label">@lang('register.email')</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="disabledInput"
                        name="email" placeholder="" disabled>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('editUserProfile.full_name')</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputText"
                        name="name" placeholder="" value="">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">@lang('editUserProfile.username')</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                        id="exampleInputText1" name="username" placeholder=""
                        value="">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('editUserProfile.country')</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="exampleInputText"
                        name="country" placeholder="" value="">
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if ($errors->any())
                    <div class="text-center text-danger mb-2">{{ $errors->first() }}</div>
                @endif
                <button type="submit" class="btn btn-primary" style="width: 100%">@lang('editUserProfile.update')</button>
            </form>
        </div>
    </div>
@endsection

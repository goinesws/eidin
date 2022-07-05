@extends('partial.headerFooter')

@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <button type="button" class="btn btn-outline-dark mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                &nbsp;
                Go Back
            </button>
            <div class="d-flex flex-row mb-3 me-4">
                <h4 class="pt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 24 24">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                    @lang('editUserProfile.edit_profile')
                </h4> <br>
            </div>
            <form action="/editMyProfile/edit" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="disabled form-label">@lang('register.email')</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="disabledInput"
                        name="email" placeholder="{{ $User->email }}" disabled>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('editUserProfile.full_name')</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputText"
                        name="name" placeholder="{{ $User->name }}" value="{{ $User->name }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">@lang('editUserProfile.username')</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                        id="exampleInputText1" name="username" placeholder="{{ $User->username }}"
                        value="{{ $User->username }}">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputText" class="form-label">@lang('editUserProfile.country')</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="exampleInputText"
                        name="country" placeholder="{{ $User->country }}" value="{{ $User->country }}">
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

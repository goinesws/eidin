@extends('partial.headerFooter')

@section('content')
<div class="pt-5 pb-5" style="background-color: #f9f9f9;">
    <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
        <h4>@lang('devRegistration.registration')</h4> <br>
        <p class="mb-5">@lang('devRegistration.explanation')</p>
        <form action="/dev-registration/auth" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.name')</label>
                <input type="text" class="form-control @error('company-name') is-invalid @enderror" id="exampleInputText" name="company_name">
                @error('company-name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.address')</label>
                <input type="text" class="form-control @error('company-address') is-invalid @enderror" id="exampleInputText" name="company_address">
                @error('company-address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.country')</label>
                <input type="text" class="form-control @error('country') is-invalid @enderror" id="exampleInputText" name="country">
                @error('country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.website')</label>
                <input type="text" class="form-control @error('company-website') is-invalid @enderror" id="exampleInputText" name="company_website">
                @error('company-website')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.desc')</label>
                <input type="text" class="form-control @error('company-description') is-invalid @enderror" id="exampleInputText" name="company_description">
                @error('company-description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="custom-file mb-5" style="margin-top:20px">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.photo')</label>
                <input id="profileChange" type="file" name='photo'
                    class="custom-file-input form-control @error('photo') is-invalid @enderror" id="customFile"
                    accept="image/png, image/jpeg">
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <h5>@lang('devRegistration.bank')</h5> <br>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.bank-name')</label>
                <input type="text" class="form-control @error('bank-name') is-invalid @enderror" id="exampleInputText" name="bankName">
                @error('bank-name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="exampleInputText" class="form-label">@lang('devRegistration.bank-number')</label>
                <input type="number" class="form-control @error('bank-number') is-invalid @enderror" id="exampleInputText" name="bankAccNumber">
                @error('bank-number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <h5>@lang('devRegistration.sns')</h5> <br>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">Facebook</label>
                <input type="text" class="form-control @error('bank-name') is-invalid @enderror" id="exampleInputText" name="fb" placeholder="https://facebook.com/company-facebook">
                @error('bank-name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputText" class="form-label">Twitter</label>
                <input type="text" class="form-control @error('bank-number') is-invalid @enderror" id="exampleInputText" name="twt" placeholder="https://twitter.com/company-twitter">
                @error('bank-number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-5">
                <label for="exampleInputText" class="form-label">Instagram</label>
                <input type="text" class="form-control @error('bank-number') is-invalid @enderror" id="exampleInputText" name="ig" placeholder="https://instagram.com/company-instagram">
                @error('bank-number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            @if ($errors->any())
                <div class="text-center text-danger mb-2">{{ $errors->first() }}</div>
            @endif
            <button type="submit" class="btn btn-primary" style="width: 100%">@lang('register.register')</button>
        </form>
    </div>
</div>
@endsection

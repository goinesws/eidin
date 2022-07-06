@extends('partial.headerFooter')

<?php
    $bank = json_decode($developer->bank_account);
    $sns = json_decode($developer->social_media);
?>

@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <a href="/myProfile" type="button" class="btn btn-outline-dark mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                &nbsp;
                Go Back
            </a>
            <div class="d-flex flex-row mb-3 me-4">
                <h4 class="pt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        class="bi bi-pencil-square" viewBox="0 0 24 24">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                    @lang('editUserProfile.edit_profile') {{-- change this --}}
                </h4> <br>
            </div>
                <h4>@lang('devRegistration.registration')</h4> <br>
                <p class="mb-5">@lang('devRegistration.explanation')</p>
                <form action="{{ route('editCompanyProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.name')</label>
                        <input type="text" class="form-control @error('company-name') is-invalid @enderror" id="exampleInputText" name="company_name" value="{{ $developer->company_name }}">
                        @error('company-name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.address')</label>
                        <input type="text" class="form-control @error('company-address') is-invalid @enderror" id="exampleInputText" name="company_address" value="{{ $developer->company_address }}">
                        @error('company-address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.country')</label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" id="exampleInputText" name="country" value="{{ $developer->country }}">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.website')</label>
                        <input type="text" class="form-control @error('company-website') is-invalid @enderror" id="exampleInputText" name="company_website" value="{{ $developer->company_website }}">
                        @error('company-website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.desc')</label>
                        <input type="text" class="form-control @error('company-description') is-invalid @enderror" id="exampleInputText" name="company_description" value="{{ $developer->company_description }}">
                        @error('company-description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <h5>@lang('devRegistration.bank')</h5> <br>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.bank-name')</label>
                        <input type="text" class="form-control @error('bank-name') is-invalid @enderror" id="exampleInputText" name="bankName" value="{{ $bank->bank_name }}">
                        @error('bank-name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="exampleInputText" class="form-label">@lang('devRegistration.bank-number')</label>
                        <input type="number" class="form-control @error('bank-number') is-invalid @enderror" id="exampleInputText" name="bankAccNumber" value="{{ $bank->bank_account_number }}">
                        @error('bank-number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <h5>@lang('devRegistration.sns')</h5> <br>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">Facebook</label>
                        <input type="text" class="form-control @error('bank-name') is-invalid @enderror" id="exampleInputText" name="fb" value="{{ $sns->facebook }}">
                        @error('bank-name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label">Twitter</label>
                        <input type="text" class="form-control @error('bank-number') is-invalid @enderror" id="exampleInputText" name="twt" value="{{ $sns->twitter }}">
                        @error('bank-number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="exampleInputText" class="form-label">Instagram</label>
                        <input type="text" class="form-control @error('bank-number') is-invalid @enderror" id="exampleInputText" name="ig" value="{{ $sns->instagram }}">
                        @error('bank-number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($errors->any())
                        <div class="text-center text-danger mb-2">{{ $errors->first() }}</div>
                    @endif
                    <button type="submit" class="btn btn-primary" style="width: 100%">Update</button> {{-- change this --}}
                </form>
            </div>
    </div>
@endsection

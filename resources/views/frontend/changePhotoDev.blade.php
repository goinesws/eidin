@extends('partial.headerFooter')
<?php
    $dev = App\Models\Developer::where('user_id', Auth::user()->id)->first();
?>
@section('content')
    <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
        <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
            <a href="/developer" type="button" class="btn btn-outline-dark mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
                &nbsp;
                Go Back
            </a>
            <div class="container d-flex flex-column align-items-center">
                <h4 style="margin-bottom:20px">Change Photo</h4>
                <?php
                $str = 'https://';
                $is_url = (substr(Auth::user()->profile_url, 0, strlen($str)) === $str)
                ?>
                <img src="{{$is_url ? '' : '/'}}{{ $dev->company_pic_url }}" alt="" id="editProfileShow" class="rounded-circle"
                    style="height: 300px; width:300px">
                <form action="{{ route('photoDevUpdate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file" style="margin-top:20px">
                        <input id="profileChange" type="file" name='photo'
                            class="custom-file-input form-control @error('photo') is-invalid @enderror" id="customFile"
                            accept="image/png, image/jpeg">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top: 20px">
                        <button type="submit" class="btn btn-primary d-flex align-items-center"
                            style="margin-top:10px"><span>Change Photo!</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

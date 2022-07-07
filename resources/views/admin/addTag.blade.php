@extends('partial.headerFooter')

@section('content')
    <div class="d-flex justify-content-center pt-4 pb-4" style="background-color: #f9f9f9;">
        <div class="d-flex flex-column mt-4" style="width: 60rem">
            <div class="pt-5 pb-5" style="background-color: #f9f9f9;">
                <div class="m-auto p-5 border shadow" style="width: 50%; border-radius:20px; background-color: #ffffff;">
                    <a href="/admin/manage-tags" type="button" class="btn btn-outline-dark mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        &nbsp;
                        Go Back
                    </a>
                    <div class="d-flex flex-row mb-5 me-4">
                        <h4 class="pt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                            </svg>
                            Add Tag
                        </h4> <br>
                    </div>
                    <form action="/admin/add-tag/add" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="newTagName" class="form-label"> Tag Name</label>
                            <input type="text" class="form-control @error('new_tag_name') is-invalid @enderror"
                                id="newTagName" name="new_tag_name">
                        </div>
                        @if ($errors->any())
                            <div class="text-center text-danger mb-2">{{ $errors->first() }}</div>
                        @endif
                        <button type="submit" class="btn btn-primary" style="width: 100%">Add Tag</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('partial.headerFooter')

@section('content')
    <div class="d-flex justify-content-center mt-4 mb-4">
        <div class="d-flex flex-column mt-4">
            <h3 class="text-center">@lang('manageTagGenre.manageGenre')</h3>
            <div class="mt-1 mb-1">
                <a href="/admin/add-genre/"type="button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    @lang('manageTagGenre.addGenre')
                </a>
            </div>
            <table class="table  table-hover mt-2 mb-2" style="width: 50rem">
                <thead>
                    <tr style="font-size: 16px" class="text-center">
                        <th scope="col">@lang('manageTagGenre.no')</th>
                        <th scope="col">@lang('manageTagGenre.genre')</th>
                        <th scope="col">@lang('manageTagGenre.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Fill with genres --}}
                    @foreach ($Genres as $genre)
                        <tr style="font-size: 16px" class="text-center">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $genre->genre_name }}</td>
                            <td>
                                <div class="d-flex flex-row mb-3 justify-content-center">
                                    <a href="/admin/update-genre/{{ $genre->id }}" type="button"
                                        class="btn btn-primary btn-sm ms-3 me-3">@lang('manageTagGenre.update')</a>
                                    <form action="/admin/manage-genres/{{ $genre->id }}/delete" method="POST">
                                        @csrf
                                        <button value="{{ $genre->genre_name }}" class="btn btn-danger btn-sm ms-3 me-3 formBtn">
                                            @lang('manageTagGenre.delete')
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-3">
            </div>
        </div>
    </div>
@endsection

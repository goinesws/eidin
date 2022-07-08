@extends('partial.headerFooter')

@section('content')
    <div class="d-flex justify-content-center mt-4 mb-4">
        <div class="d-flex flex-column mt-4">
            <h3 class="text-center">@lang('manageTagGenre.manageTag')</h3>
            <div class="mt-1 mb-1">
                <a href="/admin/add-tag/"type="button" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-plus-lg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                    </svg>
                    @lang('manageTagGenre.addTag')
                </a>
            </div>
            <table class="table  table-hover mt-2 mb-2" style="width: 50rem">
                <thead>
                    <tr style="font-size: 16px" class="text-center">
                        <th scope="col">@lang('manageTagGenre.no')</th>
                        <th scope="col">@lang('manageTagGenre.tag')</th>
                        <th scope="col">@lang('manageTagGenre.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Tags as $tag)
                        <tr class="text-center" style="font-size: 16px">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tag->tag_name }}</td>
                            <td>
                                <div class="d-flex flex-row mb-3 justify-content-center">
                                    <a href="/admin/update-tag/{{ $tag->id }}" type="button"
                                        class="btn btn-primary btn-sm ms-3 me-3 {{ $tag->id == 1 ? 'disabled' : '' }} {{ $tag->id == 2 ? 'disabled' : '' }} {{ $tag->id == 3 ? 'disabled' : '' }}">@lang('manageTagGenre.update')</a>
                                    <form action="/admin/manage-tags/{{ $tag->id }}/delete" method="POST">
                                        @csrf
                                        <button type="submit" {{ $tag->id == 1 ? 'disabled' : '' }}
                                            {{ $tag->id == 2 ? 'disabled' : '' }} {{ $tag->id == 3 ? 'disabled' : '' }}
                                            class="btn btn-danger btn-sm ms-3 me-3">
                                            @lang('manageTagGenre.delete')
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-3"></div>
        </div>
    </div>
@endsection

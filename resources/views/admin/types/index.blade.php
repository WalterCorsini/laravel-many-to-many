@extends('layouts.admin')

@section('content')
    <div class="container">
        <table class="table table-striped mt-5">
            <tr>
                <th scope="col">
                    id
                </th>
                <th scope="col">
                    Name
                </th>
                <th scope="col">
                    Color
                </th>
                <th scope="col">
                    Button
                </th>
            </tr>

            @foreach ($typeList as $curElem)
                <tr>
                    <td>
                        {{ $curElem->id }}
                    </td>
                    <td>
                        {{ $curElem->name }}
                    </td>
                    <td>
                        {{ $curElem->color }}
                    </td>
                    {{-- button --}}
                    <td>
                        <div class="d-flex gap-2">
                            {{-- edit btn --}}
                            <a class="btn btn-success" href="{{ route('admin.types.edit', ['type' => $curElem->id]) }}">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            {{-- /edit btn --}}

                            {{-- delete btn --}}
                            <form class="delete" action="{{ route('admin.types.destroy', ['type' => $curElem->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button data-title="{{ $curElem->name }}" class="btn btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            {{-- /delete btn --}}
                        </div>

                        @include('partials.modal-softdeletes')


                    </td>
                    {{-- button --}}
                </tr>
            @endforeach
        </table>
    </div>
@endsection

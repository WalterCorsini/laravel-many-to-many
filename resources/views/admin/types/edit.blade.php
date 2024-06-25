@extends('layouts.admin')

@section('content')
    <h1 class="text-center mt-5">Modifica :</h1>
    <div class="mt-5 w-50 m-auto">
        @include('partials.errors')
    </div>
    <form class="w-50 m-auto d-flex flex-column pt-5" action="{{ route('admin.types.update', ['type' => $element->id]) }}" method="POST">
        @csrf
        @method('PUT')

            {{-- name --}}
            <label for="name"> Nome: </label>
            <input type="text" id="name" name="name" value="{{old('name', $element->name )}}">
            {{-- /name --}}

            {{-- type --}}
            <label for="color"> Colore: </label>
            <select id="color" name="color">
                <option value="">seleziona</option>

                @foreach ($typeList as $type)
                    <option @selected(@old('color',$type->color == $element->color)) value="{{$type->color}}">{{ $type->color }}</option>
                @endforeach

            </select>
            {{-- /type --}}

        <button type="submit" class="btn btn-success mt-5 w-25 m-auto">Aggiorna</button>
    </form>
@endsection

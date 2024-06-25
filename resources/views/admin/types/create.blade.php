@extends('layouts.admin')

@section('content')
<h1 class="text-center mt-5">Aggiungi Tipo: </h1>
<div class="mt-5 w-50 m-auto">
    @include('partials.errors')
</div>
<form class="w-50 m-auto d-flex flex-column pt-5"
    action="{{ route('admin.types.store') }}"
    method="POST">
    @csrf
{{-- name --}}
<label for="name"> Nome: </label>
<input type="text" id="name" name="name">
{{-- /name --}}

{{-- type --}}
<label for="color"> Colore: </label>
<select id="color" name="color">
    <option value="">seleziona</option>
    @foreach ($colors as $curColor)
        <option value="{{$curColor}}">{{$curColor}}</option>
    @endforeach
</select>
{{-- /type --}}

<button type="submit" class="btn btn-success mt-5 w-25 m-auto">crea</button>
</form>

@endsection

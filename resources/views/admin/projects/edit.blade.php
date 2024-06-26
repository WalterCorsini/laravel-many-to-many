@extends('layouts.admin')

@section('content')
    @include('partials.errors')
    {{-- form --}}
    <form class="w-50 m-auto d-flex flex-column pt-5"
        action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('put')

        {{-- title --}}
        <label for="title">Titolo :

            {{-- error message --}}
            @error('title')
                <span class="text-danger">
                    {{ $errors->first('title') }}
                </span>
            @enderror
            {{-- /error message --}}

        </label>
        <input
            class="form-control

        {{-- dynamic class with red border --}}
        @error('title')
            is-invalid
        @enderror"
            {{-- /dynamic class with red border --}} type="text" id="title" name="title" value="{{ old('title', $project->title) }}">
        {{-- /title --}}


        {{-- description --}}
        <label for="description">Descrizione :

            {{-- error message --}}
            @error('description')
                <span class="text-danger">
                    {{ $errors->first('description') }}
                </span>
            @enderror
            {{-- /error message --}}

        </label>
        <textarea
            class="form-control

        {{-- dynamic class with red border --}}
        @error('description')
            is-invalid
        @enderror"
            {{-- /dynamic class with red border --}} type="text" id="description" name="description">{{ old('description', $project->description) }}</textarea>

        {{-- /description --}}

        {{-- type --}}
        <select class="mt-2 mb-3" name="type_id" id="type_id">
            <option value="">Seleziona</option>
            @foreach ($typeList as $key => $curType)
                <option @selected($project->type_id === $curType->id) value="{{ $curType->id }}">{{ $curType->name }}</option>
            @endforeach
        </select>
        {{-- /type --}}


        {{-- technologies --}}
        <p>Tecnologie:</p>
        <div class="d-flex gap-3">
            {{-- @foreach ($technologyList as $curTechnology)
                <label for="technology-{{ $curTechnology->id }}">{{ $curTechnology->name }}</label>
                <input type="checkbox" id="technology-{{ $curTechnology->id }}" name="technologies[]"
                    value="{{ $curTechnology->id }}">
            @endforeach --}}
            @foreach ($technologyList as $curTechnology)
                @if (old('technologies') !== null)
                    <input type="checkbox" class="btn-check" id="tech-{{ $curTechnology->id }}" name="technologies[]"
                        value="{{ $curTechnology->id }}" @checked(in_array($curTechnology->id, old('technologies')))>
                @else
                    <input type="checkbox" id="tech-{{ $curTechnology->id }}" name="technologies[]"
                        value="{{ $curTechnology->id }}" @checked($project->technologies->contains($curTechnology))>
                @endif
                <label for="tech-{{ $curTechnology->id }}">{{ $curTechnology->name }}</label>
            @endforeach
        </div>
        {{-- technologies --}}

        {{-- file --}}
        <label for="cover_image"> Immagine</label>
        <input
            class="form-control

        {{-- dynamic class with red border --}}
        @error('cover_image')
            is-invalid
        @enderror"
            {{-- /dynamic class with red border --}} type="file" name="cover_image" id="cover_image">

        {{-- error message --}}
        @error('cover_image')
            <span class="text-danger">
                {{ $errors->first('cover_image') }}
            </span>
        @enderror
        {{-- /error message --}}

        {{-- /file --}}

        {{-- check remove image --}}
        @if ($project->cover_image !== null)
            <label for="removeImage">Rimuovi immagine :</label>
            <input type="checkbox" id="removeImage" name="removeImage">
        @endif

        {{-- old and new img --}}
        <div class="w-100 mt-2">
            <img id="oldImg" class="w-25" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
            <img id="imagePreview" class="w-25 hide" src="" alt="new-image">
        </div class="img-container">
        {{-- /old and new img --}}

        {{-- button add and remove --}}
        <div>
            <button class="btn btn-success mt-3 w-25" type="submit">Aggiorna</button>
            <a id="btnDelete" class="btn btn-danger mt-3 hide w-25">rimuovi</a>
        </div>
        {{-- /button add and remove --}}



    </form>
@endsection

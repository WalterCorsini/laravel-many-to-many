@extends('layouts.admin')

@section('content')
    <div class="container ms-table-container mt-5">

        <div class="d-flex justify-content-center">

{{-- select page --}}
<div class="me-5">
    <form action="{{ route('admin.projects.index')}}" method="GET">
        <label for="numberPage">Numero Record da visualizzare</label>
        <select name="numberPage" id="numberPage">
            <option value="5" @selected($projectsList->perPage() == 5)>5</option>
            <option value="10" @selected($projectsList->perPage() == 10)>10</option>
            <option value="15" @selected($projectsList->perPage() == 15)>15</option>
        </select>

        <button type="submit" class="ms-3">Filtra</button>
    </form>
</div>
{{-- /select page --}}

            {{-- paginator --}}
            <div>
                {{ $projectsList->links()}}
            </div>
            {{-- /paginator --}}

        </div>

        <div class="d-flex justify-content-between align-items-center">
            {{-- title --}}
            <h1 class="fw-bold">Projects</h1>
            {{-- /title --}}

            {{-- success message --}}
            @if (session('message'))
                <div class="alert alert-success">
                    <span class="info-info-success">{{ session('message') }}</span>
                </div>
            @endif
            {{-- /success message --}}

            {{-- add btn --}}
            <div class="d-flex flex-column">
                <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"> Add</i>
                </a>
            </div>
            {{-- /add btn --}}

        </div>
        <hr>
        <div class="table-responsive">


            {{-- table --}}
            <table class="table">

                {{-- thead --}}
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Type</th>
                        <th scope="col">Technologies</th>
                        <th scope="col">Description</th>
                        <th scope="col">Button</th>
                    </tr>
                </thead>

                {{-- t-body --}}
                <tbody>
                    @foreach ($projectsList as $curElem)
                        <tr>
                            <td>
                                <span>{{ $curElem->title }}</span>
                            </td>

                            {{-- type --}}
                            <td>
                                <span class="badge" style="background:{{$curElem->type?->color ? $curElem->type->color : 'black'}}">{{($curElem->type?->name) ? $curElem->type->name : 'NULL'}}</span>
                            </td>
                            {{-- /type --}}

                            {{-- technologies --}}
                            <td>{{-- eager loading --}}
                                {{ $curElem->technologies_count }}
                            </td>
                            {{-- /technologies --}}
                            <td>
                                <span>{{ $curElem->description }}</span>
                            </td>
                            <td class="h-100">
                                <div class="h-100 d-flex gap-2">

                                    {{-- show btn --}}
                                    <a class="btn btn-info"
                                        href="{{ route('admin.projects.show', ['project' => $curElem->slug]) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    {{-- /show btn --}}

                                    {{-- edit btn --}}
                                    <a class="btn btn-success"
                                        href="{{ route('admin.projects.edit', ['project' => $curElem->slug]) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    {{-- /edit btn --}}

                                    {{-- delete btn  --}}
                                    <form class="delete"
                                        action="{{ route('admin.projects.destroy', ['project' => $curElem->slug]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button data-title="{{ $curElem->title }}" class="btn btn-danger"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                    {{-- /delete btn  --}}

                                    <!-- modal -->
                                    @include('partials.modal-softdeletes')
                                    {{-- /modal --}}

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {{-- /table --}}

                {{-- paginator --}}
                <div class="d-flex justify-content-center">
                    {{ $projectsList->links()}}
                </div>
                {{-- /paginator --}}

        </div>

    </div>
@endsection

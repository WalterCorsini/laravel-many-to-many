@extends('layouts.admin')

@section('content')

    <div class="container ms-table-container mt-5">

        <div class="d-flex justify-content-between align-items-center">
            {{-- title --}}
            <div>
                <h1 class="fw-bold"> Trash Projects</h1>
                
                @if (count($trashList) > 0)

                    {{-- restore All button  --}}
                    <form class="text-center" action="{{ route('admin.projects.restoreall') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success" href="admin.projects.restoreall">
                            <i class="fa-solid fa-rotate-left"></i> All
                        </button>
                    </form>
                    {{-- /restore All button  --}}

                @endif
            </div>
            {{-- /title --}}

            {{-- success message --}}
            @if (session('message'))
                <div class="alert alert-success">
                    <span class="info-info-success">{{ session('message') }}</span>
                </div>
            @endif
            {{-- /success message --}}


        </div>
        <hr>

        @if (count($trashList) > 0)
            {{-- table --}}
            <table class="table">

                {{-- thead --}}
                <thead>
                    <tr>
                        <th class="w-25" scope="col">Title</th>
                        <th class="w-25" scope="col">Description</th>
                        <th class="w-25" scope="col">Button</th>
                    </tr>
                </thead>

                {{-- t-body --}}
                <tbody>
                    @foreach ($trashList as $curProject)
                        <tr>
                            <td>{{ $curProject->title }}</td>
                            <td>
                                <span>{{ $curProject->description }}</span>
                            </td>
                            <td class="h-100">
                                <div class="d-flex gap-2">

                                    {{-- forceDelete Button --}}
                                    <form action="{{ route('admin.projects.forceDelete', ['id' => $curProject->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                    {{-- /forceDelete Button --}}


                                    {{-- restore button --}}
                                    <form action="{{ route('admin.projects.restore', ['id' => $curProject->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success"><i
                                                class="fa-solid fa-rotate-left"></i></button>
                                    </form>
                                    {{-- /restore button --}}

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{-- /table --}}
        @else
            <h1 class="uppercase">Il cestino è vuoto</h1>
        @endif
    </div>

@endsection

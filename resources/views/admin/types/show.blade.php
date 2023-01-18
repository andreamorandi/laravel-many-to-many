@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-start mt-4">
            <a class="btn btn-success" href="{{ route('admin.types.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <h2 class="text-center">{{ $type->name }}</h2>
        <p><strong>Slug: </strong>{{ $type->slug }}</p>
        <h4>Progetti:</h4>
        <ul>
            @forelse ($type->projects as $project)
                <li>
                    <a href="{{ route('admin.projects.show', $project->slug) }}">
                        {{ $project->title }}
                    </a>
                </li>
            @empty
                <li>Nessun progetto presente</li>
            @endforelse
        </ul>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="text-start mt-4">
            <a class="btn btn-success" href="{{ route('admin.technologies.index') }}">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </div>
        <h2 class="text-center">{{ $technology->name }}</h2>
        <p><strong>Slug: </strong>{{ $technology->slug }}</p>
        <h4>Progetti:</h4>
        <ul>
            @forelse ($technology->projects as $project)
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

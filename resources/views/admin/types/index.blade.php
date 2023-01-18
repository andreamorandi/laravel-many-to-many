@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="mt-3 text-center">Lista dei tipi</h2>
        @include('partials.messages')
        <div class="row justify-content-between">
            <div class="col-5">
                <form action="{{ route('admin.types.store') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input name="name" type="text" class="form-control" placeholder="Inserisci un nuovo tipo"
                            aria-label="Inserisci un nuovo tipo" aria-describedby="create-type-btn">
                        <button class="btn btn-outline-primary" type="submit" id="create-type-btn">Salva</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Tipo</th>
                            <th scope="col">Numero dei progetti</th>
                            <th scope="col">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($types as $type)
                            <tr>
                                <th scope="row">
                                    <form id="edit-type-{{ $type->id }}"
                                        action="{{ route('admin.types.update', $type->slug) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="name" id="name" class="form-control border-0"
                                            value="{{ $type->name }}">
                                    </form>
                                </th>
                                <td>{{ count($type->projects) }}</td>
                                <td>
                                    <a href="{{ route('admin.types.show', $type->slug) }}" class="btn btn-success">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <button form="edit-type-{{ $type->id }}" class="btn btn-warning" href=""
                                        type="submit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p>Nessun tipo presente</p>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection

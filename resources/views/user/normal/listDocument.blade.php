@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session()->has('messageDelete'))
                <div class="alert alert-success">
                        {{ session()->get('messageDelete') }}
                </div>
                @endif
                <div class="card-header">Documentos registrados</div>

                <div class="card-body">
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col"></th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Archivo</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documents->documents as $document)
                    <tr>
                        <th scope="row">{{ $document->id }}</th>
                        <td>{{ $document->tittle }}</td>
                        <td><a href="{{ Storage::url($document->url) }}"><label>Ver archivo actual</label></a></td>

                        <td><a href="{{ url('/document/show/'.$document->id) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Editar</a></td>
                        <td><a href="{{ url('/document.delete/'.$document->id) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
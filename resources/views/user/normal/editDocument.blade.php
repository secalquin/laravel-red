@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="card-header">Editar</div>
                <div class="card-body">
                <form  method="POST" action="/document/update" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="titulo" class="col-sm-2 col-form-label">Titulo</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="titulo" value="{{ $document->tittle }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Archivo</label>
                        <div class="col-sm-10">
                            <a href="{{ Storage::url($document->url) }}"><label>Ver archivo actual</label></a>
                            <input type="file" class="form-control-file" name="archivo">
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="hidden" name="id" value="{{ $document->id }}">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

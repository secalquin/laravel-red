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
                <form  method="POST" action="/user.update">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="role">
                        @foreach ($roles as $value)
                            <option value="{{ $value->id }}" {{ ( $value->id == $user->role_id) ? 'selected' : '' }}> 
                                {{ $value->description }} 
                            </option>
                        @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="hidden" name="id" value="{{ $user->id }}">
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

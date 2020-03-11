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
                <div class="card-header">Usuarios registrados</div>

                <div class="card-body">
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col"></th>
                    <th scope="col">Nombre</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->description }}</td>
                        <td><a href="{{ url('/user.show/'.$user->id) }}" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Editar</a></td>
                        <td><a href="{{ url('/user.delete/'.$user->id) }}" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Eliminar</a></td>
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
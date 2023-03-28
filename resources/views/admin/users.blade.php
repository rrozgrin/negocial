@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header align-items-center py-3">
        <div class="col d-flex justify-content-betwee">
            <h4>Usuários cadastrados</h4>
            <div class="col text-right">
                <a class="text-info" href="{{route('admin.users.create')}}">
                    <big> + Novo usuário </big>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row pt-2">
    <div class="col-12">
        <table class="table">
            <thead class="" style="background-color: #233F75; color:#fff">
                <tr class="text-center">
                    <th style="width: 10%">Id</th>
                    <th style="width: 26%" class="text-left">Nome</th>
                    <th style="width: 14%">CPJ-Cobrança</th>
                    <th style="width: 20%">Função</th>
                    <th style="width: 10%">Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="text-center">
                    <td>{{$user->id}}</td>
                    <td class="text-left">{{$user->name_user}}</td>
                    <td>{{$user->cpj_cobranca}}</td>
                    <td>{{$user->role->name_role}}</td>
                    <td><a class="btn btn-warning text-primary" href="{{ route('admin.users.edit', $user->id) }}">Editar</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
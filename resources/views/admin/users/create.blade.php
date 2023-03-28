@extends('admin.layout')
@section('content')
    <div class="card">
        <div class="card-header py-3">
            Novo usuário
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do usuário</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <label for="cap">Login CPJ-Cobrança</label>
                    <input type="text" class="form-control" name="cpj">
                </div>
                <div class="form-group">
                    <label for="role">Função</label>
                    <select  class="form-control"  name="role">
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name_role }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="status" checked>
                    <label class="form-check-label" for="status">Usuário ativo?</label>
                </div>
                <div class="row mr-1 justify-content-end">
                    <div class="col-10"></div>
                    <div class="col-2"><button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

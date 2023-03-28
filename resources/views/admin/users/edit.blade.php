@extends('admin.layout')


@section('content')
    <div class="card  my-2">
        <div class="card-header py-3">
            Editar usuário
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @csrf
                @method('PUT')
                <input type="hidden" class="form-control" name="id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="name">Nome do usuário</label>
                    <input type="text" class="form-control" name="name_user" value="{{ $user->name_user }}">
                </div>
                <div class="form-group">
                    <label for="cpj">Login CPJ-Cobrança</label>
                    <input type="text" class="form-control" name="cpj_cobranca" value="{{ $user->cpj_cobranca }}">
                </div>
                <div class="form-group">
                    <label for="role">Função</label>
                    <select class="form-control" name="role_id">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name_role }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check">
                    <input type="checkbox" @if ( $user->status == 1) checked @endif class="form-check-input" name="status">
                    <label class="form-check-label " for="status">Usuário ativo?</label>
                </div>
                <div class="row mr-1 justify-content-end">
                    <div class="col-10"></div>
                    <div class="col-2"><button type="submit" class="btn btn-primary btn-block">Editar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

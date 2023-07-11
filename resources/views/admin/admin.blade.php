@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-header align-items-center py-3">
        <div class="col d-flex justify-content-betwee">
            <h4><a href="{{route('admin.users.index')}}">Usuários cadastrados</a></h4>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header align-items-center py-3">
        <div class="col d-flex justify-content-betwee">
            <h4><a href="{{route('importadores')}}">Imporadores</a></h4>
        </div>
    </div>
</div>
@endsection
@extends('admin.layout')
@section('content')

<div class="card">
    <div class="card-header py-3">
        Incluir Ligações do dia
    </div>
    <div class="card-body">
        <form method="POST" action="import-ligacoes/" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Selecione o arquivo</label>
                <input type="file" class="form-control pb-5 pt-3" id="file" name="file">
            </div>

            <div class="form-group">
                <button class="btn btn-success" value="file" type="submit">Carregar BD</button>
            </div>
        </form>
    </div>
</div>

@endsection
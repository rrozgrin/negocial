@extends('admin.layout')
@section('content')
    <div class="row">
        <div class="row">
            <div class="col-md-6">
                @include('admin.import.acionamentos-import')
            </div>
            <div class="col-md-6">
                @include('admin.import.clientes-import')
            </div>
            <div class="col-md-6">
                @include('admin.import.ligacoes-import')
            </div>
            <div class="col-md-6">
                @include('admin.import.user-import')
            </div>
        </div>
    </div>
@endsection

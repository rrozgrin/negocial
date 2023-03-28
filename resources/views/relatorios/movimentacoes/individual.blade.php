@extends('admin.layout')
{{-- {{dd($pornegociadorData);}} --}}
@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ URL::asset('/js/charts.js') }}"></script>
    <div class="card">
        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee text-info">
                <h4>Análise individual</h4>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-body">
                <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
            </div>
        </div>
        <div class="row">
            <div class="card-body col-md-12">
                <form action="{{ route('rel.individualselecionado') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control " name="data">
                                @foreach ($data as $d)
                                    <option value="{{ $d->data }}"
                                        {{ isset($dia) && $dia == $d->data ? 'selected' : '' }}
                                        {{ isset($dataatual) && $dataatual == $d->data ? 'selected' : '' }}>
                                        {{ date('d/m/Y', strtotime($d->data)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control  ml-5" name="negociador">
                                @foreach ($negociador as $n)
                                    <option value="{{ $n->id }}"
                                        {{ isset($negselecionado) && ($negselecionado == $n->id) ? 'selected' : '' }}>
                                        {{ $n->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-success ml-5 btn-block ">Consultar</button>
                        </div>
                </form>
            </div>
        </div>
        <div class="tableFixHead card-body ml-3 mr-3 p-0">
            <table class="table  table-sm ">
                <thead class="thead-dark sticky-top">
                    <tr>
                        <th scope="col">Hora</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Acionamento</th>
                        <th scope="col">Negociador</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($acionamentos as $ac)
                        <tr>
                            <th scope="row">{{ $ac->hora }}</th>
                            <td class="small">{{ $ac->cliente }}</td>
                            <td class="small">{{ $ac->ocorrencia }}</td>
                            <td class="small">{{ $ac->negociador }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    </div>
@endsection

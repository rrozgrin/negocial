@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee">
                <h4>Ligações</h4>
                {{-- {{ dd($ligacoes);}} --}}
            </div>
            <div class="row">
                <div class="card-body col-md-6">
                    <form action="{{ route('rel.lig') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">

                                <select class="form-control mb-3 ml-2" name="data">
                                    @foreach ($data as $d)
                                        <option value="{{ $d->data }}"
                                            {{ isset($dia) && $dia == $d->data ? 'selected' : '' }}
                                            {{ isset($data) && $data == $d->data ? 'selected' : '' }}>
                                            {{ date('d/m/Y', strtotime($d->data)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-success btn-block mb-3">Consultar</button>
                            </div>
                    </form>
                </div>

                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NEGOCIADOR</th>
                            <th scope="col">Ativo realizado</th>
                            <th scope="col">Ativo Atendido</th>
                            <th scope="col">Tempo em ligação</th>
                            <th scope="col">Tempo Logado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ligacoes as $lig)
                            <tr>
                                <th scope="row">{{ $lig->negociador }}</th>
                                <td class="text-center">{{ $lig->qtd_atv }}</td>
                                <td class="text-center">{{ $lig->qtd_completa }}</td>
                                <td class="text-center">{{ $lig->tempo_atv_recep }}</td>
                                <th class="text-center">{{ $lig->tempo_logado }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
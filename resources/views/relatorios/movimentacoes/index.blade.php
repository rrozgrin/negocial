@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee">
                <h4>Movimentações</h4>
                <div class="col text-right">
                    <a class="text-info" href="{{ route('rel.individual') }}">
                        <big> Detalhamento por negociador </big>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-body col-md-7">
                <form action="{{route('rel.movdata')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">

                            <select class="form-control mb-3 ml-2" name="data">
                                @foreach ($data as $d)
                                    <option value="{{ $d->data }}" {{isset($dia)&&($dia == $d->data) ? 'selected' : '' }} {{isset($dataatual)&&($dataatual == $d->data) ? 'selected' : '' }}>{{ date('d/m/Y', strtotime($d->data)) }}</option>
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
                        <th scope="col">Acionamento</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mov as $mov)
                        <tr>
                            <th scope="row">{{ $mov->ocorrencia }}</th>
                            <td>{{ $mov->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            Gráfico
        </div>
    </div>
    </div>
@endsection

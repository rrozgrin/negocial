@extends('admin.layout')

{{-- {{dd($dados);}} --}}
@section('content')
    <div class="card">
        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee">
                <h4>Defasagem</h4>
            </div>
        </div>
        <div class="row">
            <div class="card-body col-md-7">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Negociador</th>
                            <th scope="col">Acionados</th>
                            <th scope="col">Defasagem</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                            <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                    </tbody>
                </table>
            </div>
            <div class="card-body">
                Gráfico
            </div>
        </div>
    </div>
@endsection

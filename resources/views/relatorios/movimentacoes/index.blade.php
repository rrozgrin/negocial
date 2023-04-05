@extends('admin.layout')
{{-- {{dd($ligacoes);}} --}}
@section('content')
    <script type="text/javascript">
        var analytics = <?php echo $movi; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {

                legend: {
                    position: 'none',

                },
                chartArea: {
                    top: 50,
                    left: 60,
                    width: '80%',
                    height: '80%'
                },
                backgroundColor: {
                    fill: 'transparent'
                },
                is3D: true,



            };
            var chart = new google.visualization.PieChart(document.getElementById("columnchart_values"));
            chart.draw(data, options);
        }
    </script>
    <div class="card">
        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee">
                <h4>Movimentações</h4>
                <div class="col text-right">
                    <a class="text-info" href="{{ route('rel.detalhado') }}">
                        <big> Detalhamento dos acionamentos </big>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-body col-md-6">
                <form action="{{ route('rel.mov') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-9">

                            <select class="form-control mb-3 ml-2" name="data">
                                @foreach ($dataArray as $d)
                                    <option value="{{ $d->data }}"
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

            <table class="table table-sm text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">OCORRÊNCIAS</th>
                        <th scope="col">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($mov as $mov)
                        <tr>
                            <th scope="row">{{ $mov->ocorrencia }}</th>
                            <td>{{ $mov->total }}</td>
                        </tr>
                    @endforeach
                    <tr class="thead-dark">
                            <th class="big" scope="row">TOTAL</th>
                            <th class="big" scope="row">{{ $somaTotal }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-body col-md-6">
            <div id="columnchart_values" style="width: 800px; height: 600px; text-align: center"></div>
        </div>

    </div>
@endsection

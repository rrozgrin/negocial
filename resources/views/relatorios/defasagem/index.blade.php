@extends('admin.layout')

{{-- {{dd($query);}} --}}
@section('content')
    <script type="text/javascript">
        var analytics = <?php echo $query_json; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                legend: 'none',
                series: {
                    0: {
                        color: '0f4262'
                    },
                },
                bar: {
                    groupWidth: 28
                },
                chartArea: {
                    top: 100,
                    left: 0,
                    width: '90%'
                },
                backgroundColor: {
                    fill: 'transparent'
                },
                vAxis: {
                    textPosition: 'none',
                    slantedTextAngle: 90
                },

                annotations: {
                    textStyle: {
                        fontSize: 10,
                    }
                },

                title: 'Percentual de MCI acionados de toda a base do negociador',

            };

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation",
                    direction: -1,
                    slantedTextAngle: 90
                },
            ]);
            var formatter = new google.visualization.NumberFormat({
                suffix: ' %',
                NumberFormat: 'decimalSymbol',
                fractionDigits: 0

            });
            formatter.format(data, 1);

            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>
    <div class="card">
        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee">
                <h4>Defasagem</h4>
            </div>
        </div>
        <div class="col-md-3">
            <select class="form-control " name="negociador">


                @foreach ($carteiras as $c)
                    <option value="{{ $c->empresa_id }}"
                        {{ isset($carteira) && $carteira == $c->empresa_id ? 'selected' : '' }}>
                        {{ $c->nome_empresa }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="card-body col-md-6">
                <table class="table table-sm">
                    <thead class="thead-dark">

                        <th scope="col">Negociador</th>
                        <th class="text-center" scope="col">Acionados</th>
                        <th class="text-center" scope="col">Defasagem</th>
                        <th class="text-center" scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($query as $q)
                            <tr>
                                <td>{{ $q->id }}</td>
                                <td class="text-center">{{ $q->acionados }}</td>
                                <td class="text-center">{{ $q->naoAcionados }}</td>
                                <td class="text-center">{{ $q->acionados + $q->naoAcionados }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-body col-md-6">
                <div id="columnchart_values" style="padding-right: 100px; width: 700px; height: 400px;  "></div>
            </div>
        </div>
    </div>
@endsection

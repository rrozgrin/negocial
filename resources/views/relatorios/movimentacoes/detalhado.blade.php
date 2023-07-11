@extends('admin.layout')
@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var analytics = <?php echo $pornegociadorData; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options = {
                legend: 'none',
                title: 'QUANTIDADE DE ACIONAMENTOS DO DIA',
                colors: ['0f4262'],
                chartArea: {
                    
                    width: '100%',
                    height: '70%'
                },
                backgroundColor: {
                    fill: 'transparent'
                },
                annotations: {
                    textStyle: {
                        fontSize: 10,
                    }
                },
                

            };



            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
            ]);


            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
            chart.draw(view, options);
        }
    </script>
    <script type="text/javascript">
        var analytics_1 = <?php echo $ligacoes; ?>

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics_1);
            var options = {
                legend: 'none',
                title: 'QUANTIDADE DE LIGAÇÕES DO DIA',
                colors: ['111e29'],
                chartArea: {
                    
                    width: '100%',
                    height: '70%'
                },
                annotations: {
                    textStyle: {
                        fontSize: 10,
                    }
                },
                backgroundColor: {
                    fill: 'transparent'
                },
                
            };

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation",
                },
            ]);

            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values_1"));
            chart.draw(view, options);
        }
    </script>


    <div class="card">

        <div class="card-header align-items-center py-3">
            <div class="col d-flex justify-content-betwee text-info">
                <h4 class="titulo">Detelhamento dos Acionamentos</h4>
                <div class="col text-right">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-body ml-5 col-md-6 d-flex justify-content-center">
                <div id="columnchart_values" style="height: 300px;"></div>
            </div>
            <div class="card-body  col-md-5 d-flex justify-content-start">
                <div id="columnchart_values_1" style="height: 300px;"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card-body col-md-12">
                <form action="{{ route('rel.detalhado') }}" method="post">
                    @csrf
                    <div class="row  d-flex justify-content-center">
                        <div class="col-md-3">
                            <select class="form-control " name="data">
                                @foreach ($dataArray as $d)
                                    <option value="{{ $d->data }}"
                                        {{ isset($data) && $data == $d->data ? 'selected' : '' }}>
                                        {{ date('d/m/Y', strtotime($d->data)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-control " name="negociador">
                                <option value="2023">Todos os negociadores</option>
                                @foreach ($negociadorArray as $n)
                                    <option value="{{ $n->id }}"
                                        {{ isset($negociador) && $negociador == $n->id ? 'selected' : '' }}>
                                        {{ $n->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn botao ml-2 btn-block ">Consultar</button>
                        </div>
                </form>
            </div>
        </div>
        <div class="tableFixHead  d-flex justify-content-center col-md-8 p-0">
            <table class="table table-bordered table-sm ">
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
                            <td class="text-center small">{{ $ac->negociador }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    </div>
@endsection

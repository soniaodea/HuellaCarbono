@extends("layouts.userHome")

@section("title", "Estadísticas")

@section("userContent")
<div class="container">
    <h2>Gráfico {{ $type }} </h2>
    <hr>

    <canvas id="chart"></canvas>
    <script>

        let buildings = {!! $buildings !!};


        let type ="{{$type}}";

        @foreach($buildings as $i => $building)


            buildings[{{ $i }}].studies = Array();
            @foreach($building->studies()->orderBy("year", "asc")->get() as $study)
                @php
                    if ($study->year < $year) {
                        $year = $study->year;
                    }
                @endphp
                buildings[{{ $i }}].studies.push({!! $study !!});
            @endforeach

        @endforeach

        let years = Array();
        for (let year = {{ $year }}; year < new Date().getFullYear(); year++) {
            years.push(year);
        }

        let datasets = Array();

        buildings.forEach(function (building) {
            let color = Array();
            for(let i = 0; i < 3; i++) {
                color.push(Math.round(Math.random() * 256));
            }

            let dataset = {
                label: building.name,
                data: Array(),
                backgroundColor: "rgba(" + color[0] + ", " + color[1] + ", " + color[2] + ", .8)",
                borderColor: "black",
                borderWidth: 1,
            };

            years.forEach(function (year) {
                dataset.data.push(yearStudyValue(building.studies, year));
            });
            datasets.push(dataset);
        });

        function yearStudyValue(studies, year) {
            let studyValue = 0;
            for (let i = 0; i < studies.length; i++) {
                if (studies[i].year === year) {
                    if  (type === "Huella de Carbono") {
                        studyValue = studies[i].carbon_footprint;
                    }
                    if (type === "Gas Natural") {
                        studyValue = studies[i].a1_gas_natural_kwh;
                    }
                    if (type === "GasoleoC") {
                        studyValue = studies[i].a1_gasoleoc;
                    }
                    if (type === "Fueloleo") {
                        studyValue = studies[i].a1_fueloleo;
                    }
                    if (type === "Aire Acondicionado") {
                        studyValue = studies[i].a1_recarga_gases_refrigerantes;
                    }
                    if (type === "Electricidad") {
                        studyValue = studies[i].a2_electricidad_kwh;
                    }
                    if (type === "Agua Potable") {
                        studyValue = studies[i].a3_agua_potable_m3;
                    }
                    if (type === "Papel y Carton") {
                        studyValue = studies[i].a3_papel_carton_residuos_kg;
                    }
                    if (type === "Combustion en Litros Consumidos") {
                        studyValue = studies[i].a3_combustionMovil;
                    }
                    if (type === "Combustion en Kilometros Recorridos") {
                        studyValue = studies[i].a3_combustionMovilKmRecorridos; //Este valor es boolean, hay que diferenciar en Study los campos litrosConsumidos y kmRecorridos
                    }
                    return studyValue;
                }
            }

            return studyValue;
        }

        document.addEventListener("DOMContentLoaded", function () {
            let ctx = document.getElementById("chart").getContext("2d");
            let data = {
                labels: years,
                datasets: datasets
            };

            let buildingsChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        });
    </script>
</div>
@endsection

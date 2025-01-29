@extends('layouts.master')

@section('title', 'Editar Material - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Entrega de {{$material['nombre']}}  año {{$material['ano']}}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Materiales</li>
    <li class="breadcrumb-item active">Conteo</li>
   
@endsection

@section('content')
<div class="container-fluid">

	<div class="row">

  <div class="col-xl-12 box-col-12">
    <div class="card">
      <div class="card-header">
        <h5>Seleccione año y material</h5>
      </div>
      <form class="needs-validation theme-form" novalidate=""  action="{{route('postcontrol')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-4">
                <div class="mb-3">
                    <select class="form-control" name="ano" id="">
              
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
            
                    </select>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="mb-3">
                    <select class="form-control" name="material" >
                    @foreach($materiales as $m)
                        <option value="{{$m->id}}">{{$m->nombre}}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Calcular</button>
                </div>
            </div>

            </div>
        </div>
          </form>
    </div>

  </div>

  <div class="col-sm-12 col-xl-6 box-col-6">
    <div class="card">
      <div class="card-header">
        <h5>Entrega Total Anual entregado:{{array_sum($totales)}} </h5>
      </div>
      <div class="card-body apex-chart">
        <div id="total-anual"></div>
      </div>
    </div>
  </div>
		
		
		<div class="col-sm-12 col-xl-6 box-col-6">
			<div class="card">
				<div class="card-header">
					<h5>Entrega Total Mensual</h5>
				</div>
				<div class="card-body">
					<div id="por-mes"></div>
				</div>
			</div>
		</div>
    <div class="col-sm-12 col-xl-6 box-col-6">
			<div class="card">
				<div class="card-header">
					<h5>Entrega Anual Por Sectores</h5>
				</div>
				<div class="card-body">
					<div id="por-sector"></div>
				</div>
			</div>
		</div>

		<div class="col-sm-12 col-xl-6 box-col-6">
			<div class="card">
				<div class="card-header">
					<h5>Entrega por rango de edad</h5>
				</div>
				<div class="card-body">
					<div id="por-rangos"></div>
				</div>
			</div>
		</div>
		
		

	
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script>
  // basic bar chart
    var options2 = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar:{
              show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            data: {{json_encode($mensual)}}
        }],
        xaxis: {
            categories: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        },
        colors:[ CubaAdminConfig.primary ]
    }

    var chart2 = new ApexCharts(
        document.querySelector("#por-mes"),
        options2
    );

    chart2.render();


</script>
<script>
  // basic bar chart
    var options1 = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar:{
              show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        series: [{
            data: {{json_encode($porsector)}}
        }],
        xaxis: {
            categories: ['COINCO', 'COPEQUEN', 'CHILLEHUE', 'MILLAHUE', 'EL RULO', 'EL CAJON', 'TRES PUENTES', 'EL CARDAL', 'FALTA ASIGNAR'],
        },
        colors:[ CubaAdminConfig.primary ]
    }

    var chart1 = new ApexCharts(
        document.querySelector("#por-sector"),
        options1
    );

    chart1.render();


</script>
<script>
 var options3 = {
    chart: {
        width: 380,
        type: 'pie',
    },
    labels: ['Menores 35', '36 y 45', '46 y 55', 'Sobre 55'],
    series: {{json_encode($rangos)}},
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                show: false
            }
        }
    }],
    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25', '#a927f9', '#f8d62b']
}

var chart3 = new ApexCharts(
    document.querySelector("#por-rangos"),
    options3
);

chart3.render();


</script>
<script>
  // pie chart
var options8 = {
    chart: {
        width: 380,
        type: 'pie',
    },
    labels: ['Local', 'Domicilio'],
    series: {{json_encode($totales)}},
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 200
            },
            legend: {
                show: false
            }
        }
    }],
    colors:[ CubaAdminConfig.primary , CubaAdminConfig.secondary , '#51bb25', '#a927f9', '#f8d62b']
}

var chart8 = new ApexCharts(
    document.querySelector("#total-anual"),
    options8
);

chart8.render();

</script>
<script type="text/javascript">
  var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

   
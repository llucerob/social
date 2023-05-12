@extends('layouts.master')

@section('title', 'Nómina de Beneficiarios')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Exportación Transparencia</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Transparencia</li>
<li class="breadcrumb-item active">Exportar</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					
				</div>
				<div class="card-body">
					<div class="dt-ext table-responsive">
						<table class="display" id="transparencia">
							<thead>
								<tr>
									<th>Año</th>
									<th>Mes</th>
									<th>Nombre programa</th>
									<th>Fecha otorgamiento</th>
									<th>Tipo acto</th>
									<th>Denominación acto</th>
									<th>Fecha acto</th>
									<th>Número acto</th>
									<th>Razón social</th>
									<th>Nombre beneficiario</th>
									<th>Apellido paterno beneficiario</th>
									<th>Apellido materno beneficiario</th>
								</tr>
							</thead>
							<tbody>
								
								@foreach($entregados as $e)
								<tr>
									<td>{{$e['ano']}}</td>
									<td>{{$e['mes']}}</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>{{$e['nombre']}}</td>
									<td>{{$e['paterno']}}</td>
									<td>{{$e['materno']}}</td>
								</tr>
								@endforeach
								
							</tbody>
							<tfoot>
								<tr>
									<th>Año</th>
									<th>Mes</th>
									<th>Nombre Programa</th>
									<th>Fecha Otorgamiento</th>
									<th>Tipo Acto</th>
									<th>Denominación Acto</th>
									<th>Fecha Acto</th>
									<th>Número Acto</th>
									<th>Razón Social</th>
									<th>Nombre Beneficiario</th>
									<th>Apellido paterno Beneficiario</th>
									<th>Apellido materno Beneficiario</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>


<script>

$(document).ready(function(){

	var tabla = $('#transparencia').DataTable({
			language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json'},
			dom: 'Bfrtip',
        	buttons: [
            	'copyHtml5',
            	'excelHtml5',
            	'csvHtml5',
            	'pdfHtml5'
        	]			
							
		});
});

</script>

@endsection
@extends('layouts.master')

@section('title', 'Editar Material - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Control de Materiales</h3>
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

  
		

	
	</div>
</div>
@endsection

@section('script')

<script type="text/javascript">
  var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

   
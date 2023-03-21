@extends('layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Crear Nueva Solicitud</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Solicitudes</li>
    <li class="breadcrumb-item active">Nuevo</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Crear nueva solicitud</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" action="{{ route('beneficiarios.store')}}" method="post" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3">

                            <div class="col-md-6">
                              <div class="mb-2">
                                <div class="col-form-label">Materiales</div>
                                <select class="js-example-basic-multiple form-control col-sm-12" name="materiales[]" id="materiales" multiple="multiple">
                                  @foreach ($materiales as $m )

                                  <option value="{{ $m->id }}">{{ $m->nombre }}  {{$m->stock}}[{{$m->medida}}] Disponibles </option>
                                  
                                  @endforeach
                                </select>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="col-form-label m-r-10 form-label" for="registro">¿Desea modificar el Nº de registro social?
                                
                                 
                                    <div class="media-body text-end text-center" >
                                      <label class="switch">
                                      <input type="checkbox" onchange="cambio();" id="registro"><span class="switch-state"></span>
                                      </label>
                                    </div>
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                          </div>
                          
                          
                          
                        </div>
                        <div class="card-footer text-end">
                          <button class="btn btn-primary" type="submit">Grabar</button>
                          <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
                      </form>
                    
                   
                
            </div>
        </div>
        
        
        
    </div>
</div>

<script type="text/javascript">
    var session_layout = '{{ session()->get('layout') }}';
</script>
   
@endsection

@section('script')
    <script src="{{ asset('assets/js/form-validation-custom.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script>
      $(document).ready(function(){

        $('#materiales').select2({

        });
      });
    </script>

@endsection

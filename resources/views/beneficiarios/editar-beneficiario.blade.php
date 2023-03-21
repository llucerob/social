@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">

@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Crear Nuevo Beneficiario</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Beneficiarios</li>
    <li class="breadcrumb-item active">Nuevo</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación usted modificará los datos de {{$beneficiario->nombres}} {{$beneficiario->apellidos}}.</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="">
                        <div class="card-body">
                          <div class="row g-3">

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputNombre">Nombre</label>
                                <input class="form-control" id="inputNombre" type="text" required name="nombres" value="{{$beneficiario->nombres}}" placeholder="Juan Alberto">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputApellidos">Apellidos</label>
                                  <input class="form-control" id="inputApellidos" type="text" required name="apellidos" value="{{$beneficiario->apellidos}}" placeholder="Perez Perez">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                          </div>
                          


                          <div class="row g-3">

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputRut">Rut</label>
                                <input class="form-control" id="inputRut" type="text" name="rut" data-role="input, input-mask" data-mask="________-_" value="{{$beneficiario->rut}}">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputfnac">Fecha Nacimiento</label>
                                  <input class="datepicker-here form-control digits" data-lenguage="es" id="inputfnac" type="text" name="fnac" placeholder="12/01/1999" value="{{$beneficiario->fnac}}">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                              </div>

                          </div>
                          
                          <div class="row g-3">

                            <div class="col-md-4 mt-3">
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

                            <div class="col-md-4">
                                <div class="mb-3">
                                  <label class="form-label" for="inputRegistrosocial">Registro Social</label>
                                  <input class="form-control" id="inputRegistrosocial" type="text" name="registrosocial" readOnly placeholder="1252831" value="{{$beneficiario->registrosocial->folioid}}">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="form-label" for="inputPorcentaje">Porcentaje</label>
                                <input class="form-control" id="inputPorcentaje" type="number" name="porcentaje" readOnly placeholder="99" value="{{$beneficiario->registrosocial->porcentaje}}">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                          </div>

                          <div class="row g-3">

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputDireccion">Dirección</label>
                                  <input class="form-control" id="inputDireccion" type="text" name="direccion" placeholder="avda. siempre viva" value="{{$beneficiario->direccion}}">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                              </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="selectSector">Sector</label>
                                <select class="form-select digits" id="selectSector">

                                    @foreach ($sector as $s )
                                        <option value="{{ $s->nombre }}" @if ($s->nombre == $beneficiario->sector) selected @endif>{{ $s->nombre }}</option>
                                    @endforeach
                                  
                                </select>
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                          </div>


                          <div class="row g-3">

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputTelefono">Teléfono</label>
                                <input class="form-control" id="inputTelefono" type="text" name="telefono" placeholder="Perez Perez" value="{{$beneficiario->telefono}}">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputCorreo">Email</label>
                                  <input class="form-control" id="inputCorreo" type="email" name="correo" placeholder="algo@algo.com" value="{{$beneficiario->correo}}">
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

    <script>
      
      function cambio()
      {
        if(document.getElementById("registro").checked){
          document.getElementById('inputPorcentaje').readOnly     = false;
          document.getElementById('inputRegistrosocial').readOnly = false;
        }
      }
      
    </script>   
    <script src="{{ asset('assets/js/form-validation-custom.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.es.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    
@endsection

@extends('layouts.master')

@section('title', 'Nuevo Beneficiario - I. Municipalidad Coinco')

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
                    <h5>A continuación usted creara un nuevo beneficiario.</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" onsubmit="enviar();" action="{{ route('beneficiarios.store')}}" method="post" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3">

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputNombre">Nombre</label>
                                <input class="form-control" id="inputNombre" type="text" required name="nombres" placeholder="Juan Alberto">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputApellidos">Apellidos</label>
                                  <input class="form-control" id="inputApellidos" type="text" required name="apellidos" placeholder="Perez Perez">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                          </div>
                          


                          <div class="row g-3">

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputRut">Rut</label>
                                <input class="form-control" id="inputRut" type="text" required name="rut" placeholder="99999999-1">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputfnac">Fecha Nacimiento</label>
                                  <input class="datepicker-here form-control digits" required  data-lenguage="es" id="inputfnac" type="text" name="fnac" placeholder="12-01-1999">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                              </div>

                          </div>
                          
                          <div class="row g-3">

                            <div class="col-md-4">
                                <div class="mb-3">
                                  <label class="form-label" for="inputRegistrosocial">Registro Social</label>
                                  <input class="form-control" id="inputRegistrosocial" type="text" required name="registrosocial" placeholder="1252831">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="form-label" for="inputPorcentaje">Porcentaje</label>
                                <input class="form-control" id="inputPorcentaje" type="number" name="porcentaje" required placeholder="99">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="form-label" for="inputgrupofam">Grupo Familiar</label>
                                <input class="form-control" id="inputgrupofam" type="number" name="grupofam" required placeholder="99">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                          </div>

                          <div class="row g-3">

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputDireccion">Dirección</label>
                                  <input class="form-control" id="inputDireccion" type="text" name="direccion" required placeholder="avda. siempre viva">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                              </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="selectSector">Sector</label>
                                <select class="form-select digits" required id="selectSector" name="sector">

                                    @foreach ($sector as $s )
                                        <option value="{{ $s->nombre }}">{{ $s->nombre }}</option>
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
                                <input class="form-control" id="inputTelefono" type="text"  name="telefono" placeholder="72 2442330">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputCorreo">Email</label>
                                <input class="form-control" id="inputCorreo" type="email"  name="correo" placeholder="algo@algo.com">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label" for="inputComentario">Comentario</label>
                                <input class="form-control" id="inputComentario" type="text"  name="comentario" placeholder="escriba un comentario aqui">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>


                          </div>
                          
                          
                        </div>
                        <div class="card-footer text-end">
                          <button class="btn btn-primary" id="btn" type="submit">Grabar</button>
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
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.es.js')}}"></script>
    <script>
      function enviar(){
      var btn = document.getElementById('btn');
      btn.setAttribute('disabled','');
     
    }
    </script>
    <script>
    
        
        (function($) {
        "use strict";
         //Minimum and Maxium Date
        $('#minMaxExample').datepicker({
            language: 'es',
            minDate: new Date() // Now can select only dates, which goes after today
        })

        //Disable Days of week
        var disabledDays = [0, 6];

        $('#disabled-days').datepicker({
            language: 'es',
            onRenderCell: function (date, cellType) {
                if (cellType == 'day') {
                    var day = date.getDay(),
                        isDisabled = disabledDays.indexOf(day) != -1;
                    return {
                        disabled: isDisabled
                    }
                }
            }
        })
        })(jQuery);
    
    </script>
@endsection

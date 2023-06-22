@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
    
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Nuevo decreto </h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Transparencia</li>
    <li class="breadcrumb-item active">Decretos</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuacón usted creará periodo y tipo de ayuda.</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" onsubmit="enviar();" action="{{ route('decreto.seleccion')}}" method="post" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3">

                            <div class="col-md-3">
                              <div class="mb-3">
                                <label class="form-label" for="inputMes">Mes</label>
                                <select class="form-control" id="inputMes"  required name="mes">

                                  <option value="01">Enero</option>
                                  <option value="02">Febrero</option>
                                  <option value="03">Marzo</option>
                                  <option value="04">Abril</option>
                                  <option value="05">Mayo</option>
                                  <option value="06">Junio</option>
                                  <option value="07">Julio</option>
                                  <option value="08">Agosto</option>
                                  <option value="09">Septiembre</option>
                                  <option value="10">Octubre</option>
                                  <option value="11">Noviembre</option>
                                  <option value="12">Diciembre</option>


                                </select>
                                
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-2">
                              <div class="mb-3">
                                <label class="form-label" for="inputAno">Año</label>
                                <select class="form-control" id="inputAno"  required name="ano">
                                  <option value="2022">2022</option>
                                  <option value="2023">2023</option>
                                  
                                </select>
                                
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputAyuda">Ayuda</label>
                                <select class="form-control" id="inputAyuda"  required name="ayuda">
                                  @foreach ($categorias as $c )
                                  
                                  <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                  
                                  @endforeach
                                  
                                                                    
                                </select>

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

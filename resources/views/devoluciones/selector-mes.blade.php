@extends('layouts.master')

@section('title', 'Crear Nómina')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
    
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Nuevo documento Transparencia </h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Transparencia</li>
    <li class="breadcrumb-item active">Selector</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuacón usted creará Nomina de transferencia segun consolidación.</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" onsubmit="enviar();" action="{{ route('transparencia.seleccionreembolso')}}" method="post" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3 justify-content-center">

                            <div class="col-md-4">
                              <div class="mb-3">
                                <label class="form-label" for="inputLista">Fecha</label>
                                <select class="form-control" id="inputLista"  required name="lista">

                                  @foreach($lista as $l)

                                    <option value="{{$l}}">{{$l}}</option>
                                  @endforeach

                                </select>
                                
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            


                          </div>
                           
                          
                      </div>
                        <div class="card-footer text-end">
                          <button class="btn btn-primary" id="btn" type="submit">Solicitar</button>
                          <input class="btn btn-light" type="reset" value="Cancel">
                        </div>


                    </form>
                    
                   
                
            </div>
        </div>
        
        
        
    </div>
</div>


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

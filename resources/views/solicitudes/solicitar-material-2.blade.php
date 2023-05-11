@extends('layouts.master')

@section('title', 'Default')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Cantidad de solicitud</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Solicitudes</li>
    <li class="breadcrumb-item active">Nuevo</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header">
                    <h5>Usted esta solicitando materiales para {{$beneficiario->nombres}}</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" onsubmit="enviar();" action="{{url('beneficiarios/solicitar/'.$beneficiario->id.'/parte2')}}" method="post" id="form" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3">
                            <div class="col text-center">
                              <div class="mb-3">
                                <label class="col-form-label m-r-10 form-label" for="domicilio">¿A domicilio?
                              
                               
                                  <div class="media-body text-end text-center mt-4" >
                                    <label class="switch">
                                    <input type="checkbox"  id="domicilio" name="domicilio"><span class="switch-state"></span>
                                    </label>
                                  </div>
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>
                            
                            <div class="col">
                                <div class="mb-3">
                            
                                  <label class="col-form-label m-r-10 form-label" for="cantidad">Ingrese  cantidad</label>
                                
                                 
                                    <div class="table-responsive">
                                      <table class="table">
                                        <thead>
                                          <tr class="border-bottom-primary">
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Límite</th>
                                            <th scope="col" width="30%">Cantidad</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($seleccionados as $key => $item)
                                          <tr class="border-bottom-secondary">
                                             
                                            <td>{{$item['nombre']}} <input type="text" hidden value={{$item['id']}} name="material[{{$key}}][id]">
                                              <input type="text" hidden value={{$item['medida']}} name="material[{{$key}}][medida]"></td>
                                            <td>{{$item['limite']}}</td>
                                            <td><input class="touchspin"  value="0" name="material[{{$key}}][cantidad]">
                                                
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                </div>
                            </div>
                            
                          
                          
                        </div>
                        <div class="row g-3">

                          <div class="col-md-10">
                            <div class="mb-3">
                              <label class="form-label" for="inputComentario">Comentario</label>
                              <input class="form-control" id="inputComentario" type="text" name="comentario" >
                              <div class="valid-feedback">¡Luce bien!</div>
                            </div>
                          </div>
                        </div>
                        

                      </div>
                      
                        <div class="card-footer text-end">
                          
                          <a class="btn btn-light" type="button"  href="{{url()->previous()}}">Volver</a>
                          <button class="btn btn-primary" id="btn" type="submit">Grabar</button>
                        </div>
                      </form>
                    
                   
                
            </div>
        </div>

        <div class="col-sm-6">



        </div>
        
        
        
    </div>
</div>

<script type="text/javascript">
    var session_layout = '{{ session()->get('layout') }}';
</script>
   
@endsection

@section('script')
<!--

<script>
      
  function cambio()
  {
    if(document.getElementById('guardar').onclick){
      document.getElementById('form').submit();  
      document.getElementById('guardar').disabled   = true;
      document.getElementById('volver').hidden    = true; 

    
    }
        
  }
  
</script>   -->
  <script>
    function enviar(){
    var btn = document.getElementById('btn');
    btn.setAttribute('disabled','');
   
  }
  </script>
  <script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
  <script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>
    
    <script src="{{ asset('assets/js/form-validation-custom.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script>
      $(document).ready(function(){

        $('#materiales').select2({

        });
      });
    </script>

@endsection

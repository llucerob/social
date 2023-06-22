@extends('layouts.master')

@section('title', 'Listar Materiales - I. Municipalidad Coinco')

@section('css')
    
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Solicitud Municipalidad</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Solicitudes</li>
    <li class="breadcrumb-item">Municipal</li>
    <li class="breadcrumb-item active">Reintegrar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-md-12">
            <div class="card" >
                <div class="card-header">
                    
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" onsubmit="enviar();" action="{{route('reintegro.material', $solicitud->id)}}" method="post" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3">
                            
                            
                            <div class="col-md-8">
                                <div class="mb-3">
                                 
                            
                                  <label class="col-form-label m-r-10 form-label" for="cantidad">Ingrese  cantidad a reintegrar</label>
                                
                                 
                                    <div class="table-responsive">
                                      <table class="table">
                                        <thead>
                                          <tr class="border-bottom-primary">
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad Solicitada</th>
                                            <th scope="col" width="30%">Cantidad Ocupada</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach ($solicitud->solicitudmunicipal as $key => $i)
                                          <tr class="border-bottom-secondary">
                                             
                                            <td>{{$i->nombre}} </td>
                                            <td>{{$i->solicitudmunicipal->cantidad}} {{$i->solicitudmunicipal->unidad}}</td>
                                            <td><input class="touchspin" value="{{$i->solicitudmunicipal->cantidad}}" name="material[{{$key}}][cantidad]"> [{{$i->solicitudmunicipal->unidad}}]
                                                <input hidden value="{{$i->id}}" name="material[{{$key}}][material]">                                              
                                            </td>
                                                
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
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

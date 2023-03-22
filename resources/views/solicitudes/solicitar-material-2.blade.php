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
       
        
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Usted esta solicitando materiales para {{$beneficiario->nombres}}</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" action="{{url('beneficiarios/solicitar/'.$beneficiario->id.'/parte2')}}" method="post" enctype="multipart/form-data">
                      @csrf  
                      <div class="card-body">
                          <div class="row g-3">
                            <div class="col">
                                <div class="mb-3">
                            
                                  <label class="col-form-label m-r-10 form-label" for="cantidad">¿Es solicitud de emergencia?</label>
                                
                                 
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
                          
                          
                          
                        </div>
                        <div class="card-footer text-end">
                          
                          <a class="btn btn-light" type="button" href="{{url()->previous()}}">Volver</a>
                          <button class="btn btn-primary" type="submit">Grabar</button>
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

@extends('layouts.master')

@section('title', 'Editar Beneficiario - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">

@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Ficha Municipal</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Beneficiarios</li>
    <li class="breadcrumb-item active">Ficha</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Datos Personales</h5>
                    
                </div>


                

                    <form class="needs-validation theme-form" novalidate="" action="{{ route('beneficiarios.update', [$beneficiario->id])}}" method="post" enctype="multipart/form-data">
                      @csrf  
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
                                  <input class="datepicker-here form-control digits" data-lenguage="es" id="inputfnac" type="text" name="fnac" placeholder="12-01-1999" value="{{$beneficiario->fnac}}">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                              </div>

                          </div>
                          
                          <div class="row g-3">

                            <div class="col-md-3 mt-3">
                              <div class="mb-3">
                                <label class="col-form-label m-r-10 form-label" for="registro">¿Desea modificar el Nº de registro social?
                                
                                 
                                <div class="media-body text-end text-center" >
                                  <label class="switch">
                                  <input type="checkbox" onchange="cambio();" id="registro" name="registro"><span class="switch-state"></span>
                                  </label>
                                </div>

                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                          </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                  <label class="form-label" for="inputRegistrosocial">Registro Social</label>
                                  <input class="form-control" id="inputRegistrosocial" type="text" required name="registrosocial" readOnly placeholder="1252831" value="{{$beneficiario->registrosocial->folioid}}">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                              <div class="mb-3">
                                <label class="form-label" for="inputPorcentaje">Porcentaje</label>
                                <input class="form-control" id="inputPorcentaje" type="number" name="porcentaje" required readOnly placeholder="99" value="{{$beneficiario->registrosocial->porcentaje}}">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="mb-3">
                                <label class="form-label" for="inputgrupofam">Grupo Familiar</label>
                                <input class="form-control" id="inputgrupofam" type="number" name="grupofam" required placeholder="99" value="{{$beneficiario->grupofamiliar}}">
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
                                <select class="form-select digits" id="selectSector" name="sector">

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

                            <div hidden class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label" for="inputComentario">Opinión Profesional</label>
                                <input class="form-control" id="inputComentario" type="textarea"  name="comentario" placeholder="escriba un comentario aqui" value="{{$beneficiario->comentario}}">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                          </div>

                          
                          
                          
                        </div>

                        
                  







                        <div class="card-footer text-end">
                          <button class="btn btn-primary" type="submit">Actualizar datos Personales</button>
                          <input class="btn btn-light" type="reset" value="Cancel">
                        </div>
                      </form>
                    
                   
                
            </div>
        </div>




        <div class="col-sm-6 notification box-col-6">
          <div class="card card-no-border">
            <div class="card-header ">
                <h5>Menú</h5>
                
            </div>
            
            
            <div class="card-body pt-3">
              <a class="btn ver btn-dark btn-sm m-1" href="{{route('ver.pedidos', [$beneficiario->id])}}" title="Ver"><i class="fa fa-eye"></i></a>
              
              <a  class="btn solicitar btn-primary btn-sm m-1" title="Solicitar Material" href="{{route('beneficiarios.solicitar', [$beneficiario->id] )}}"><i class="fa fa-ticket"></i></a>
              <a  class="btn btn-warning btn-sm m-1" title="Crear Pdf" href="{{route('crearfichainterna', [$beneficiario->id])}}"><i class="fa fa-file-pdf-o"></i></a>
              <button data-bs-toggle="modal" data-bs-target="#modalSituacion" title="Ingresar Situaciones" class="btn btn-danger btn-sm m-1"><i class="fa fa-plus"></i></button>
             

              <div class="modal fade" id="modalSituacion" tabindex="-1" role="dialog" aria-labelledby="modalSituacion" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{route('storesituacion', [$beneficiario->id])}}" method="post">
                            @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">Ingrese un nuevo hito</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        <div class="modal-body"> 
                            <div class="modal-toggle-wrapper">  

                              
    
                                
    
                                <div class="col">
                                    <div class="mb-3">
                                      <label class="form-label" for="tipo">Tipo</label>
                                        <select name="tipo" required class="form-control" >
                                            <option value="familiar">Situación Familiar</option>
                                            <option value="salud">Situacion de Salud</option>
                                            <option value="profesional">Opinión Profesional</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                      <label class="form-label" for="comentario">Mensaje</label>
                                      <textarea name="comentario" class="form-control" id="mensaje" cols="10" rows="10"></textarea>
                                      
                                    </div>
                                </div>
                                
                                
                               
                               
                              
                                                                    
                            </div>
                        </div>  
    
                        <div class="modal-footer">
                            <button type="submit" data-dismiss="modal" class="btn btn-primary">Agregar</button>
                        </div>
                        
                        
                        </form>                                              
                        
                    </div>
                </div>
            </div>
  
            </div>      
           
        </div>
          
          <div class="card height-equal card-no-border">
              <div class="card-header ">
                  <h5>Historial Situaciones </h5>
                  
              </div>
              <div class="card-body pt-3">
                <ul style="padding-left:0px !important;"> 
              
              
                  @foreach($beneficiario->situaciones as $sit)

                    <li class="d-flex">
                      <div @if($sit->tipo == 'familiar') class="activity-dot-success" @elseif($sit->tipo == 'salud') class="activity-dot-danger"  @else class="activity-dot-primary" @endif></div>
                      <div class=" ms-3">
                        <p class="d-flex justify-content-between mb-2 mt-3"><span class="date-content light-background">{{date_format($sit->updated_at, 'd/m/Y')}}</span></p>
                        <h6>@if($sit->tipo == 'familiar') Hito Familiar @elseif($sit->tipo == 'salud') Hito Salud  @else Opinión Profesional @endif<span class="dot-notification"> </span></h6>
                        <p class="f-light">{{$sit->comentario}}</p>
                      </div>
                    </li>

                  @endforeach
              

              
              
            </ul>
          </div> 
                    
          
          
          </div>
        </div>
        

              
        
        
        
    </div>
</div>

<script type="text/javascript">
    var session_layout = '{{ session()->get('layout') }}';
</script>
   
@endsection

@section('script')

  <script src="{{ asset('assets/js/height-equal.js') }}"></script>






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

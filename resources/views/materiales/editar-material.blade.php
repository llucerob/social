@extends('layouts.master')

@section('title', 'Editar Material - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Editar Material</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Materiales</li>
    <li class="breadcrumb-item active">Editar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación usted editará {{$material->nombre}}.</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" action="{{ url('materiales/update/'.$material->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                          <div class="row g-3">
                            

                            <div class="col-md-6">
                              
                              <div class="mb-3">
                                <label class="form-label" for="inputNombre">Nombre</label>
                                <input class="form-control" id="inputNombre" type="text" required name="nombre"  value="{{$material->nombre}}" placeholder="pañales">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              
                              <div class="mb-3">
                                <label class="form-label" for="selectCategoria">Categoría</label>
                                <select class="form-select digits" id="selectCategoria" name="categoria">

                                    @foreach ($categorias as $c )
                                        <option value="{{ $c->id }}" @if ($c->id == $material->categoria_id) selected @endif>{{ $c->nombre }}</option>
                                    @endforeach
                                  
                                </select>
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            

                          </div>
                          


                          <div class="row g-3" >

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="selectMedida">Medida</label>
                                  <select class="form-select digits" id="selectMedida"  name="medida">
                                  
                                    @foreach ($medidas as $m )

                                      <option value="{{$m->abrv}}">{{$m->nombreunidad}}</option>
                                      
                                    @endforeach
                                  
                                  </select>
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>



                          </div>
                          
                          <div class="row g-3">
                            <h5 class="mt-4">Limites</h5>
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="inputLimite">Limite</label>
                                  <input class="form-control" id="inputLimite" type="number" value="{{$material->limite}}" name="limite">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputUrgencia">Limite Emergencia</label>
                                <input class="form-control" id="inputUrgencia" type="number" name="limiteurgencia" value="{{$material->limiteurgencia}}">
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
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.es.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
@endsection

@extends('layouts.master')

@section('title', 'Nuevo Material - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
@endsection

@section('style')
    
@endsection

@section('breadcrumb-title')
    <h3>Crear Nuevo Material</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Materiales</li>
    <li class="breadcrumb-item active">Nuevo</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación usted creará un nuevo Material.</h5>
                    
                </div>
                

                    <form class="needs-validation theme-form" novalidate="" action="{{ route('materiales.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                          <div class="row g-3">
                            

                            <div class="col-md-6">
                              
                              <div class="mb-3">
                                <label class="form-label" for="inputNombre">Nombre</label>
                                <input class="form-control" id="inputNombre" type="text" required name="nombre" placeholder="pañales">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              
                              <div class="mb-3">
                                <label class="form-label" for="selectCategoria">Categoría</label>
                                <select class="form-select digits" id="selectCategoria" name="categoria">

                                    @foreach ($categorias as $c )
                                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                                    @endforeach
                                  
                                </select>
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

                            

                          </div>
                          


                          <div class="row g-3">
                            <h5 class="mt-4">Stock Materiales</h5>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputStock">Stock</label>
                                <input class="form-control" id="inputStock" type="number" name="stock">
                                <div class="valid-feedback">¡Luce bien!</div>
                              </div>
                            </div>

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
                                  <input class="form-control" id="inputLimite" type="number" name="limite">
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <div class="mb-3">
                                <label class="form-label" for="inputUrgencia">Limite Emergencia</label>
                                <input class="form-control" id="inputUrgencia" type="number" name="limiteurgencia">
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

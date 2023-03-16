@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Categorías</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Utils</li>
    <li class="breadcrumb-item active">Categorías</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Listado Categorías</h5>
                    
                </div>
                <div class="card-body">
                    <!-- <div class="dt-plugin-buttons"></div> -->
                        <div class="table-responsive">
                            <table class="display datatables" id="medidas">

                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $c )
                                        <tr>
                                            <td>{{$c->nombre}}</td>
                                            <td>{{$c->descripcion}}</td>
                                            <td>
                                                
                                                <a href="{{ url('utils/categorias/destroy/'.$c->id) }}" class="btn btn-outline-danger btn-sm"><i class="icon-trash"></i></a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    
                   
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Crear nueva categoria</h5>
                    
                </div>
                
                <form class="needs-validation theme-form" novalidate="" action="{{ route('categorias.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row g-3">

                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label" for="inputNombreCategoria">Nombre Categoria</label>
                            <input class="form-control" id="inputNombreCategoria" type="text" required name="nombre" placeholder="Pañales">
                            <div class="valid-feedback">¡Luce bien!</div>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="inputAbrvCategoria">Descripción</label>
                              <input class="form-control" id="inputAbrvCategoria" type="text"  name="descripcion" placeholder="Pañales Adulto">
                              <div class="valid-feedback">¡Luce bien!</div>
                            </div>
                        </div>

                      </div>

                      <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Grabar</button>
                        <input class="btn btn-light" type="reset" value="Cancel">
                      </div>
                    </div>
                </form>
                      
            </div>
        </div>
        
        
        
    </div>
</div>


   
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>

    <script>
        $(document).ready(function(){

            $('#medidas').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>
    <!-- <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script> -->

@endsection

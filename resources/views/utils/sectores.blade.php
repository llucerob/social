@extends('layouts.master')

@section('title', 'Sectores - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Sectores</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Utils</li>
    <li class="breadcrumb-item active">Sectores</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Listado Sectores</h5>
                    
                </div>
                <div class="card-body">
                    <!-- <div class="dt-plugin-buttons"></div> -->
                        <div class="table-responsive">
                            <table class="display datatables" id="medidas">

                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sectores as $s )
                                        <tr>
                                            <td>{{$s->nombre}}</td>
                                            
                                            <td>
                                                
                                                <a href="{{ url('utils/sectores/destroy/'.$s->id) }}" class="btn btn-outline-danger btn-sm"><i class="icon-trash"></i></a>
                                                
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
                    <h5>Crear nuevo sector</h5>
                    
                </div>
                
                <form class="needs-validation theme-form" novalidate="" action="{{ route('sectores.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row g-3">

                        <div class="col">
                          <div class="mb-3">
                            <label class="form-label" for="inputNombresector">Nombre</label>
                            <input class="form-control" id="inputNombresector" type="text" required name="nombre" placeholder="Copequen">
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

    <script src="{{asset('assets/js/form-validation-custom.js')}}"></script>
    <!-- <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script> -->


@endsection

@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Beneficiarios</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Beneficiarios</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación se listarán todos los benefeciarios</h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="beneficiarios">

                            <thead>
                                <tr>
                                    <th>Rut</th>
                                    <th>Nombre Completo</th>
                                    <th>Registro Social</th>
                                    <th>Dirección</th>
                                    <th>Contacto</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiarios as $b )

                                <tr>
                                    <th>{{ $b->rut }}</th>
                                    <th>{{ $b->nombre }} {{$b->apellidos }}</th>
                                    <th> </th>
                                    <th>{{ $b->direccion }}, {{ $b->sector }}</th>
                                    <th> 
                                        <ul>
                                            <li>{{ $b->telefono}}</li>
                                            <li>{{ $b->correo}}</li>
                                        </ul>
                                    </th>
                                    <th>
                                        <a href="#modalAumentar" class="btn btn-outline-success btn-sm" title="Agregar" data-bs-toggle="modal" data-bs-target="#modalAumentar"><i class="fa fa-plus"></i></a>
                                        <a href="{{url('materiales/editar/'.$m->id)}}" class="btn btn-outline-primary btn-sm" title="Editar"><i class="fa fa-pencil"></i></a>
                                        <a href="{{url('materiales/destroy/'.$m->id)}}" class="btn btn-outline-danger btn-sm" title="Eliminar"><i class="icon-trash"></i></a>

                                            <div class="modal fade" id="modalAumentar" tabindex="-1" role="dialog" aria-labelledby="modalAumentar" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Aumento de material</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{url('materiales/aumentar/'.$m->id.'/guardar')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                    <div class="modal-body">

                                                        
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputStock">Ingrese cantidad a agregar en [{{$m->medida}}]</label>
                                                                <input class="form-control" id="inputStock" type="number" name="stock">
                                                            <div class="valid-feedback">¡Luce bien!</div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        
                                                        
                                                        <button class="btn btn-primary" type="submit">Guardar</button>
                                                        <input type="reset" class="btn btn-secondary" value="Limpiar">
                                                        
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                                                                       
                                    </th>
                                </tr>
                                    
                                @endforeach
                                
                            </tbody>

                        </table>

                    </div> 
                   
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

    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>

    <script>
        $(document).ready(function(){

            $('#beneficiarios').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>

@endsection

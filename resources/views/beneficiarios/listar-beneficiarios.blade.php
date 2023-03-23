@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
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
                    <h5>A continuación se listarán todos los beneficiarios</h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="beneficiarios">

                            <thead>
                                <tr class="text-center">
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
                                    <th width="8%">{{ $b->rut }}</th>
                                    <th>{{ $b->nombres }} {{$b->apellidos }}
                                    </th>
                                   
                                    <th class="text-center">{{ $b->registrosocial->folioid }} <br> <span class="txt-secondary"> {{ $b->registrosocial->porcentaje }}% </span></th>
                                    <th>{{ $b->direccion }}, {{ $b->sector }}</th>
                                    <th> 
                                        <ul>
                                            <li>@if(empty($b->telefono)) "NO REGISTRA INFORMACIóN" @else {{ $b->telefono}}@endif</li>
                                            <br>
                                            <li>@if(empty($b->correo)) "NO REGISTRA INFORMACIóN" @else {{ $b->correo}}@endif</li>
                                        </ul>
                                    </th>
                                    <th >
                                        
                                        <a href="{{url('beneficiarios/solicitar/'.$b->id)}}" class="btn btn-outline-primary btn-sm m-1" title="Solicitar"><i class="fa fa-ticket"></i></a>
                                        <a href="#modalAumentar" class="btn btn-outline-success btn-sm m-1" title="Modificar %" data-bs-toggle="modal" data-bs-target="#modalAumentar"><i class="fa fa-plus"></i></a>
                                        <a href="{{url('beneficiarios/editar/'.$b->id)}}" class="btn btn-outline-warning btn-sm m-1" title="Editar"><i class="fa fa-pencil"></i></a>
                                        <a href="{{url('beneficiarios/destroy/'.$b->id)}}" class="btn btn-outline-danger btn-sm m-1" title="Eliminar"><i class="icon-trash"></i></a>
                                        <a href="{{url('beneficiario/'.$b->id.'/solicitud')}}" class="btn btn-outline-primary btn-sm m-1" title="Solicitar"><i class="fa fa-check"></i></a>


                                            <div class="modal fade" id="modalAumentar" tabindex="-1" role="dialog" aria-labelledby="modalAumentar" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Registro social Hogares</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    <form action="{{url('beneficiarios/porcentaje/'.$b->registrosocial->id.'/modificar')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                    <div class="modal-body">

                                                        
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputStock">Modifique el valor del registro social de Hogares </label>
                                                                <input class="touchspin" id="inputStock" value={{$b->registrosocial->porcentaje}} name="porcentaje">
                                                            <div class="valid-feedback">¡Luce bien!</div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit">Guardar</button>                                                                         
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
    
    <!-- <script src="{{asset('assets/js/touchspin/vendors.min.js')}}"></script>-->
    <script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
    
    <script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>

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

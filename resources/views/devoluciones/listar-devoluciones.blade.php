@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Devoluciones</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Rendiciones</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación se listarán todos las devoluciones por hacer</h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="beneficiarios">

                            <thead>
                                <tr class="text-center">
                                    <th>id</th>
                                    <th>Nombre</th>
                                    
                                    <th>Rut</th>
                                    <th>Monto</th>
                                    <th>Mes</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reembolso as $key => $r )

                                @if($r->entregado == 0)

                                <tr>
                                    <th>{{ $r->id }}</th>
                                    <th>{{ $r->beneficiario->nombres }} {{$r->beneficiario->apellidos }}
                                    </th>
                                   
                                    <th>{{ $r->beneficiario->rut }}</th>
                                    <th>${{ number_format($r->suma,0,',','.')  }} Rendidos de  ${{number_format($r->total,0,',','.')}}</th>
                                    <th>{{$r->mes }} </th>
                                    <th >
                                        
                                        <a href="{{route('acepta.rendicion',[$r->id])}}" class="btn btn-outline-success btn-sm m-1" title="Aceptar rendicion"><i class="fa fa-check"></i></a>
                                        
                                        <a href="#modalmasboleta{{$key}}" class="btn btn-outline-primary btn-sm m-1" title="Agregar Boleta a la rendicion" data-bs-toggle="modal" data-bs-target="#modalmasboleta{{$key}}"><i class="fa fa-plus"></i></a>
                                        
                                        <a href="{{route('ver.boletas',[$r->id])}}" class="btn btn-outline-warning btn-sm m-1" ><i class="fa fa-eye"></i></a>

                                        <a href="{{route('eliminar.rendicion', [$r->id])}}" class="btn btn-outline-danger btn-sm m-1" title="Eliminar"><i class="icon-trash"></i></a>
                                        


                                            <div class="modal fade" id="modalmasboleta{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modalmasboleta{{$key}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Agregar Boleta a la Rendición</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    <form action="{{route('agregar.boleta', [$r->id])}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                    <div class="modal-body">

                                                        
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputvalor">Ingrese el valor de la boleta</label>
                                                                <input class="form-control" type="number" id="inputvalor"  name="valor">
                                                            <div class="valid-feedback">¡Luce bien!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputdetalle">Comentario</label>
                                                                <input class="form-control" type="text" id="inputdetalle"  name="comentario">
                                                            <div class="valid-feedback">¡Luce bien!</div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="archivo">Boleta</label>
                                                              
                                                                <input class="form-control" id="archivo" type="file" name="boleta">
                                                              
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
                               

                                
                                @endif
                                    
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

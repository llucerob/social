@extends('layouts.master')

@section('title', 'Listar Beneficiarios - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Solicitudes de {{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Solicitudes</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Solicitudes entregadas </h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="entregados">

                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th width="15%">Fecha</th>
                                    <th>Hecho por</th>                                    
                                    
                                    <th>Comentario</th>
                                    <th>Tipo Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->entregados as $e )

                               

                                <tr>
                                    
                                    <td>{{$e->entregados->cantidad}}[{{$e->entregados->medida}}] {{$e->nombre}}</td>
                                    <td>{{date_format( $e->entregados->created_at, 'Y-m-d')}}</td>
                                    <td>@if(is_null($e->entregados->atendido)) no se asignó asistente @else {{$e->entregados->atendido}} @endif </td>
                                    
                                    <td>@if(is_null($e->entregados->comentario)) no se asignó comentario @else {{$e->entregados->comentario}} @endif</td>
                                    <td>@if($e->entregados->domicilio == 1) E. DOMICILIO @else E. LOCAL @endif</td>   
                                    
                                </tr>
                                    
                                @endforeach
                                
                            </tbody>

                        </table>

                    </div> 
                   
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Solicitudes por entregar </h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="solicitudes">

                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Hecho por</th>
                                    
                                    
                                    <th>Comentario</th>
                                    <th>Tipo de entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->solicitudes as $e )

                               

                                <tr>
                                    
                                    <td>{{$e->solicitudes->cantidad}}[{{$e->solicitudes->medida}}] {{$e->nombre}}</td>
                                    <td>{{date_format($e->solicitudes->created_at, 'Y-m-d')}}</td>
                                    <td>@if(is_null($e->solicitudes->atendido)) no se asignó asistente @else {{$e->solicitudes->atendido}} @endif </td>
                                    
                                    <td>@if(is_null($e->solicitudes->comentario)) no se asignó comentario @else {{$e->solicitudes->comentario}} @endif</td>
                                    <td>@if($e->solicitudes->domicilio == 1) E. DOMICILIO @else E. LOCAL @endif</td>   
                                

                                    
                                </tr>
                                    
                                @endforeach
                                
                            </tbody>

                        </table>

                    </div> 
                   
                </div>
            </div>
        </div>

        <div class="col-sm-10">
            <div class="card">
                <div class="card-header">
                    <h5>APORTES CREADOS PARA {{$beneficiario->nombres}} {{$beneficiario->apellidos}} </h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="devoluciones">

                            <thead>
                                <tr class="text-center">
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->devoluciones as $e )

                               

                                <tr>
                                    
                                    <td>${{number_format($e->total,0,',','.')}}</td>
                                    <td>{{date_format($e->updated_at, 'Y-m-d')}}</td>
                                    <td>@if($e->entregado == 0) APORTE CREADO @elseif($e->entregado == 1) APORTE A ESPERA DE LA CREACION DE DECRETO @elseif($e->entregado == 2) APORTE PARA EVALUACION EN FINANZAS @elseif ($e->entregado == 3) APORTE TRANSFERIDO @else APORTE CON PROBLEMAS, A LA ESPERA DE RECTIFICACION @endif</td>
                                    
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

            $('#entregados').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                       

                },
                order: [[1, 'desc']]
                
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            $('#solicitudes').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>
    <script>
        $(document).ready(function(){

            $('#devoluciones').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>
    
   

@endsection

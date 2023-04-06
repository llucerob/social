@extends('layouts.master')

@section('title', 'Default')

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
                                    <th>Cantidad</th>                                    
                                    <th>Fecha</th>
                                    <th>Tipo Entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->entregados as $e )

                               

                                <tr>
                                    
                                    <td>{{$e->nombre}}</td>
                                    <td>{{$e->entregados->cantidad}}[{{$e->entregados->medida}}]</td>
                                    <td>{{date_format( $e->entregados->created_at, 'd-m-Y')}}</td>
                                    <td>@if($e->entregados->domicilio == 1) ENTREGA DOMICILIO @else ENTREGA LOCAL @endif</td>   
                                    
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
                                    <th>Cantidad</th>
                                    
                                    <th>Fecha</th>
                                    <th>Tipo de entrega</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->solicitudes as $e )

                               

                                <tr>
                                    
                                    <td>{{$e->nombre}}</td>
                                    <td>{{$e->solicitudes->cantidad}}[{{$e->solicitudes->medida}}]</td>
                                    <td>{{date_format($e->solicitudes->created_at, 'd-m-Y')}}</td>
                                    <td>@if($e->solicitudes->domicilio == 1) ENTREGA DOMICILIO @else ENTREGA LOCAL @endif</td>   
                                

                                    
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
                    <h5>Devoluciones creadas {{$beneficiario->nombres}} {{$beneficiario->apellidos}} </h5>
                    
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
                                    
                                    <th>${{number_format($e->total,0,',','.')}}</th>
                                    <th>{{$e->mes}}</th>
                                    <th>@if($e->entregado == 0) RENDICION NO FINALIZADA O ACEPTADA @else RENDICION ACEPTADA @endif</th>
                                    
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

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
                    <h5>Solicitudes entregadas a  {{$beneficiario->direccion}}, {{$beneficiario->sector}} </h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="entregados">

                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->entregados as $e )

                               

                                <tr>
                                    
                                    <th>{{$e->nombre}}</th>
                                    <th>{{$e->entregados->cantidad}}</th>
                                    <th>{{$e->entregados->created_at}}</th>
                                    
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
                    <h5>Solicitudes por entregar a   {{$beneficiario->direccion}}, {{$beneficiario->sector}} </h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="solicitudes">

                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->solicitudes as $e )

                               

                                <tr>
                                    
                                    <th>{{$e->nombre}}</th>
                                    <th>{{$e->solicitudes->cantidad}}</th>
                                    <th>{{$e->solicitudes->created_at}}</th>
                                    
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
    
   

@endsection
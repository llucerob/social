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
    <li class="breadcrumb-item">Boletas</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación se listarán las boletas de la rendicion de {{$rendicion->mes}} de {{$rendicion->beneficiario->nombres}} {{$rendicion->beneficiario->apellidos}}</h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="beneficiarios">

                            <thead>
                                <tr class="text-center">
                                    <th>id</th>
                                    <th>Valor</th>
                                    
                                    <th>Detalle</th>
                                    
                                    <th>Accion</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($rendicion->boletas as $b )
                                   
                              

                                <tr>
                                    <th>{{ $b->id }}</th>
                                    <th>${{ number_format($b->valor,0,',','.')  }}</th>
                                   
                                    <th>{{ $b->detalle }}</th>
                                    
                                    
                                    <th >
                                        
                                        
                                        
                                        <a href="{{url('storage/'.$b->ruta)}}" class="btn btn-outline-warning btn-sm m-1" target="_blank" title="ver Archivo"><i class="fa fa-eye"></i></a>
  
                                                                                       
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

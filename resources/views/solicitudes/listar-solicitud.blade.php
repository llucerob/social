@extends('layouts.master')

@section('title', 'Listar Solicitudes - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Materiales por entregar a {{ $beneficiario->nombres }} {{ $beneficiario->apellidos }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Solicitud</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Estos materiales se deben entregar en {{$beneficiario->direccion}}, {{$beneficiario->sector}} </h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="beneficiarios">

                            <thead>
                                <tr class="text-center">
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Comentario</th>
                                    
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiario->solicitudes as $b )

                               

                                <tr>
                                    
                                    <td>{{ $b->nombre }} </td>
                                    <td>{{ $b->solicitudes->cantidad }} [{{$b->solicitudes->medida}}] </td>
                                    <td>{{ $b->solicitudes->comentario}}</td>
                                    <td><a href="{{route('entregar.material', [$b->solicitudes->id] )}}" class="btn btn-outline-success btn-sm m-1"><i class="fa fa-check"></i></a></td>
                                    
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

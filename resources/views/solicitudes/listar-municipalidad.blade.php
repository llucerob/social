@extends('layouts.master')

@section('title', 'Listar Solicitudes Municipales - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Solicitudes</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Municipalidad</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Solicitudes Municipales realizadas</h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="solicitudes">

                            <thead>
                                <tr class="text-center">
                                    <th>Motivo</th>
                                    <th>Material</th>
                                    <th>Fecha</th>
                                    <th>Realizada por</th>
                                    <th>Acciones</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitudes as $b )

                               

                                <tr>
                                    
                                    <td>{{ $b->motivo }} </td>
                                    <td><ul>
                                        @foreach ($b->solicitudmunicipal as $item)

                                        <li>{{$item->solicitudmunicipal->cantidad}} [{{$item->solicitudmunicipal->unidad}}] de {{$item->nombre}} </li>
                                            
                                        @endforeach
                                        </ul> </td>
                                    <td>{{$b->created_at}}</td>
                                    <td>{{$b->atendido}}</td>
                                    <td><a href="{{route('reintegrar.material', $b->id)}}" type="button" class="btn btn-secondary"><i class="fa fa-mail-reply"></i></a>
                                        <a href="{{route('imprimir.municipal', $b->id)}}" type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></a></td>
                                    
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

            $('#solicitudes').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>
    
   

@endsection

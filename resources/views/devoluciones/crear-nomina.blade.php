@extends('layouts.master')

@section('title', 'Listar Devoluciones - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Reembolsos</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Reembolsos</li>
    <li class="breadcrumb-item active">Crear Nomina</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-center">
                    <h5>A continuación se listarán todos los Aportes por hacer en el decreto {{$decreto}}</h5>
                        <span class="text-danger"><strong>Si uno se encuentra malo presionar el boton rectificar en caso contrario aceptar</strong></span>
                        <a href="{{route('acepta.decreto', [$decreto])}}"  class="btn btn-outline-success btn-sm m-3" title="Aceptar Nómina">Aceptar</a>
                        <a data-bs-toggle="modal" data-bs-target="#modalRechazo" class="btn btn-outline-warning btn-sm m-3" title="Rechazar Nómina">Rechazar</a>


                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="beneficiarios">

                            <thead>
                                <tr class="text-center">
                                                                       
                                    <th>Rut</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Banco</th>
                                    <th>Forma de Pago</th>
                                    <th>Nº Cuenta</th>
                                    <th>Monto del Pago</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reembolso as $r )

                           

                                <tr>
                                    <td>{{ $r['rut' ]}}</td>
                                    <td>{{ $r['nombre'] }}</td>
                                    <td>{{ $r['mail']}}</td>
                                    <td>{{ $r['banco'] }}</td>
                                    <td>{{ $r['formapago']}}</td>
                                    <td>{{ $r['numerocuenta']}} </td>
                                    <td>{{ $r['monto']}}</td>
                                    
                                </tr>


                                                                    
                      
                                    
                                @endforeach
                                
                            </tbody>

                        </table>

                    </div> 

                    <div class="modal fade" id="modalRechazo" tabindex="-1" role="dialog" aria-labelledby="modalRechazo" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Agregar Comentario</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <form action="{{route('rechaza.decreto', [$decreto])}}"  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
    
                                    
                                
    
                                   
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputComentario">Comentario</label>
                                            <textarea id="inputcomentario" name="comentario"  class="form-control" cols="30" rows="10"></textarea>
                                                            
                                            
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

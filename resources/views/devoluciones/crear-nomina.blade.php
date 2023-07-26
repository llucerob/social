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
                <div class="card-header">
                    <h5>A continuación se listarán todos los reembolsos por hacer</h5>
                    
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

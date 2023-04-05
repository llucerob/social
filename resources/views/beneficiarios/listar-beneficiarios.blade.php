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
                                    
                                    <th width="8%" class="text-center">Registro Social</th>
                                    <th>Dirección</th>
                                    
                                    
                                    <th></th>
                                </tr>
                            </thead>
                          
                        </table>

                    </div> 

                    <div class="modal fade" id="modalAumentar" tabindex="-1" role="dialog" aria-labelledby="modalAumentar" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Registro social Hogares</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <form action="{{route('porcentaje.modificar')}}"  method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-body">

                                
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label" for="inputporcentaje">Modifique el valor del registro social de Hogares </label>
                                        <input class="touchspin" id="inputporcentaje"  name="porcentaje">
                                        <input type="text" id="idregistro" name="registro" hidden>
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

                <div class="modal fade" id="modalDevolucion" tabindex="-1" role="dialog" aria-labelledby="modalDevolucion" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Generar Devolución</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <form action="{{route('crear.devolucion')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">

                            
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="inputdevolucion">Ingrese el Valor de la devolucion </label>
                                    <input class="form-control" id="inputdevolucion" type="number" name="devolucion">
                                    <input type="text" id="idusuario" name="idusuario" hidden>
                                    
                                <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>
                            <div class="col">                                                        
                                    <div class="mb-3">
                                        <label class="form-label" for="selectMes">Mes</label>
                                        <select class="form-select digits" id="selectMes" name="mes">
        
                                            <option value="Enero {{now()->format('Y')}}">Enero {{now()->format('Y')}}</option>
                                            <option value="Febrero {{now()->format('Y')}}">Febrero {{now()->format('Y')}}</option>
                                            <option value="Marzo {{now()->format('Y')}}">Marzo {{now()->format('Y')}}</option>
                                            <option value="Abril {{now()->format('Y')}}">Abril {{now()->format('Y')}}</option>
                                            <option value="Mayo {{now()->format('Y')}}">Mayo {{now()->format('Y')}}</option>
                                            <option value="Junio {{now()->format('Y')}}">Junio {{now()->format('Y')}}</option>
                                            <option value="Julio {{now()->format('Y')}}">Julio {{now()->format('Y')}}</option>
                                            <option value="Agosto {{now()->format('Y')}}">Agosto {{now()->format('Y')}}</option>
                                            <option value="Septiembre {{now()->format('Y')}}">Septiembre {{now()->format('Y')}}</option>
                                            <option value="Octubre {{now()->format('Y')}}">Octubre {{now()->format('Y')}}</option>
                                            <option value="Noviembre {{now()->format('Y')}}">Noviembre {{now()->format('Y')}}</option>
                                            <option value="Diciembre {{now()->format('Y')}}">Diciembre {{now()->format('Y')}}</option>
                                           
                                          
                                        </select>
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

            var tabla = $('#beneficiarios').DataTable({
                    language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json'},
                    ajax: '{{route('datatable.beneficiarios')}}',
                    columns: [
                        {data: 'rut'},
                        {data: 'nombre'},
                        {data: 'registrosocial'},
                        {data: 'direccion'},
                        {
                            data: null,
                            defaultContent: '<button  class="btn solicitar btn-primary btn-sm m-1" title="Solicitar Material"><i class="fa fa-ticket"></i></button><button class="btn imprimir btn-secondary btn-sm m-1" title="imprimir"><i class="fa fa-file-pdf-o"></i></button><button href="#modalDevolucion" class="btn devolucion btn-info btn-sm m-1" title="Solicitar Devolución" data-bs-toggle="modal" data-bs-target="#modalDevolucion"><i class="fa fa-money"></i></button><button href="#modalAumentar" class="btn aumentar btn-success btn-sm m-1" title="Modificar %" data-bs-toggle="modal" data-bs-target="#modalAumentar"><i class="fa fa-plus"></i></button><button class="btn btn-warning btn-sm m-1 editar" title="Editar"><i class="fa fa-pencil"></i></button><button class="btn btn-danger eliminar btn-sm m-1" title="Eliminar"><i class="icon-trash"></i></button><button class="btn ver btn-dark btn-sm m-1" title="Ver"><i class="fa fa-eye"></i></button>',
                           
                                
                            },
                        
                        
                        ],               
                        
                });

            obtener_data_solicitar('#beneficiarios', tabla);
            obtener_data_imprimir('#beneficiarios', tabla);
            obtener_data_aumentar('#beneficiarios', tabla);
            obtener_data_devolucion('#beneficiarios', tabla);
            obtener_data_editar('#beneficiarios', tabla);
            obtener_data_eliminar('#beneficiarios', tabla);
            obtener_data_ver('#beneficiarios', tabla);
            
        });

        var obtener_data_solicitar = function(tbody, tabla){
            $(tbody).on ('click', 'button.solicitar',function(){
                var data = tabla.row($(this).parents('tr')).data();

                location.href = "/beneficiarios/solicitar/"+data.id;
                
            })
        }
        var obtener_data_imprimir = function(tbody, tabla){
            $(tbody).on ('click', 'button.imprimir',function(){
                var data = tabla.row($(this).parents('tr')).data();

                location.href = "/beneficiario/"+data.id+"/imprimir/";
                
            })
        }
        var obtener_data_aumentar = function(tbody, tabla){
            $(tbody).on ('click', 'button.aumentar',function(){
                var data = tabla.row($(this).parents('tr')).data();
                var idregistro = $('#idregistro').val(data.idficha);  
                             
                var inputporcentaje = $('#inputporcentaje').val(data.porcentaje);

            })
        }
        var obtener_data_devolucion = function(tbody, tabla){
            $(tbody).on ('click', 'button.devolucion',function(){
                var data = tabla.row($(this).parents('tr')).data();
                
                var idusuario = $('#idusuario').val(data.id);                
                

            })
        }
        var obtener_data_editar = function(tbody, tabla){
            $(tbody).on ('click', 'button.editar', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = "/beneficiarios/editar/"+data.id;
            })
        }

        var obtener_data_eliminar = function(tbody, tabla){
            $(tbody).on ('click', 'button.eliminar', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = "/beneficiarios/destroy/"+data.id;
            })
        }
        var obtener_data_ver = function(tbody, tabla){
            $(tbody).on ('click', 'button.ver', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = "/beneficiario/"+data.id+"/verpedidos";
            })
        }


        


    </script>
    
   

@endsection

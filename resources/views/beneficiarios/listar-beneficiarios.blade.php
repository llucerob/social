@extends('layouts.master')

@section('title', 'Listar Beneficiario - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/date-picker.css')}}">
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

                    <div class="modal fade" id="modalFallecido" tabindex="-1" role="dialog" aria-labelledby="modalFallecido" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Atención</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            
                                <div class="modal-body"> 
                                    <div class="modal-toggle-wrapper">  
                                      <div class="modal-img text-center">
                                         <img src="{{asset('assets/images/gif/danger.gif')}}"  width="100px" alt="error">
                                      </div>
                                      <h4 class="text-center pb-2">¿Realmente desea marcar como fallecido este registro?</h4>
                                      <p class="text-center">Esta acción no se puede deshacer</p>
                                      <form action="{{route('beneficiario.fallecer')}}"  method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" id="idusuario" name="idusuario" hidden>
                                        <button class="btn btn-secondary d-flex m-auto" type="submit">Marcar como Fallecido</button>
                                      </form>
                                    </div>
                                </div>                                                   
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="modalComentario" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Comentario</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            
                                <div class="modal-body"> 
                                    <div class="modal-toggle-wrapper">  
                                      <div class="modal-img text-center" >



                                        <p class="text-primary " id="contComentario"></p>
                                         
                                      </div>

                                      
                                                                            
                                    </div>
                                </div>                                                   
                            </div>
                        </div>
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
                                <h5 class="modal-title">Generar Aporte</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                        <form action="{{route('crear.devolucion')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">

                            
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="inputdevolucion">Ingrese el Valor de la devolucion </label>
                                    <input class="form-control" required id="inputdevolucion" type="number" name="devolucion">
                                    <input type="text" id="usuario" name="idusuario" hidden>
                                    
                                <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div><div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="inputprestacion">Ingrese el Tipo Prestación </label>
                                    <input class="form-control" required id="inputprestacion" type="text" name="tipoprestacion">
                                    
                                    
                                <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label" for="inputMotivo">Ingrese el Motivo </label>
                                <div class="mb-3">
                                   
                                    <textarea name="motivo" required class="form-control" id="inputmotivo" cols="55" rows="10"></textarea>
                                <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                            </div>
                            <div class="col">
                                <label class="form-label" for="inputnboleta">Nº Boleta (separar numero boleta por " "(espacio) o salto de linea (enter))</label>
                                <div class="mb-3">
                                  
                                  <textarea name="boleta" required id="inputboleta" class="form-control" cols="55" rows="5"></textarea>
                                  
                                  <div class="valid-feedback">¡Luce bien!</div>
                                </div>
                              </div>
                            
                            
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Crear Aporte</button>                                                                         
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
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.es.js')}}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>


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
                            defaultContent: '<button class="btn imprimir btn-secondary btn-sm m-1" title="imprimir"><i class="fa fa-file-pdf-o"></i></button><button class="btn devolucion btn-info btn-sm m-1" title="Solicitar Devolución" data-bs-toggle="modal" data-bs-target="#modalDevolucion"><i class="fa fa-money"></i></button><button class="btn aumentar btn-success btn-sm m-1" title="Modificar %" data-bs-toggle="modal" data-bs-target="#modalAumentar"><i class="fa fa-plus"></i></button><button class="btn btn-warning btn-sm m-1 editar" title="ver ficha"><i class="fa fa-book"></i></button><button class="btn btn-danger fallecido btn-sm m-1" title="Marcar como fallecido" data-bs-toggle="modal" data-bs-target="#modalFallecido"><i class="icofont icofont-skull-face"></i></button>',
                           
                                
                            },
                        
                        
                        ],               
                        
                });

            obtener_data_solicitar('#beneficiarios', tabla);
            obtener_data_imprimir('#beneficiarios', tabla);
            obtener_data_aumentar('#beneficiarios', tabla);
            obtener_data_devolucion('#beneficiarios', tabla);
            obtener_data_editar('#beneficiarios', tabla);
            obtener_data_fallecido('#beneficiarios', tabla);
            //obtener_data_eliminar('#beneficiarios', tabla);
            obtener_data_ver('#beneficiarios', tabla);
            obtener_data_comentario('#beneficiarios', tabla);
            
        });

        var obtener_data_solicitar = function(tbody, tabla){
            $(tbody).on ('click', 'button.solicitar',function(){
                var data = tabla.row($(this).parents('tr')).data();

                location.href = "solicitar/"+data.id;
                
            })
        }
        var obtener_data_imprimir = function(tbody, tabla){
            $(tbody).on ('click', 'button.imprimir',function(){
                var data = tabla.row($(this).parents('tr')).data();

                location.href = +data.id+"/imprimir/";
                
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
                
                var usuario = $('#usuario').val(data.id);                
                

            })
        }
        var obtener_data_editar = function(tbody, tabla){
            $(tbody).on ('click', 'button.editar', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = "editar/"+data.id;
            })
        }

        var obtener_data_fallecido = function(tbody, tabla){
            $(tbody).on ('click', 'button.fallecido', function(){
                var data = tabla.row($(this).parents('tr')).data();
                var idusuario = $('#idusuario').val(data.id);
            })
        }

        /*var obtener_data_eliminar = function(tbody, tabla){
            $(tbody).on ('click', 'button.eliminar', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = "destroy/"+data.id;
            })
        }*/
        var obtener_data_ver = function(tbody, tabla){
            $(tbody).on ('click', 'button.ver', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = +data.id+"/verpedidos";
            })
        }

        var obtener_data_xficha = function(tbody, tabla){
            $(tbody).on ('click', 'button.historialficha', function(){
                var data = tabla.row($(this).parents('tr')).data();
                location.href = "historiaxficha/"+data.idficha;
            })
        }
        var obtener_data_comentario = function(tbody, tabla){
            $(tbody).on ('click', 'button.comentario', function(){
                var data = tabla.row($(this).parents('tr')).data();
                if(data.comentario){
                    var comentario = $('#contComentario').html(data.comentario);

                  

                }else{
                    var comentario = $('#contComentario').html('No se ha ingresado comentario');
                }
                 
                 
            })
        }


        


    </script>
    
   

@endsection

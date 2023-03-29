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
                                    
                                    <th width="12%">Registro Social</th>
                                    <th>Dirección</th>
                                    <th>Contacto</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($beneficiarios as $key => $b )

                                <tr>
                                    <th width="8%">{{ $b->rut }}</th>
                                    <th>{{ $b->nombres }} {{$b->apellidos }}<br>
                                        ({{ \Carbon\Carbon::parse($b->fnac)->age;}} Años)
                                    </th>
                                   
                                    <th class="text-center">{{ $b->registrosocial->folioid }} <br> <span class="txt-secondary"> {{ $b->registrosocial->porcentaje }}% </span>
                                    
                                    <br>Fecha: {{date_format($b->registrosocial->updated_at, 'd/m/y')}}
                                    
                                    </th>
                                    
                                    <th>{{ $b->direccion }}, {{ $b->sector }}</th>
                                    <th> 
                                        <ul>
                                            <li>@if(empty($b->telefono)) "NO REGISTRA INFORMACIóN" @else {{ $b->telefono}}@endif</li>
                                            <br>
                                            <li>@if(empty($b->correo)) "NO REGISTRA INFORMACIóN" @else {{ $b->correo}}@endif</li>
                                        </ul>
                                    </th>
                                    <th >
                                        
                                        <a href="{{url('beneficiarios/solicitar/'.$b->id)}}" class="btn btn-outline-primary btn-sm m-1" title="Solicitar Material"><i class="fa fa-ticket"></i></a>
                                        @if (count($b->solicitudes) > 0) <a href="{{url('beneficiario/'.$b->id.'/imprimir')}}" class="btn btn-outline-secondary btn-sm m-1" title="imprimir"><i class="fa fa-file-pdf-o"></i></a> @endif
                                        
                                        <a href="#modalDevolucion{{$key}}" class="btn btn-outline-info btn-sm m-1" title="Solicitar Devolución" data-bs-toggle="modal" data-bs-target="#modalDevolucion{{$key}}"><i class="fa fa-money"></i></a>
                                        <a href="#modalAumentar{{$key}}" class="btn btn-outline-success btn-sm m-1" title="Modificar %" data-bs-toggle="modal" data-bs-target="#modalAumentar{{$key}}"><i class="fa fa-plus"></i></a>
                                        <a href="{{url('beneficiarios/editar/'.$b->id)}}" class="btn btn-outline-warning btn-sm m-1" title="Editar"><i class="fa fa-pencil"></i></a>
                                        <a href="{{url('beneficiarios/destroy/'.$b->id)}}" class="btn btn-outline-danger btn-sm m-1" title="Eliminar"><i class="icon-trash"></i></a>
                                        


                                            <div class="modal fade" id="modalAumentar{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modalAumentar{{$key}}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Registro social Hogares</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                    <form action="{{url('beneficiarios/porcentaje/'.$b->registrosocial->id.'/modificar')}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                    <div class="modal-body">

                                                        
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputStock">Modifique el valor del registro social de Hogares </label>
                                                                <input class="touchspin" id="inputStock" value={{$b->registrosocial->porcentaje}} name="porcentaje">
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

                                        <div class="modal fade" id="modalDevolucion{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modalDevolucion{{$key}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Generar Devolución</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <form action="{{route('crear.devolucion', [$b->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                <div class="modal-body">

                                                    
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="inputdevolucion">Ingrese el Valor de la devolucion </label>
                                                            <input class="form-control" id="inputdevolucion" type="number" name="devolucion">
                                                            
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

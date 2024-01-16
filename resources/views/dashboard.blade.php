@extends('layouts.master')

@section('title', 'Dashboard - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Solicitudes por entregar</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Escritorio</li>
   
@endsection

@section('content')
<div class="container-fluid">
    

    <div class="row starter-main">

        

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('eleccion.sectores')}}" method="post">
                        @csrf

                        <div class="col-md-6">
                            <div class="mb-2">
                              <div class="col-form-label">Sectores (entrega domicilio)</div>
                              <select class="js-example-basic-multiple  col-sm-6" name="sectores[]" id="sectores" required multiple="multiple">
                                
                                @foreach($sectores as $s)
                                <option value="{{$s->nombre}}">{{$s->nombre}}</option>
                                @endforeach
                               
                                
                               
                              </select>
                              <div class="valid-feedback">¡Luce bien!</div>
                              <div class="invalid-feedback">Por favor seleccionar un material.</div>
                            </div>
                          </div>

                        <button type="submit" class="btn btn-outline-primary btn-sm m-1">Imprimir</button>
                        
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">


                        <table class="display datatables" id="domicilio">

                            <thead>
                                <tr class="text-center">
                                    <th width="9%">Rut</th>
                                    <th>Nombres</th>
                                    <th>Direccion</th>
                                    <th>Materiales</th>
                                    <th>Atendido</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($beneficiarios as  $d )

                                        @if($d['atendido'] ==  Auth::user()->name || Auth::user()->hasRole('admin'))
                                    
                                                <tr>
                                                    <td>{{$d['rut']}}</td>
                                                    <td>{{$d['nombre']}}</td>
                                                    
                                                    <td>{{$d['direccion']}}</td>
                                                    
                                                    <td><ul>
                                                    @foreach($d['materiales'] as $f)

                                                        <li>{{$f['nombre']}} <span class="text-danger"> @if($f['domicilio'] == 1) E. DOMICILIO  @else E. LOCAL @endif </span>  </li>

                                                    @endforeach
                                                    </ul></td>
                                                    <td>@if(is_null($d['atendido'])) No se asignó asistente @else {{$d['atendido']}} @endif</td>
                                                    <td>
                                                        <a class="btn btn-outline-primary btn-sm m-1" title="Imprimir" href="{{ route('imprimir', $d['id']) }}">Imprimir</a>
                                                        
                                                        <a class="btn btn-outline-success btn-sm m-1" title="Marcar como entregado"  href="{{ route('beneficiario.material', $d['id']) }}">Entregar</a>

                                                        <a class="btn btn-outline-danger btn-sm m-1" title="Devolver solicitud"  href="{{ route('beneficiario.devolvermaterial', $d['id']) }}">Devolver</a>

                                                    
                                                    </td>
                                                </tr>
                                        @endif

                                                                                
                                   

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
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>

 


<script>
    $(document).ready(function(){

        $('#domicilio').DataTable({
            language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
           
            },
        });
    });
</script>

<script>
    $(document).ready(function(){

      $('#sectores').select2({

      });
    });
  </script>
@endsection

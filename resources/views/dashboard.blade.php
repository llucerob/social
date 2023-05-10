@extends('layouts.master')

@section('title', 'Default')

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
                               @foreach ($beneficiarios as $key => $d )
                                    @if(count($d->solicitudes) > 0)
                                        <tr>
                                            <th>{{$d->rut}}</th>
                                            <th>{{$d->nombres}} {{$d->apellidos}}</th>
                                            
                                            <th>{{$d->direccion}}, {{$d->sector}}</th>
                                            
                                            <th><ul>
                                            @foreach($d->solicitudes as $f)

                                                <li>{{$f->solicitudes->cantidad}} {{$f->solicitudes->medida}} de {{$f->nombre}} <span class="text-danger"> @if($f->solicitudes->domicilio == 1) E. DOMICILIO  @else E. LOCAL @endif </span>  </li>

                                            @endforeach
                                            </ul></th>
                                            <th>@if(is_null($d->solicitudes[0]->solicitudes->atendido)) No se asignó asistente @else {{$d->solicitudes[0]->solicitudes->atendido}} @endif</th>
                                            <th>
                                                <a class="btn btn-outline-primary btn-sm m-1" title="Imprimir" href="{{ route('imprimir', [$d->id]) }}">Imprimir</a>
                                                
                                                <a class="btn btn-outline-success btn-sm m-1" title="Marcar como entregado"  href="{{ route('beneficiario.material', [$d->id]) }}">Entregar</a>

                                                
                                            
                                            </th>
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

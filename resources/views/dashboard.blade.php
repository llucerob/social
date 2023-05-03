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
       
        @foreach ( $beneficiarios as $key => $b )
            @if(count($b->solicitudes) > 0 )



                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{$b->nombres}} {{$b->apellidos}}</h5>
                          
                            

                        
                        </div>
                        <div class="card-body">
                            {{count($b->solicitudes)}} materiales por entregar 
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-outline-primary btn-sm m-1" title="Imprimir" href="{{ route('imprimir', [$b->id]) }}">Imprimir</a>
                            <a class="btn btn-outline-secondary btn-sm m-1" title="Ver"  data-bs-toggle="modal" data-bs-target="#modalVer{{$key}}" href="#modalVer{{$key}}">Ver</a>
                            <a class="btn btn-outline-success btn-sm m-1" title="Marcar como entregado"  href="{{ route('beneficiario.material', [$b->id]) }}">Entregar</a>



                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalVer{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modalver" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Materiales por entregar </h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          
                        <div class="modal-body">

                            
                            <div class="col">
                                <div class="mb-3">
                                    <ul>
                                        @foreach ($b->solicitudes as $s )
                                            <li> <i class="fa fa-arrow-right"></i> {{$s->nombre}} -- {{$s->solicitudes->cantidad}}[{{$s->solicitudes->medida}}] </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer">
                           
                                                                                                 
                        </div>
                    
                    </div>
                </div>
            </div>



            @endif
            
        @endforeach
        
        
        
        
        
    </div>

    <div class="row starter-main">

        <h3 class="tex-center">Entrega a domicilio</h3>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <form action="{{route('eleccion.sectores')}}" method="post">
                        @csrf

                        <div class="col-md-6">
                            <div class="mb-2">
                              <div class="col-form-label">Sectores</div>
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
                                    <th>Nombres</th>
                                    <th>Rut</th>
                                    <th>Direccion</th>
                                    <th>Sector</th>
                                    <th>Materiales</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($beneficiarios as $d )
                                    @if(count($d->solicitudes) > 0)
                                        <tr>
                                            <th>{{$d->nombres}} {{$d->apellidos}}</th>
                                            <th>{{$d->rut}}</th>
                                            <th>{{$d->direccion}}</th>
                                            <th>{{$d->sector}}</th>

                                            <th><ul>
                                            @foreach($d->solicitudes as $f)

                                                <li>{{$f->solicitudes->cantidad}} {{$f->solicitudes->medida}} de {{$f->nombre}}</li>

                                            @endforeach
                                            </ul></th>
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

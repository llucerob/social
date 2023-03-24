@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
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
                            <a class="btn btn-outline-primary btn-sm m-1" title="Imprimir" href="{{ url('beneficiario/'.$b->id.'/imprimir') }}">Imprimir</a>
                            <a class="btn btn-outline-secondary btn-sm m-1" title="Ver"  data-bs-toggle="modal" data-bs-target="#modalVer{{$key}}" href="#modalVer{{$key}}">Ver</a>
                            <a class="btn btn-outline-success btn-sm m-1" title="Marcar como entregado"  href="{{url('beneficiario/'.$b->id.'/entregarmaterial')}}">Entregar</a>

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
</div>

<script type="text/javascript">
    var session_layout = '{{ session()->get('layout') }}';
</script>
   
@endsection

@section('script')
@endsection

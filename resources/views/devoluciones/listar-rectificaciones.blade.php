@extends('layouts.master')

@section('title', 'Listar Devoluciones - I. Municipalidad Coinco')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/daterange-picker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Devoluciones por Rectificar</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Rendiciones</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">

        <div class="col-xxl-8 col-xl-8 col-md-8 col-sm-8  box-col-6">
            <div class="card height-equal card-no-border">
                <div class="card-header text-center">
                    <h5>Rectificacion</h5>
                    <a href="{{route('reenviar.decreto', [$decreto])}}" class="btn btn-outline-success m-2" title="Reenviar Decreto">Reenviar</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="rectificacion">

                            <thead>
                                <tr class="text-center">
                                    
                                    <th>Nombre</th>
                                    
                                    <th>Rut</th>
                                    <th>Monto</th>
                                    <th>F. Solicitud</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($reembolso != 'sinregistro')

                                @foreach ($reembolso as $key => $r )

                                

                                <tr>
                                    
                                    <td>{{ $r->beneficiario->nombres }} {{$r->beneficiario->apellidos }}
                                    </td>
                                   
                                    <td>{{ $r->beneficiario->rut }}</td>
                                    <td>${{number_format($r->total,0,',','.')}}</td>
                                    <td>{{date_format($r->created_at, 'd-m-Y')}}</td>
                                    <td>
                                        
                                        
                                        <a class="btn btn-outline-primary btn-sm m-1" title="Editar Cuenta" data-bs-toggle="modal" data-bs-target="#modalEditar{{$key}}"><i class="fa fa-pencil"></i></a>
                                       
                                        <a href="{{route('beneficiarios.edit',[$r->beneficiario->id])}}" class="btn btn-outline-warning btn-sm m-1 editar" title="Editar usuario"><i class="fa fa-user"></i></a>
                                                                       
                                    </td>
                                </tr>



                                <div class="modal fade" id="modalEditar{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modalEditar{{$key}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Cuenta Bancaria</h5>
                                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        <form action="{{route('editar.cuenta',[$r->beneficiario->id])}}"  method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                
                                                
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputbanco">Banco</label>
                                                        <select name="banco" class="form-control" id="inputbanco">
                                                            
                                                            <option value="012" @if($r->beneficiario->cuenta->banco == '012') selected @endif>BANCO DEL ESTADO DE CHILE</option>
                                                            <option value="504" @if($r->beneficiario->cuenta->banco == '504') selected @endif>BANCO BBVA ( BILBAO VIZCAYA ARGENTARIA CHILE) / BANCO BHIF</option>
                                                            <option value="028" @if($r->beneficiario->cuenta->banco == '028') selected @endif>BANCO BICE</option>
                                                            <option value="055" @if($r->beneficiario->cuenta->banco == '055') selected @endif>BANCO CONSORCIO</option>
                                                            <option value="027" @if($r->beneficiario->cuenta->banco == '027') selected @endif>BANCO CORPBANCA</option>
                                                            <option value="001" @if($r->beneficiario->cuenta->banco == '001') selected @endif>BANCO DE CHILE / BANCO A. EDWARDS / CREDICHILE</option>
                                                            <option value="016" @if($r->beneficiario->cuenta->banco == '016') selected @endif>BANCO DE CRÉDITO E INVERSIONES / TBANC</option>
                                                            <option value="507" @if($r->beneficiario->cuenta->banco == '507') selected @endif>BANCO DEL DESARROLLO</option>
                                                            <option value="051" @if($r->beneficiario->cuenta->banco == '051') selected @endif>BANCO FALABELLA</option>
                                                            <option value="009" @if($r->beneficiario->cuenta->banco == '009') selected @endif>BANCO INTERNACIONAL</option>
                                                            <option value="039" @if($r->beneficiario->cuenta->banco == '039') selected @endif>BANCO ITAU CHILE / BANK BOSTON</option>
                                                            <option value="037" @if($r->beneficiario->cuenta->banco == '037') selected @endif>BANCO SANTANDER - SANTIAGO / BANCO SANTANDER / BANEFE</option>
                                                            <option value="049" @if($r->beneficiario->cuenta->banco == '049') selected @endif>BANCO SECURITY</option>
                                                            <option value="045" @if($r->beneficiario->cuenta->banco == '045') selected @endif>BANCO TOKIO</option>
                                                            <option value="672" @if($r->beneficiario->cuenta->banco == '672') selected @endif>COOPEUCH</option>
                                                            <option value="031" @if($r->beneficiario->cuenta->banco == '031') selected @endif>HSBC BANK (Chile)</option>
                                                            <option value="014" @if($r->beneficiario->cuenta->banco == '014') selected @endif>SCOTIABANK / SUD - AMERICANO  </option>

                                                        </select>
                                                        
                                                    <div class="valid-feedback">¡Luce bien!</div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputtipocuenta">Tipo Cuenta</label>
                                                        <select name="tipocuenta" class="form-control" id="inputtipocuenta">

                                                            <option value="01" @if($r->beneficiario->cuenta->tipocuenta == '01') selected @endif>CTA. CORRIENTE / CTA. VISTA</option>
                                                            <option value="02" @if($r->beneficiario->cuenta->tipocuenta == '02') selected @endif>CTA. AHORRO</option>
                                                            <option value="30" @if($r->beneficiario->cuenta->tipocuenta == '30') selected @endif>CUENTA RUT</option>
                                                        </select>
                                                        
                                                    <div class="valid-feedback">¡Luce bien!</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="inputcuenta">Nº Cuenta</label>
                                                        <input type="text" class="form-control" id="inputcuenta" name="cuenta" value="{{$r->beneficiario->cuenta->numerocuenta}}" >
                                                        
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
                       


                                        
                               

                                
                              
                                    
                                @endforeach
                                
                                @endif
                                
                            </tbody>

                        </table>

                    </div> 

                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-md-4 col-sm-4  box-col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Lista decretos por rectificar</h5>
                </div>
                <div class="card-body">
                    <ul>
                 
                        @foreach($lista as $r)
                        

                            <a href="{{route('aportes.fallas', [$r])}}" ><li>{{$r}}</li></a>
                        @endforeach
                    </ul>

                </div>
            </div>

            
            <div class="card card-no-border notification">
                <div class="card-header">
                    <h5>Comentarios</h5>
                </div>
                <div class="card-body pt-3">

                    @if($comentarios == null)

                    <p> No se ha cargado ningun decreto</p>
                
                    @else
                    <ul style="padding-left:0px !important;"> 
                        @foreach($comentarios as $l)
                        
                        
                            <li class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="ms-3">
                                    <p class="d-flex justify-content-between mb-2 mt-3"><span class="date-content light-background">{{date_format($l['created_at'], 'd/m/Y')}}</span></p>
                                    <h6>{{$l['comentario']}}</h6>
                                   
                                </div>
                            </li>
                          
                        
                        @endforeach
                    </ul>

                    @endif
                </div>
            
            </div>
        </div>

        
       
      

        
        
    </div>
</div>

   
   
@endsection

@section('script')
    
    <!-- <script src="{{asset('assets/js/touchspin/vendors.min.js')}}"></script>
    <script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
    
    <script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>
    -->

    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    


  

    <script>
        $(document).ready(function(){

            $('#rectificacion').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>
   
   


   @endsection

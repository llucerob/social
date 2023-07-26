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
    <h3>Listado Devoluciones</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Rendiciones</li>
    <li class="breadcrumb-item active">Listar</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación se listarán todos las devoluciones por hacer</h5>
                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display datatables" id="porhacer">

                            <thead>
                                <tr class="text-center">
                                    <th>id</th>
                                    <th>Nombre</th>
                                    
                                    <th>Rut</th>
                                    <th>Monto</th>
                                    <th>F. Solicitud</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reembolso as $key => $r )

                                @if($r->entregado == 0)

                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->beneficiario->nombres }} {{$r->beneficiario->apellidos }}
                                    </td>
                                   
                                    <td>{{ $r->beneficiario->rut }}</td>
                                    <td>${{number_format($r->total,0,',','.')}}</td>
                                    <td>{{date_format($r->created_at, 'd-m-Y')}}</td>
                                    <td>
                                        
                                        <a href="{{route('acepta.rendicion',[$r->id])}}" class="btn btn-outline-success btn-sm m-1" title="Aceptar Transferencia"><i class="fa fa-check"></i></a>
                                        
                                        <a href="{{route('imprime.rendicion',[$r->id])}}" class="btn btn-outline-secondary btn-sm m-1" title="Imprimir Solicitud"><i class="fa fa-file-pdf-o"></i></a>
                                        @if(is_null($r->beneficiario->cuenta))
                                        <a class="btn btn-outline-warning btn-sm m-1" title="Agregar Cuenta" data-bs-toggle="modal" data-bs-target="#modalAumentar{{$key}}"><i class="fa fa-credit-card"></i></a>
                                             
                                        @endif
                                        <a href="{{route('eliminar.rendicion', [$r->id])}}" class="btn btn-outline-danger btn-sm m-1" title="Eliminar"><i class="icon-trash"></i></a>
                                                                                       
                                    </td>
                                </tr>


                                        <div class="modal fade" id="modalAumentar{{$key}}" tabindex="-1" role="dialog" aria-labelledby="modalAumentar{{$key}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Agregar Cuenta Bancaria</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                <form action="{{route('agregar.cuenta',[$r->beneficiario->id])}}"  method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                        
                                                        
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputbanco">Banco</label>
                                                                <select name="banco" class="form-control" id="inputbanco">
                                                                    <option value="012">BANCO DEL ESTADO DE CHILE</option>
                                                                    <option value="504">BANCO BBVA ( BILBAO VIZCAYA ARGENTARIA CHILE) / BANCO BHIF</option>
                                                                    <option value="028">BANCO BICE</option>
                                                                    <option value="055">BANCO CONSORCIO</option>
                                                                    <option value="027">BANCO CORPBANCA</option>
                                                                    <option value="001">BANCO DE CHILE / BANCO A. EDWARDS / CREDICHILE</option>
                                                                    <option value="016">BANCO DE CRÉDITO E INVERSIONES / TBANC</option>
                                                                    <option value="507">BANCO DEL DESARROLLO</option>
                                                                    <option value="051">BANCO FALABELLA</option>
                                                                    <option value="009">BANCO INTERNACIONAL</option>
                                                                    <option value="039">BANCO ITAU CHILE / BANK BOSTON</option>
                                                                    <option value="037">BANCO SANTANDER - SANTIAGO / BANCO SANTANDER / BANEFE</option>
                                                                    <option value="049">BANCO SECURITY</option>
                                                                    <option value="045">BANCO TOKIO</option>
                                                                    <option value="672">COOPEUCH</option>
                                                                    <option value="031">HSBC BANK (Chile)</option>
                                                                    <option value="014">SCOTIABANK / SUD - AMERICANO  </option>

                                                                </select>
                                                                
                                                            <div class="valid-feedback">¡Luce bien!</div>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputtipocuenta">Tipo Cuenta</label>
                                                                <select name="tipocuenta" class="form-control" id="inputtipocuenta">
                                                                    <option value="01">CTA. CORRIENTE / CTA. VISTA</option>
                                                                    <option value="02">CTA. AHORRO</option>
                                                                    <option value="30">CUENTA RUT</option>
                                                                </select>
                                                                
                                                            <div class="valid-feedback">¡Luce bien!</div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="inputcuenta">Nº Cuenta</label>
                                                                <input type="text" class="form-control" id="inputcuenta" name="cuenta">
                                                                
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
                               

                                
                                @endif
                                    
                                @endforeach
                                
                            </tbody>

                        </table>

                    </div> 
                   
                </div>
            </div>
        </div>



        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>A continuación se listarán todos las devoluciones Aceptadas</h5>
                    
                </div>
                <div class="card-body">
                    <div class="dt-ext table-responsive">
                        <a href="{{route('generar.decretoreembolsos')}}" class="btn btn-outline-success btn-sm m-1" title="Consolidad Reembolsos">Consolidar</a>
                        <table class="display datatables" id="aceptadas">

                            <thead>
                                <tr class="text-center">
                                    
                                    
                                    <th>Nombre</th>
                                    <th>Rut</th>
                                    <th>Monto</th>
                                    <th>Tipo de Cuenta</th>
                                    <th>Tipo de Prestación</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reembolso as $key => $r )

                                @if($r->entregado == 1)

                                <tr>
                                    <td>{{ $r->beneficiario->nombres }} {{$r->beneficiario->apellidos }}</td>
                                    <td>{{ $r->beneficiario->rut }}</td>                                    
                                    <td>$ {{$r->total}}</td>
                                    <td>@if($r->beneficiario->cuenta->banco == "012")BANCO DEL ESTADO DE CHILE 
                                        @elseif($r->beneficiario->cuenta->banco == "504")BANCO BBVA ( BILBAO VIZCAYA ARGENTARIA CHILE) / BANCO BHIF
                                        @elseif($r->beneficiario->cuenta->banco == "028")BANCO BICE
                                        @elseif($r->beneficiario->cuenta->banco == "055")BANCO CONSORCIO
                                        @elseif($r->beneficiario->cuenta->banco == "027")BANCO CORPBANCA
                                        @elseif($r->beneficiario->cuenta->banco == "001")BANCO DE CHILE / BANCO A. EDWARDS / CREDICHILE
                                        @elseif($r->beneficiario->cuenta->banco == "016")BANCO DE CRÉDITO E INVERSIONES / TBANC
                                        @elseif($r->beneficiario->cuenta->banco == "507")BANCO DEL DESARROLLO
                                        @elseif($r->beneficiario->cuenta->banco == "051")BANCO FALABELLA
                                        @elseif($r->beneficiario->cuenta->banco == "009")BANCO INTERNACIONAL
                                        @elseif($r->beneficiario->cuenta->banco == "039")BANCO ITAU CHILE / BANK BOSTON
                                        @elseif($r->beneficiario->cuenta->banco == "037")BANCO SANTANDER - SANTIAGO / BANCO SANTANDER / BANEFE
                                        @elseif($r->beneficiario->cuenta->banco == "049")BANCO SECURITY
                                        @elseif($r->beneficiario->cuenta->banco == "045")BANCO TOKIO
                                        @elseif($r->beneficiario->cuenta->banco == "672")COOPEUCH
                                        @elseif($r->beneficiario->cuenta->banco == "031")HSBC BANK (Chile)
                                        @elseif($r->beneficiario->cuenta->banco == "014")SCOTIABANK / SUD - AMERICANO
                                        @endif <br>
                                        @if($r->beneficiario->cuenta->tipocuenta == "01")CTA. CORRIENTE / CTA. VISTA
                                        @elseif($r->beneficiario->cuenta->tipocuenta == "02")CTA. AHORRO
                                        @elseif($r->beneficiario->cuenta->tipocuenta == "30")CUENTA RUT
                                        @endif
                                            
                                    <td>{{$r->tipoprestacion}}</td>
                                    
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
    
    <!-- <script src="{{asset('assets/js/touchspin/vendors.min.js')}}"></script>-->
    <script src="{{asset('assets/js/touchspin/touchspin.js')}}"></script>
    
    <script src="{{asset('assets/js/touchspin/input-groups.min.js')}}"></script>

    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>


    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>

    <script>
        $(document).ready(function(){

            $('#porhacer').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json',
                },
            });
        });
    </script>
    <script>
        $(document).ready(function(){

            $('#aceptadas').DataTable({
                language: {url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-CL.json'},
                dom: 'Bfrtip',
        	    buttons: [
            	
            	    'excelHtml5',
            	
        	    ]			
            });
        });
    </script>
    
   

@endsection

@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Listado Medidas</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Utils</li>
    <li class="breadcrumb-item active">Medidas</li>
   
@endsection

@section('content')
<div class="container-fluid">
    <div class="row starter-main">
       
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Listado medidas</h5>
                    
                </div>
                <div class="card-body">
                    <div class="dt-plugin-buttons"></div>
                        <div class="table-responsive">
                            <table class="display datatables" id="dt-plugin-method">

                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Abrv</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medidas as $m )
                                        <tr>
                                            <td>{{$m->nombreunidad}}</td>
                                            <td>{{$m->abrv}}</td>
                                            <td>acciones</td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>

                        </div>
                    
                   
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>How to use starter kit ?</h5>
                    
                </div>
                <div class="card-body">
                    <p><span class="f-w-600">HTML</span></p>
                    <p>If you know just HTML, select your choice of layout from starter kit folder, customize it with optional changes like colors and branding, add required dependency only.</p>
                    
                   
                </div>
            </div>
        </div>
        
        
        
    </div>
</div>


   
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>

@endsection

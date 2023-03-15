@extends('layouts.master')

@section('title', 'Default')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
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

<script type="text/javascript">
    var session_layout = '{{ session()->get('layout') }}';
</script>
   
@endsection

@section('script')
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">

@page {
    margin: 0px 0px 0px 0px !important;
    padding: 0px 0px 0px 0px !important;
}


.text-danger strong {
        	color: #f15a25;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #f15a25;
			margin-top: 20px;
			margin-bottom: 20px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
    </style>
<div class="receipt-main">
   <table class="col-12 receipt-header">
    <td><img src="{{asset('assets/images/logo_alis.png')}}" alt="Alis Logo" width="120px"></td>
    <td class="text-right">
        <div class="receipt-right">
            <h5>Alis SPA</h5>
            <p>77.198.271-9</p>
            <p>9 norte #555, local 208</p>
            <p>Viña del mar - Valparaiso</p>
            <p>+56 9 91831868</p>
            <p>info@alis.cl</p>		
        </div>                  
    </td>
   </table>


   <table class="col-12 receipt-header receipt-header-mid">
    <td>
        <div class="receipt-right text-left">
            <p><strong>Nombre : {{$cliente['nombre']}} </strong></p>
            <p><b>Rut :</b> {{$cliente['rut']}}</p>
            <p><b>Dirección :</b> {{$cliente['direccion']}}</p>
            <p><b>Teléfono :</b> {{$cliente['telefono']}}</p>
        </div>
</td>
    <td>
        <div class="receipt-right text-left">
            <p><b>Fecha :</b> {{now()->format('d-m-Y')}}</p>
            <p><b>Encargado :</b> {{$cliente['encargado']}}</p>
            <p><b>Dirección :</b> {{$cliente['direccion']}}</p>
            <p><b>Comuna :</b> {{$cliente['comuna']}}</p>
            <p><b>Ref:</b> {{$cliente['ref']}}</p>
        </div>
    </td>
    <td>
        <div class="receipt-right mt-3">
            <h4>Cotización N° {{$orden['id']}}</h4>
    
        </div>
    </td>
   </table>
   <table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Detalle</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($producto as $p)
            <tr>
                <td>{{$p['codigo']}}</td>
                <td>{{$p['nombre']}}</td>
                <td>{{$p['cantidad']}}</td>
                <td>$ {{number_format($p['valor'], 0, ',', '.')}}</td>
                <td>$ {{number_format($p['total'], 0, ',', '.')}}</td>
            </tr>
        @endforeach
        
       
        <tr>
            <td colspan="4" class="text-right">
            <p>
                <strong>Subtotal : </strong>
            </p>
            <p>
                <strong>Descuento 20% : </strong>
            </p>
            <p>
                <strong>Neto : </strong>
            </p>

            <p>
                <strong>IVA (19%) : </strong>
            </p>
            
            
            </td>
            <td>
            <p>
                <strong>$ {{number_format($orden['subtotal'], 0, ',', '.')}}</strong>
            </p>
            <p>
                <strong>$ {{ number_format($orden['subtotal'] * 0.20, 0,',','.')}}</strong>
            </p>
            <p>
                <strong>$ {{ number_format($orden['descuento'], 0,',','.')}}</strong>
            </p>
            <p>
                <strong>$ {{ number_format($orden['descuento'] * 0.19, 0,',','.')}}</strong>
            </p>
            
            
            </td>
        </tr>
        <tr>
           
            <td  colspan="4" class="text-right"><h2><strong>Total: </strong></h2></td>
            <td class="text-left text-danger"><h2><strong>$ {{number_format($orden['descuento'] * 1.19, 0, ',', '.')}}</strong></h2></td>
        </tr>
    </tbody>
    <tfoot>
        <td colspan="5" class="text-danger">
            <p style="color:#f15a25;"></p>
        </td>
    </tfoot>
</table>
<table class="col-12 receipt-header receipt-header-mid receipt-footer mt-5">
    
    <td class="text-left">
        <div class="receipt-right">
           
            <p>Para entregar en: Textiles Zahr</p>
            <p>Dirección: </p>
            <p>Guía de Despacho:</p>
            <p>Factura</p>
            
        </div>
    </td>
    <td>
        <img src="{{asset('assets/images/firma.png')}}" alt="firma" width="120px">
        <p></p>
    </td>
    <td>
        <div class="receipt-left mt-5">
            <h1>www.Alis.cl</h1>
        </div>
    </div>
    </td>

</table>



</div>
        
    



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
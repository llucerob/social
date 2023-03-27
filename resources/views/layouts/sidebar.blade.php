<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
      <div class="logo-wrapper"><a href="#"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/logom.png') }}" alt=""><img class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>           
            <li class="sidebar-list pt-4 mt-2"><a class="sidebar-link sidebar-title mt-3" href="{{route('dashboard')}}" target="_blank">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                </svg><span>Escritorio</span></a></li>

                <li class="pin-title sidebar-main-title">
                  <div> 
                    <h6>Social</h6>
                  </div>
                </li>

            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-user') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#fill-user') }}"></use>
                </svg><span>Beneficiarios</span></a>
                <ul class="sidebar-submenu" style="display: block;">
                <li><a href="{{url('beneficiarios/listar')}}">Listar Beneficiario</a>
                </li>
                <li><a href="{{url('beneficiarios/nuevo')}}">Nuevo Beneficiario</a>
                </li></ul>
              </li>
            
              
            <li class="pin-title sidebar-main-title">
                  <div> 
                    <h6>Reembolsos</h6>
                  </div>
                </li>

            
            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{route('listar.devoluciones')}}">
                  <svg class="stroke-icon">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-charts') }}"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-charts') }}"></use>
                  </svg><span>Boletas</span></a></li>


            <li class="pin-title sidebar-main-title">
                  <div> 
                    <h6>Bodega</h6>
                  </div>
                </li>

            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                <svg class="stroke-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bonus-kit') }}"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bonus-kit') }}"></use>
                </svg><span>Materiales</span></a>
              <ul class="sidebar-submenu">
                <li><a href="{{route('materiales.index')}}">Listar Material</a></li>
                <li><a href="{{route('materiales.create')}}">Nuevo Material</a></li>
              </ul>
              </li>

              <li class="pin-title sidebar-main-title">
                <div> 
                  <h6>Utilidades</h6>
                </div>
              </li>

            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="#">
                  <svg class="stroke-icon">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-to-do') }}"></use>
                  </svg>
                  <svg class="fill-icon">
                    <use href="{{ asset('assets/svg/icon-sprite.svg#fill-to-do') }}"></use>
                  </svg><span>Más</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{route('medidas')}}">Medidas</a></li>
                    <li><a href="{{route('categorias')}}">Categorias</a></li>
                    <li><a href="{{route('sectores')}}">Sectores</a></li>
                  </ul>
              </li>

            
            
             




          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
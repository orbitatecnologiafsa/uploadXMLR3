<div class="min-height-300 bg-primary position-absolute w-100" ></div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main" style="height: auto;">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{route('adm-busca-cliente-lista')}}">
      <img src="{{ asset('img/orbita-icon.png')}}" class="navbar-brand-img h-100" alt="main_logo">
      <span class="ms-1 font-weight-bold">Orbita Tecnologia</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">

  <div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class=" nav-link @yield('ativo-busca-cliente')" href="{{route('adm-busca-cliente-lista')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-chart-bar-32 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Buscar cliente</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link @yield('ativo-lista')" href="">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Lista clientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @yield('ativo-lista-loja')" href="">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Lista Lojas</span>
        </a>
      </li> --}}

      <li class="nav-item">
        <a class="nav-link @yield('ativo-sair')"  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" style="cursor: pointer;">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-button-power text-info text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Sair</span>
        </a>
        <form id="frm-logout" action="{{ route('adm-logout') }}" method="post" style="display: none;">
          @csrf
      </form>
      </li>
    </ul>
  </div>
</aside>

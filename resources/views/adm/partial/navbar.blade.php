<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
    data-scroll="false">
    <div class="container container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                        href="javascript:;">@yield('caminho')</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('atual-page')</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">@yield('atual-page')</h6><br>

        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                {{--
          se remover aparece mt grudado
          <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Type here...">
          </div> --}}
            </div>

            {{-- <ul class="navbar-nav  justify-content-end">
        <li class="nav-item pe-2 d-flex d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none">Meu perfil</span>
          </a>
        </li>

        <ul class="navbar-nav  justify-content-center" style="pointer-events: all">
          <li class="nav-item pe-2 d-flex d-flex align-items-center">
            <a  onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="nav-link text-white font-weight-bold px-0">
              <i class="ni ni-button-power me-sm-1"></i>
              <span class="d-sm-inline d-none">Sair</span>
            </a>
            <form id="frm-logout" action="{{ route('logout') }}" method="post" style="display: none;">
              @csrf
          </form>
          </li>
       --}}

            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <div href="javascript:;" style="cursor: default;" class="nav-link text-white p-0"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Usuario : <span>{{ auth('admin')->user()->nome }} </span>

                    </span>
                </div>
            </li>

            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <div href="javascript:;" style="cursor: default;" class="nav-link text-white p-0"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Nivel : <span>Adm -orbita</span>
                </div>
            </li>



            <li class="nav-item d-xl-none pe-2 d-flex ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                        <i class="sidenav-toggler-line bg-white"></i>
                    </div>
                </a>
            </li>

            </ul>
        </div>
    </div>
</nav>

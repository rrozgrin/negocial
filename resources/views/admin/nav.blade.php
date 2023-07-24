    <nav class="navbar fixed-top navbar-expand navbar-light" style="background-color: #F9DD16;">
        <div class="row align-items-center">
        
            <div class="mr-3 ml-5 pt-1">
                <div class="col-12">
                    <p class="text-center  g-0 m-0 p-0" style="color: #0038A8; line-height:5px; font-weight: bold" href="#">NEGOCIAL</p>
                </div>
                <div class="col-12">
                    <p class="text-center  g-0 m-0 p-0" style="color: #0038A8;" href="#"><small>LPBK - Advogados Associados</small></p>
                </div>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ml-5" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('relatorios/def') ? 'active' :'' }}" href="{{route('rel.def')}}">Defasagem<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('relatorios/mov') ? 'active' :'' }}" href="{{route('rel.mov')}}">Movimentações<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('relatorios/lig') ? 'active' :'' }}" href="{{route('rel.lig')}}">Ligações<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/admin') ? 'active' :'' }}" href="{{route('admin.admin')}}">Admin</a>
                </li>
                
            </ul>

        </div>
        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" onclick="document.querySelector('form.logout').submit();">Sair</a>
                    <form action="{{route('logout')}}" class="logout" method="POST" style="display: none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

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
                    <a class="nav-link" href="{{route('rel.def')}}">Defasagem<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('rel.mov')}}">Movimentações<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('rel.lig')}}">Ligações<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.users.index')}}">Admin</a>
                </li>

            </ul>
        </div>
    </nav>

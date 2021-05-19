<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom fixed-top">
    <div>
        <a class="navbar-brand">
            <button class="btn mr-3" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <span class="sidebar-heading"><b>GE-PREST</b></span>
        </a>
    </div>



    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPorfileContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-sliders-h pt-1 pb-1"></i>
        <!-- <i class="fas fa-user-cog pt-1 pb-1"></i> -->
    </button>

    <div class="collapse navbar-collapse text-center" id="navbarPorfileContent">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <!-- <li class="nav-item">
                <a href="../<?= BASE ?>">
                    <button type="button" class="btn btn-theme-2-plane p-2 mr-sm-3">
                        <span><b>IR A LOGIN</b></span>
                    </button>
                </a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="PorfileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mi cuenta
                </a>
                <div class="dropdown-menu dropdown-menu-porfile dropdown-menu-right p-0" aria-labelledby="PorfileDropdown">
                    <a class="dropdown-item pt-1 pb-1" href="#">Perfil</a>
                    <!-- <a class="dropdown-item" href="#">Another action</a> -->
                    <!-- <div class="dropdown-divider m-0"></div> -->
                    <a id="user-opc-logout" class="dropdown-item pt-1 pb-1">Cerrar Sesion</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div id="div-modals">
</div>
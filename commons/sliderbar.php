<style>
    .menu-item {
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }

    .menu-item:hover {
        color: var(--themecolor);
        fill: var(--themecolor);
        cursor: pointer;
    }

    .menu-item-title {
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        font-weight: 500;
        font-size: 15px;
        padding: .75rem 1.25rem;
        padding-left: 1.30rem;
    }

    .list-group-item-action {
        color: #585959;
    }

    .list-group-item-action:hover,
    .list-group-item-action:active {
        background-color: #f5f6f7;
    }

    .menu-item-title-name {
        width: calc(100% - 25px);
    }

    .menu-item-title-icon {
        width: 25px;
        text-align: center;
    }

    .icon-slidebar {
        color: #979899;
    }

    .menu-item-collapse {
        padding-left: 5%;
        /* border-top: 1px solid #0000000d; */
    }

    .menu-item-collapse .list-group-item {
        padding: .5rem 1.25rem;
        border: none;
        /* border-bottom: 1px solid rgba(0,0,0,.125); */
        border-left: 3px solid #f2f4f5;
        border-left: 3px solid var(--themecolor) !important;
    }

    .menu-item-title .menu-item-title-icon svg {
        transform: rotate(-90deg);
        transition: all .2s ease;
    }

    .menu-item-title[aria-expanded="true"] .menu-item-title-icon svg {
        transform: rotate(0deg);
    }

    .menu-item-title[aria-expanded="false"] .menu-item-title-icon svg {
        transform: rotate(-90deg);
    }

    .menu-item-title[aria-expanded="true"] {
        color: var(--themecolor);
        fill: var(--themecolor);
    }

    /*.list-group-item-active {
        color: var(--themecolorsecondarytrans)!important;
        border-left: 3px solid var(--themecolorsecondarytrans)!important;
    }*/
</style>


<div class="border-right" id="sidebar-wrapper">
    <div class="list-group list-group-flush bg-white">
        
        <div class="menu-item">
            <div class="menu-item-title" data-toggle="collapse" data-target="#secAdministracion">
                <div class="menu-item-title-name">Administracion</div>
                <div class="menu-item-title-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path class="fill-black-20" d="M7.41 7.84l4.59 4.58 4.59-4.58 1.41 1.41-6 6-6-6z"></path>
                        <path d="M0-.75h24v24h-24z" fill="none"></path>
                    </svg>
                </div>
            </div>
            <div class="menu-item-collapse collapse" id="secAdministracion">
                <a href="<?= BASE ?>views/adm_area.php" class="list-group-item list-group-item-action list-group-item-active" role="button" id="">
                    <i class="fas fa-address-book icon-slidebar"></i><span>Areá</span>
                </a>
                <a href="<?= BASE ?>views/adm_usuario.php" class="list-group-item list-group-item-action" role="button" id="">
                    <i class="far fa-user icon-slidebar"></i><span>Usuarios</span>
                </a>
            </div>
        </div>


        <div class="menu-item">
            <div class="menu-item-title" data-toggle="collapse" data-target="#secPresupuesto">
                <div class="menu-item-title-name">Presupuestos</div>
                <div class="menu-item-title-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path class="fill-black-20" d="M7.41 7.84l4.59 4.58 4.59-4.58 1.41 1.41-6 6-6-6z"></path>
                        <path d="M0-.75h24v24h-24z" fill="none"></path>
                    </svg>
                </div>
            </div>
            <div class="menu-item-collapse collapse" id="secPresupuesto">
                <a href="<?= BASE ?>views/adm_presupuesto.php" class="list-group-item list-group-item-action list-group-item-active" role="button" id="">
                    <i class="fas fa-money-check icon-slidebar"></i><span>Registro de Presupuestos</span>
                    
                </a>
                <a href="<?= BASE ?>views/adm_presupuesto_asig.php" class="list-group-item list-group-item-action" role="button" id="">
                    <i class="fas fa-wallet icon-slidebar"></i><span>Asignar presupuesto</span>
                </a>
            </div>
        </div>
        
        <div class="menu-item">
            <div class="menu-item-title" data-toggle="collapse" data-target="#secGasto">
                <div class="menu-item-title-name">Gastos</div>
                <div class="menu-item-title-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path class="fill-black-20" d="M7.41 7.84l4.59 4.58 4.59-4.58 1.41 1.41-6 6-6-6z"></path>
                        <path d="M0-.75h24v24h-24z" fill="none"></path>
                    </svg>
                </div>
            </div>
            <div class="menu-item-collapse collapse" id="secGasto">
                <a href="<?= BASE ?>views/adm_gasto.php" class="list-group-item list-group-item-action list-group-item-active" role="button" id="">
                    <i class="fas fa-money-check-alt icon-slidebar"></i><span>Registro de Gastos</span>
                </a>
                <a href="<?= BASE ?>views/adm_gasto_bus.php" class="list-group-item list-group-item-action" role="button" id="">
                    <i class="fas fa-funnel-dollar icon-slidebar"></i><span>Busqueda de Gastos</span>
                </a>
            </div>
        </div>
    </div>
</div>
<style>
    .list-group-item:hover>.icon-slidebar::before {
        display: inline-block !important;
        animation: swing ease-in-out 0.5s 1 alternate !important;
    }

    @-webkit-keyframes swing {
        20% {
            -webkit-transform: rotate3d(0, 0, 1, 15deg);
            transform: rotate3d(0, 0, 1, 15deg)
        }

        40% {
            -webkit-transform: rotate3d(0, 0, 1, -10deg);
            transform: rotate3d(0, 0, 1, -10deg)
        }

        60% {
            -webkit-transform: rotate3d(0, 0, 1, 5deg);
            transform: rotate3d(0, 0, 1, 5deg)
        }

        80% {
            -webkit-transform: rotate3d(0, 0, 1, -5deg);
            transform: rotate3d(0, 0, 1, -5deg)
        }

        to {
            -webkit-transform: rotate3d(0, 0, 1, 0deg);
            transform: rotate3d(0, 0, 1, 0deg)
        }
    }

    @keyframes swing {
        20% {
            -webkit-transform: rotate3d(0, 0, 1, 15deg);
            transform: rotate3d(0, 0, 1, 15deg)
        }

        40% {
            -webkit-transform: rotate3d(0, 0, 1, -10deg);
            transform: rotate3d(0, 0, 1, -10deg)
        }

        60% {
            -webkit-transform: rotate3d(0, 0, 1, 5deg);
            transform: rotate3d(0, 0, 1, 5deg)
        }

        80% {
            -webkit-transform: rotate3d(0, 0, 1, -5deg);
            transform: rotate3d(0, 0, 1, -5deg)
        }

        to {
            -webkit-transform: rotate3d(0, 0, 1, 0deg);
            transform: rotate3d(0, 0, 1, 0deg)
        }
    }

    .swing {
        -webkit-transform-origin: top center;
        transform-origin: top center;
        -webkit-animation-name: swing;
        animation-name: swing
    }
</style>
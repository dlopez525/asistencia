<div class="az-sidebar">
    <div class="az-sidebar-header">
        <a href="index.html" class="az-logo">ama<span>de</span>us</a>
    </div>
    <div class="az-sidebar-loggedin">
        <div class="az-img-user online"><img src="../img/img1.jpg" alt=""></div>
        <div class="media-body">
            <h6>{{ Auth::user()->name }} {{ Auth::user()->lastname }} <small><i>{{ Auth::user()->username }}</i></small></h6>
            <span>{{ Auth::user()->role->role }}</span>
        </div>
    </div>
    <div class="az-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link"><i class="typcn typcn-clipboard"></i>Panel</a></li>
            <li class="nav-item">
                <a href="#" class="nav-link with-sub"><i class="typcn typcn-cog-outline"></i> Horarios</a>
                <ul class="nav-sub">
                    <li class="nav-sub-item"><a href="{{ route('shedules.index') }}" class="nav-sub-link"> Horarios</a></li>
                    <li class="nav-sub-item"><a href="{{ route('asistence.index') }}" class="nav-sub-link"> Asistencia</a></li>
                </ul>
            </li>
            @if (auth()->user()->role_id == 1)
                <li class="nav-item">
                    <a href="#" class="nav-link with-sub"><i class="typcn typcn-cog-outline"></i> Configuración</a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item"><a href="{{ route('users.index') }}" class="nav-sub-link">Usuarios</a></li>
                        <li class="nav-sub-item"><a href="{{ route('roles.index') }}" class="nav-sub-link">Roles</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
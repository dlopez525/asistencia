<div class="az-header">
    <div class="container-fluid">
        <div class="az-header-left">
            <a href="#" id="azSidebarToggle" class="az-header-menu-icon"><span></span></a>
        </div>
        <div class="az-header-center">

        </div>
        <div class="az-header-right">
            <div class="dropdown az-profile-menu">
                <a href="#" class="az-img-user"><img src="../img/img1.jpg" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="#" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img src="../img/img1.jpg" alt="">
                        </div><!-- az-img-user -->
                        <h6>{{ Auth::user()->name }}</h6>
                    </div><!-- az-header-profile -->
                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Salir</a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div><!-- az-header -->
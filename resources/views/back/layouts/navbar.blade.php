<!-- Start header area -->
<header class="header__section">
    <div class="main__header d-flex justify-content-between align-items-center">
        <div class="header__left d-flex align-items-center">
            <a class="collaps__menu" href="javascript:void(0)">
                <svg width="26" height="20" viewBox="0 0 26 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 16.5999L7.0667 11.1666C6.42503 10.5249 6.42503 9.4749 7.0667 8.83324L12.5 3.3999"
                          stroke="currentColor" stroke-width="1.3" stroke-miterlimit="10" stroke-linecap="round"
                          stroke-linejoin="round"/>
                    <path d="M18.5 16.5999L13.0667 11.1666C12.425 10.5249 12.425 9.4749 13.0667 8.83324L18.5 3.3999"
                          stroke="currentColor" stroke-width="1.3" stroke-miterlimit="10" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </a>
            <div class="offcanvas__header--menu__open ">
                <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg"
                         viewBox="0 0 512 512">
                        <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                              stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/>
                    </svg>
                    <span class="visually-hidden">Offcanvas Menu Open</span>
                </a>
            </div>
            <div class="main__logo logo-desktop-block">
                <a class="main__logo--link" href="./dashboard.html">
                    <img class="main__logo--img desktop light__logo" src="{{ asset('back/assets/img/logo/nav-log.png')}}"
                         alt="logo-img">
                    <img class="main__logo--img desktop dark__logo"
                         src="{{ asset('back/assets/img/logo/nav-log-white.png')}}" alt="logo-img">
                    <img class="main__logo--img mobile" src="{{ asset('back/assets/img/logo/logo-mobile.png')}}"
                         alt="logo-img">
                </a>
            </div>
        </div>
        <div class="header__right d-flex align-items-center">
            <div class="header__nav-bar__wrapper d-flex align-items-center">
                @include('back.partials.user-profile-menu')
            </div>
        </div>
    </div>
</header>
<!-- End header area -->

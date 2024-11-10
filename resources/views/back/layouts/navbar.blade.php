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
                    <img class="main__logo--img desktop light__logo"
                         src="{{ asset('back/assets/img/logo/nav-log.png')}}"
                         alt="logo-img">
                    <img class="main__logo--img desktop dark__logo"
                         src="{{ asset('back/assets/img/logo/nav-log-white.png')}}" alt="logo-img">
                    <img class="main__logo--img mobile" src="{{ asset('back/assets/img/logo/logo-mobile.png')}}"
                         alt="logo-img">
                </a>
            </div>
        </div>
        <div class="header__right">
            <div class="header__nav-bar__wrapper d-flex align-items-center">
                <ul class="nav-bar__menu d-flex">
                    <li class="nav-bar__menu--items position-relative">
                        <a class="nav-bar__menu--icon" href="#" id="light__to--dark">
                            <svg class="light--mode__icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.99992 15.4166C12.9915 15.4166 15.4166 12.9915 15.4166 9.99992C15.4166 7.00838 12.9915 4.58325 9.99992 4.58325C7.00838 4.58325 4.58325 7.00838 4.58325 9.99992C4.58325 12.9915 7.00838 15.4166 9.99992 15.4166Z"
                                    stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                                <path
                                    d="M15.9501 15.9501L15.8417 15.8417M15.8417 4.15841L15.9501 4.05008L15.8417 4.15841ZM4.05008 15.9501L4.15841 15.8417L4.05008 15.9501ZM10.0001 1.73341V1.66675V1.73341ZM10.0001 18.3334V18.2667V18.3334ZM1.73341 10.0001H1.66675H1.73341ZM18.3334 10.0001H18.2667H18.3334ZM4.15841 4.15841L4.05008 4.05008L4.15841 4.15841Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"/>
                            </svg>
                            <svg class="dark--mode__icon" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                 width="20" height="20" viewBox="0 0 512 512"><title>Moon</title>
                                <path
                                    d="M264 480A232 232 0 0132 248c0-94 54-178.28 137.61-214.67a16 16 0 0121.06 21.06C181.07 76.43 176 104.66 176 136c0 110.28 89.72 200 200 200 31.34 0 59.57-5.07 81.61-14.67a16 16 0 0121.06 21.06C442.28 426 358 480 264 480z"></path>
                            </svg>
                            <span class="visually-hidden">Dark Light</span>
                        </a>
                    </li>
                </ul>
                <div class="header__nav-bar__wrapper d-flex align-items-center">
                    @include('back.partials.user-profile-menu')
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End header area -->

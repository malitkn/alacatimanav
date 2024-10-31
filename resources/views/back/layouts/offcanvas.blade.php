<!-- Start Offcanvas header menu -->
<div class="offcanvas__header">
    <div class="offcanvas__inner">
        <div class="offcanvas__logo">
            <a class="offcanvas__logo_link" href="{{ route('dashboard') }}">
                <img class="light__logo" src="{{ asset('back/assets/img/logo/nav-log.png') }}" alt="Logo-img" width="158" height="36">
                <img class="dark__logo" src="{{ asset('back/assets/img/logo/nav-log-white.png') }}" alt="Logo-img" width="158" height="36">
            </a>
            <button class="offcanvas__close--btn" data-offcanvas>close</button>
        </div>

        <nav class="offcanvas__menu">
            <ul class="offcanvas__menu_ul">
                <li class="offcanvas__menu_li">
                    <a class="offcanvas__menu_item" href="#">Site Ayarları</a>
                    <ul class="offcanvas__sub_menu">
                        <li class="offcanvas__sub_menu_li"><a href="{{ route('settings.index') }}" class="offcanvas__sub_menu_item">Genel Ayarlar</a></li>
                    </ul>
                </li>
                <li class="offcanvas__menu_li">
                    <a class="offcanvas__menu_item" href="{{ route('pages.categories.index') }}">Sayfalar</a>
                    <ul class="offcanvas__sub_menu">
                        <li class="offcanvas__sub_menu_li"><a href="{{ route('pages.categories.create') }}" class="offcanvas__sub_menu_item">Sayfa Oluştur</a></li>
                        <li class="offcanvas__sub_menu_li"><a href="{{ route('pages.categories.index') }}" class="offcanvas__sub_menu_item">Sayfalar</a></li>
                    </ul>
                </li>

                <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="./my-properties.html">Properties</a></li>
                <li class="offcanvas__menu_li">
                    <a class="offcanvas__menu_item" href="./dashboard.html">Dashboard</a>
                    <ul class="offcanvas__sub_menu">
                        <li class="offcanvas__sub_menu_li"><a href="./dashboard.html" class="offcanvas__sub_menu_item">Dashboard</a></li>
                    </ul>
                </li>
                <li class="offcanvas__menu_li"><a class="offcanvas__menu_item" href="../blog.html">News</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- End Offcanvas header menu -->

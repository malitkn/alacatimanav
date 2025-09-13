<!-- Dashboard sidebar -->
<div class="dashboard__sidebar">
    <div class="main__logo logo-desktop-none">
        <h1 class="main__logo--title"><a class="main__logo--link" href="{{ route('dashboard') }}">
                <img class="main__logo--img desktop light__logo" src="{{ asset('back/assets/img/logo/nav-log.png')}}"
                     alt="logo-img">
                <img class="main__logo--img desktop dark__logo" src="{{ asset('storage/images/header-logo.png')}}" alt="logo-img">
                <img class="main__logo--img mobile" src="{{ asset('back/assets/img/logo/logo-mobile.png')}}"
                     alt="logo-img">
            </a></h1>
    </div>
    <div class="dashboard__sidebar--inner">
        <ul class="sidebar__menu" id="accordionExample">
            <li class="sidebar__menu--items"><a class="sidebar__menu--link active" href="{{ route('dashboard') }}">
                    <svg class="sidebar__menu--icon" width="16" height="16" viewBox="0 0 16 16" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.300049 1.40005C0.300049 1.10831 0.415941 0.828521 0.622231 0.622231C0.828521 0.415941 1.10831 0.300049 1.40005 0.300049H14.6C14.8918 0.300049 15.1716 0.415941 15.3779 0.622231C15.5842 0.828521 15.7 1.10831 15.7 1.40005V3.60005C15.7 3.89179 15.5842 4.17158 15.3779 4.37787C15.1716 4.58416 14.8918 4.70005 14.6 4.70005H1.40005C1.10831 4.70005 0.828521 4.58416 0.622231 4.37787C0.415941 4.17158 0.300049 3.89179 0.300049 3.60005V1.40005ZM0.300049 8.00005C0.300049 7.70831 0.415941 7.42852 0.622231 7.22223C0.828521 7.01594 1.10831 6.90005 1.40005 6.90005H8.00005C8.29179 6.90005 8.57158 7.01594 8.77787 7.22223C8.98416 7.42852 9.10005 7.70831 9.10005 8.00005V14.6C9.10005 14.8918 8.98416 15.1716 8.77787 15.3779C8.57158 15.5842 8.29179 15.7 8.00005 15.7H1.40005C1.10831 15.7 0.828521 15.5842 0.622231 15.3779C0.415941 15.1716 0.300049 14.8918 0.300049 14.6V8.00005ZM12.4 6.90005C12.1083 6.90005 11.8285 7.01594 11.6222 7.22223C11.4159 7.42852 11.3 7.70831 11.3 8.00005V14.6C11.3 14.8918 11.4159 15.1716 11.6222 15.3779C11.8285 15.5842 12.1083 15.7 12.4 15.7H14.6C14.8918 15.7 15.1716 15.5842 15.3779 15.3779C15.5842 15.1716 15.7 14.8918 15.7 14.6V8.00005C15.7 7.70831 15.5842 7.42852 15.3779 7.22223C15.1716 7.01594 14.8918 6.90005 14.6 6.90005H12.4Z"
                            fill="currentColor"/>
                    </svg>
                    <span class="sidebar__menu--text"> Ana sayfa </span>
                </a>
            </li>
            <li class="sidebar__menu--items"><a class="sidebar__menu--link" href="./create-listing.html">
                    <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.99996 18.3334C14.5833 18.3334 18.3333 14.5834 18.3333 10.0001C18.3333 5.41675 14.5833 1.66675 9.99996 1.66675C5.41663 1.66675 1.66663 5.41675 1.66663 10.0001C1.66663 14.5834 5.41663 18.3334 9.99996 18.3334Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.66663 10H13.3333" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M10 13.3334V6.66675" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <span class="sidebar__menu--text"> Create Listing</span>
                </a>
            </li>
            <li class="sidebar__menu--items"><a class="sidebar__menu--link" href="./chat.html">
                    <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.1666 7.50008C14.1666 10.7251 11.3666 13.3334 7.91663 13.3334L7.14163 14.2667L6.6833 14.8168C6.29163 15.2834 5.54162 15.1834 5.28329 14.6251L4.16663 12.1667C2.64996 11.1001 1.66663 9.40842 1.66663 7.50008C1.66663 4.27508 4.46663 1.66675 7.91663 1.66675C10.4333 1.66675 12.6083 3.05842 13.5833 5.05842C13.9583 5.80009 14.1666 6.62508 14.1666 7.50008Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path
                            d="M18.3334 10.7167C18.3334 12.625 17.3501 14.3167 15.8334 15.3834L14.7167 17.8417C14.4584 18.4 13.7084 18.5084 13.3167 18.0334L12.0834 16.55C10.0667 16.55 8.26672 15.6583 7.14172 14.2667L7.91672 13.3333C11.3667 13.3333 14.1667 10.725 14.1667 7.50001C14.1667 6.62501 13.9584 5.80002 13.5834 5.05835C16.3084 5.68335 18.3334 7.98333 18.3334 10.7167Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M5.83337 7.5H10" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <span class="sidebar__menu--text"> Message</span>
                </a>
            </li>
            <li class="sidebar__menu--items">
                <label class="sidebar__menu--title">Mağaza Yönetimi</label>
            </li>
            <li class="sidebar__menu--items dropdown__items">
                <a class="sidebar__menu--link dropdown__link--active collapsed" href="#" data-bs-toggle="collapse"
                   data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="sidebar__menu--icon" viewBox="0 0 512 512">
                        <path
                            d="M368 415.86V72a24.07 24.07 0 00-24-24H72a24.07 24.07 0 00-24 24v352a40.12 40.12 0 0040 40h328"
                            fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        <path d="M416 464h0a48 48 0 01-48-48V128h72a24 24 0 0124 24v264a48 48 0 01-48 48z" fill="none"
                              stroke="currentColor" stroke-linejoin="round" stroke-width="32"/>
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="32" d="M240 128h64M240 192h64M112 256h192M112 320h192M112 384h192"/>
                        <path
                            d="M176 208h-64a16 16 0 01-16-16v-64a16 16 0 0116-16h64a16 16 0 0116 16v64a16 16 0 01-16 16z"/>
                    </svg>
                    <span class="sidebar__menu--text">Ürünler</span>
                    <svg class="sidebar__menu--link__arrow" width="12" height="8" viewBox="0 0 12 8" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.99999 3.02344L1.87499 7.14844L0.696655 5.9701L5.99999 0.666771L11.3033 5.9701L10.125 7.14844L5.99999 3.02344Z"
                            fill="currentColor"/>
                    </svg>
                </a>
                <ul class="sidebar__dropdown--menu accordion-collapse collapse" id="collapseOne">
                    <li class="sidebar__dropdown--menu__items"><a class="sidebar__dropdown--menu__link"
                                                                  href="{{ route('products.update') }}">Fiyat Güncelle</a></li>
                    <li class="sidebar__dropdown--menu__items"><a class="sidebar__dropdown--menu__link"
                                                                  href="{{ route('products.settings') }}">Komisyon Ayarları</a></li>
					 <li class="sidebar__dropdown--menu__items"><a class="sidebar__dropdown--menu__link"
                                                                  href="{{ route('products.update.status') }}">Ürün Aç / Kapat</a></li>
                </ul>
            </li>
            <li class="sidebar__menu--items"><a class="sidebar__menu--link" href="./my-favorites.html">
                    <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.3334 14.3332C18.3334 15.0832 18.125 15.7916 17.75 16.3916C17.0584 17.5499 15.7917 18.3332 14.3334 18.3332C12.875 18.3332 11.6 17.5499 10.9167 16.3916C10.55 15.7916 10.3334 15.0832 10.3334 14.3332C10.3334 12.1249 12.125 10.3333 14.3334 10.3333C16.5417 10.3333 18.3334 12.1249 18.3334 14.3332Z"
                            stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M12.775 14.3332L13.7584 15.3165L15.8917 13.3499" stroke="currentColor"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path
                            d="M18.3333 7.24161C18.3333 8.88327 17.9083 10.3332 17.2416 11.5916C16.5083 10.8166 15.475 10.3333 14.3333 10.3333C12.125 10.3333 10.3333 12.1249 10.3333 14.3333C10.3333 15.3583 10.725 16.2916 11.3583 17C11.05 17.1416 10.7666 17.2583 10.5166 17.3416C10.2333 17.4416 9.76663 17.4416 9.48329 17.3416C7.06663 16.5166 1.66663 13.0749 1.66663 7.24161C1.66663 4.66661 3.74163 2.58325 6.29996 2.58325C7.80829 2.58325 9.15829 3.31662 9.99996 4.44162C10.8416 3.31662 12.1916 2.58325 13.7 2.58325C16.2583 2.58325 18.3333 4.66661 18.3333 7.24161Z"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="sidebar__menu--text">My Favorites</span>
                </a></li>
            <li class="sidebar__menu--items"><a class="sidebar__menu--link" href="./saved-search.html">
                    <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.6666 4.16675H16.6666" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M11.6666 6.66675H14.1666" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path
                            d="M17.5 9.58341C17.5 13.9584 13.9583 17.5001 9.58329 17.5001C5.20829 17.5001 1.66663 13.9584 1.66663 9.58341C1.66663 5.20841 5.20829 1.66675 9.58329 1.66675"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M18.3333 18.3334L16.6666 16.6667" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <span class="sidebar__menu--text">Saved Search</span>
                </a></li>
            <li class="sidebar__menu--items dropdown__items">
                <a class="sidebar__menu--link dropdown__link--active" href="#" data-bs-toggle="collapse"
                   data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                    <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.1666 15.3583H10.8333L7.12495 17.8249C6.57495 18.1916 5.83329 17.8 5.83329 17.1333V15.3583C3.33329 15.3583 1.66663 13.6916 1.66663 11.1916V6.19157C1.66663 3.69157 3.33329 2.0249 5.83329 2.0249H14.1666C16.6666 2.0249 18.3333 3.69157 18.3333 6.19157V11.1916C18.3333 13.6916 16.6666 15.3583 14.1666 15.3583Z"
                            stroke="currentColor" stroke-miterlimit="10" stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path
                            d="M10 9.46655V9.29159C10 8.72492 10.35 8.4249 10.7 8.18324C11.0417 7.9499 11.3833 7.64991 11.3833 7.09991C11.3833 6.33325 10.7667 5.71655 10 5.71655C9.23334 5.71655 8.6167 6.33325 8.6167 7.09991"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M9.99629 11.4584H10.0038" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                    <span class="sidebar__menu--text">Reviews</span>
                    <svg class="sidebar__menu--link__arrow" width="12" height="8" viewBox="0 0 12 8" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.99999 3.02344L1.87499 7.14844L0.696655 5.9701L5.99999 0.666771L11.3033 5.9701L10.125 7.14844L5.99999 3.02344Z"
                            fill="currentColor"/>
                    </svg>
                </a>
                <ul class="sidebar__dropdown--menu accordion-collapse collapse show" id="collapsetwo">
                    <li class="sidebar__dropdown--menu__items"><a class="sidebar__dropdown--menu__link"
                                                                  href="./reviews.html">General Elements</a></li>
                    <li class="sidebar__dropdown--menu__items"><a class="sidebar__dropdown--menu__link"
                                                                  href="./reviews.html">Advanced Elements</a></li>
                </ul>
            </li>
            <li class="sidebar__menu--items">
                <label class="sidebar__menu--title">Ayarlar</label>
            </li>
            <!-- <li class="sidebar__menu--items"><a class="sidebar__menu--link" href="./my-package.html">
                     <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                         <path d="M2.64172 6.19995L10.0001 10.4583L17.3084 6.22495" stroke="currentColor"
                               stroke-linecap="round" stroke-linejoin="round"/>
                         <path d="M10 18.0083V10.45" stroke="currentColor" stroke-linecap="round"
                               stroke-linejoin="round"/>
                         <path
                             d="M8.27503 2.06658L3.82503 4.53324C2.8167 5.09157 1.9917 6.49157 1.9917 7.64157V12.3499C1.9917 13.4999 2.8167 14.8999 3.82503 15.4582L8.27503 17.9332C9.22503 18.4582 10.7834 18.4582 11.7334 17.9332L16.1834 15.4582C17.1917 14.8999 18.0167 13.4999 18.0167 12.3499V7.64157C18.0167 6.49157 17.1917 5.09157 16.1834 4.53324L11.7334 2.05824C10.775 1.53324 9.22503 1.53324 8.27503 2.06658Z"
                             stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                     </svg>
                     <span class="sidebar__menu--text">My Package</span>
                 </a>
             </li> -->
            <!--  <li class="sidebar__menu--items"><a class="sidebar__menu--link" href="./profile.html">
                      <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                           xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M10 10.0001C12.3012 10.0001 14.1667 8.1346 14.1667 5.83342C14.1667 3.53223 12.3012 1.66675 10 1.66675C7.69885 1.66675 5.83337 3.53223 5.83337 5.83342C5.83337 8.1346 7.69885 10.0001 10 10.0001Z"
                              stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                          <path
                              d="M17.1583 18.3333C17.1583 15.1083 13.95 12.5 10 12.5C6.05001 12.5 2.84167 15.1083 2.84167 18.3333"
                              stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span class="sidebar__menu--text"> My Profile</span>
                  </a>
              </li> -->
        {{--    <li class="sidebar__menu--items dropdown__items">
                <a class="sidebar__menu--link dropdown__link--active collapsed" href="#"
                   data-bs-toggle="collapse"
                   data-bs-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
                    <svg class="sidebar__menu--icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round">
                        <path
                            d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span class="sidebar__menu--text"> Site Ayarları</span>
                    <svg class="sidebar__menu--link__arrow" width="12" height="8" viewBox="0 0 12 8" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M5.99999 3.02344L1.87499 7.14844L0.696655 5.9701L5.99999 0.666771L11.3033 5.9701L10.125 7.14844L5.99999 3.02344Z"
                            fill="currentColor"/>
                    </svg>
                </a>
                <ul class="sidebar__dropdown--menu accordion-collapse collapse" id="collapseSettings">
                    <li class="sidebar__dropdown--menu__items">
                        <a class="sidebar__dropdown--menu__link" href="{{ route('settings.index') }}">Genel Ayarlar</a>
                    </li>
                </ul>
            </li>--}}
            <li class="sidebar__menu--items">
                <a class="sidebar__menu--link logout color-accent-2" href="{{ route('logout') }}">
                    <svg class="sidebar__menu--icon" width="20" height="20" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7.41663 6.29995C7.67496 3.29995 9.21663 2.07495 12.5916 2.07495H12.7C16.425 2.07495 17.9166 3.56662 17.9166 7.29162V12.725C17.9166 16.45 16.425 17.9416 12.7 17.9416H12.5916C9.24163 17.9416 7.69996 16.7333 7.42496 13.7833"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12.5001 10H3.01672" stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M4.87504 7.20825L2.08337 9.99992L4.87504 12.7916" stroke="currentColor"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="sidebar__menu--text"> Çıkış yap </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Dashboard sidebar .\ -->

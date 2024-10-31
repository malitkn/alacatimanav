<div class="header__user--profile">
    <a class="header__user--profile__link d-flex align-items-center" href="#">
        <img class="header__user--profile__thumbnail" src="{{ asset('back/assets/img/dashboard/nav-author-thumb.png')}}"
             alt="img">
        <span class="header__user--profile__name">{{ auth()->user()->name }}</span>
        <span class="header__user--profile__arrow"><svg width="12" height="8" viewBox="0 0 12 8"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.9994 4.97656L10.1244 0.851563L11.3027 2.0299L5.9994 7.33323L0.696067 2.0299L1.8744 0.851563L5.9994 4.97656Z"
                                            fill="currentColor" fill-opacity="0.5"/>
                                        </svg></span>
    </a>
    <div class="dropdown__user--profile">
        <ul class="user__profile--menu">
            <li class="user__profile--menu__items">
                <a class="user__profile--menu__link" href="./profile.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" data-lucide="user-2"
                         class="lucide lucide-user-2 inline-block size-4 ltr:mr-2 rtl:ml-2">
                        <circle cx="12" cy="8" r="5"></circle>
                        <path d="M20 21a8 8 0 0 0-16 0"></path>
                    </svg>
                    My Profile
                </a>
            </li>

            <li class="user__profile--menu__items"><a
                    class="user__profile--menu__link position-relative" href="./chat.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" data-lucide="mail"
                         class="lucide lucide-mail inline-block size-4 ltr:mr-2 rtl:ml-2">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    Inbox <span class="profile__messages--count">12</span> </a></li>

            <li class="user__profile--menu__items"><a class="user__profile--menu__link"
                                                      href="./settings.html">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-settings">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path
                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                    Account Settings </a></li>

            <li class="user__profile--menu__items">
                <a class="user__profile--menu__link position-relative" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" data-lucide="gem"
                         class="lucide lucide-gem inline-block size-4 ltr:mr-2 rtl:ml-2">
                        <path d="M6 3h12l4 6-10 13L2 9Z"></path>
                        <path d="M11 3 8 9l4 13 4-13-3-6"></path>
                        <path d="M2 9h20"></path>
                    </svg>
                    Upgrade <span class="profile__upgrade--badge">Pro</span>
                </a>
            </li>

            <li class="user__profile--menu__items">
                <a class="user__profile--menu__link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="feather feather-file-text">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Taskboard
                </a>
            </li>
        </ul>
        <div class="dropdown__user--profile__footer">
            <a class="user__profile--log-out__btn" href="{{ route('logout') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" data-lucide="log-out"
                     class="lucide lucide-log-out inline-block size-4 ltr:mr-2 rtl:ml-2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" x2="9" y1="12" y2="12"></line>
                </svg>
                Log Out
            </a>
        </div>
    </div>
</div>

@if ($paginator->hasPages())
    <div class="pagination__area">
        <nav class="pagination justify-content-center">
            <ul class="pagination__menu d-flex align-items-center justify-content-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="pagination__menu--items pagination__arrow d-flex">
                        <a href="#" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.583 20.5832L0.999675 10.9998L10.583 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page left arrow</span>
                        </a>
                        <span class="pagination__arrow-icon">
                                            <svg width="3" height="22" viewBox="0 0 3 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.50098 1L1.50098 21" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                            </svg>
                                        </span>
                        <a href="#" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.001 20.5832L1.41764 10.9998L11.001 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page left arrow</span>
                        </a>
                    </li>
                @else
                    <li class="pagination__menu--items pagination__arrow d-flex">
                        <a href="{{ $paginator->url(1) }}" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.583 20.5832L0.999675 10.9998L10.583 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page left arrow</span>
                        </a>
                        <span class="pagination__arrow-icon">
                                            <svg width="3" height="22" viewBox="0 0 3 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.50098 1L1.50098 21" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                            </svg>
                                        </span>
                        <a href="{{ $paginator->previousPageUrl() }}" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.001 20.5832L1.41764 10.9998L11.001 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page left arrow</span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    @php $index = 0; @endphp
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        @php
                            $index = 1;
                        @endphp
                        <li class="pagination__menu--items"><a href="#"
                                                               class="pagination__menu--link">{{ $element }}</a></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination__menu--items"><a href="#"
                                                                       class="pagination__menu--link active color-accent-1">{{ $page }}</a>
                                </li>
                            @else
                                <li class="pagination__menu--items"><a href="{{ $url }}"
                                                                       class="pagination__menu--link">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination__menu--items pagination__arrow d-flex">
                        <a href="{{ $paginator->nextPageUrl() }}" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00098 20.5832L10.5843 10.9998L1.00098 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page right arrow</span>
                        </a>
                        <span class="pagination__arrow-icon">
                                            <svg width="3" height="22" viewBox="0 0 3 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.50098 1L1.50098 21" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                            </svg>
                                        </span>
                        <a href="{{ $paginator->url(count($elements[$index])) }}" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.41895 20.5832L11.0023 10.9998L1.41895 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page right arrow</span>
                        </a>
                    </li>
                @else
                    <li class="pagination__menu--items pagination__arrow d-flex">
                        <a href="#" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00098 20.5832L10.5843 10.9998L1.00098 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page right arrow</span>
                        </a>
                        <span class="pagination__arrow-icon">
                                            <svg width="3" height="22" viewBox="0 0 3 22" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.50098 1L1.50098 21" stroke="currentColor" stroke-width="2"
                                                  stroke-linecap="round"/>
                                            </svg>
                                        </span>
                        <a href="#" class="pagination__arrow-icon link">
                            <svg width="12" height="22" viewBox="0 0 12 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.41895 20.5832L11.0023 10.9998L1.41895 1.4165" stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="visually-hidden">page right arrow</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif



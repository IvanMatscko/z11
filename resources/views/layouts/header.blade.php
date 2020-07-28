
<div id="modalW" class="modal modal-wait">
    <p class="title">{{ __('l.in_development') }}</p>
    <a href="#" class="closeBtn" rel="modal:close">{{ __('l.ok') }}</a>
</div>

<div id="modalT" class="modal">
    <p class="titleTwo">{{ __('l.user_agreement') }} <span class="right">{{ __('l.user_agreement_reg') }}</span></p>
    {!! __('l.user_agreement_text') !!}
</div>



<header>
    <div class="container">

        <div class="nameSite">
            <a href="{{'/'.App::getLocale()}}" class="logo">
                <img class="d-only" src="/img/Z11-logo-dark.png" alt="">
                <img class="l-only" src="/img/Z11-logo-light.png" alt="">
            </a>
        </div>

        <div class="game-menu">
            <ul class="clearfix">
                <li>
                    <a href="#modalW" rel="modal:open" class="csLink">
                        <img class="l-only" src="img/csgo-icon-gr.png" alt="">
                        <img class="d-only" src="img/csgo-icon-dark.png" alt="">
                    </a>
                </li>
                <li>
                    <a href="#" class="dotaLink">
                        <img class="l-only" src="img/dota-icon-white.png" alt="">
                        <img class="d-only" src="img/dota-icon-red.png" alt="">
                    </a>
                </li>
            </ul>
        </div>

        <div class="header-menu btns-second clerfix">
            <ul class="clearfix">
                <li class="info-item btn-sec"><a href="/{{ App::getLocale() }}/cosplay">{{ __('l.cosplay') }}</a></li>
                <li class="info-item btn-sec"><a href="/{{ App::getLocale() }}/news">{{ __('l.news') }}</a></li>
            </ul>
        </div>

        <div class="sound-switch">
            <label class="switch" for="switchM">
                <input type="checkbox" id="switchM"/>
                <div class="slider round"></div>
            </label>
        </div>

        <div class="theme-switch">
            <label class="switch" for="switch">
                <input type="checkbox" id="switch"/>
                <div class="slider round"></div>
            </label>
        </div>

        <div class="header-search">
            <div class="form-search-h">
                <form action="{{'/'.App::getLocale()}}/search" method="POST">
                    <div class="input-div">
                        <input class="input" list="search_list" type="text" id="search_z11" name="search_z11" placeholder="{{ __('l.search_placeholder') }}">
                        <input class="btn" type="submit" value="">

                        <template id="resultstemplate">
                            @foreach ($search_block as $search_value)
                                <option>{{$search_value}}</option>
                            @endforeach
                        </template>
                        <datalist id="search_list" class="search_list">
                        </datalist>
                    </div>
                </form>
            </div>
        </div>

        <div class="header-menu clerfix">
            <ul class="clearfix">
                <li class="lang-menu">
                    @foreach ($language_block as $block)
                        @if ($block['current'])
                            <div class="current-lang"><img src="/img/{{ $block['img'] }}" alt=""></div>
                            @break
                        @endif
                    @endforeach
                    <ul class="drop-langs">
                        @foreach ($language_block as $block)
                            @if (!$block['current'])
                                <li><a href="{{ $block['url'] }}"><img src="/img/{{ $block['img'] }}" alt=""></a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="info-item"><a href="/{{ App::getLocale() }}/teams">{{ __('l.teams') }}</a></li>
                <li class="info-item"><a href="/{{ App::getLocale() }}/players">{{ __('l.players') }}</a></li>
                <li class="info-item tournament-link"><a href="/{{ App::getLocale() }}/tournament/">{{ __('l.tournament') }}</a></li>
            </ul>
        </div>
        <div class="mobile-menu-btn" onclick="iconFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>

        <div class="mobile-menu">
            <ul>
                <li class="info-item tournament-link"><a href="/{{ App::getLocale() }}/tournament/">{{ __('l.tournament') }}</a></li>
                <li class="lang-menu">
                    @foreach ($language_block as $block)
                        @if ($block['current'])
                            <div class="current-lang"><img src="/img/{{ $block['img'] }}" alt=""></div>
                            @break
                        @endif
                    @endforeach
                    <ul class="drop-langs">
                        @foreach ($language_block as $block)
                            @if (!$block['current'])
                                <li><a href="{{ $block['url'] }}"><img src="/img/{{ $block['img'] }}" alt=""></a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="theme-mob">
                    <label class="switch" for="switch-mob">
                        <input type="checkbox" id="switch-mob"/>
                        <div class="slider round"></div>
                    </label>
                </li>
            </ul>
        </div>
    </div>
</header>

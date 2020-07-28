@extends('layouts.blank')

@section('header')
    <script>
        var socket = io.connect('http://z11:3000');
    </script>
    @include('layouts.header')
@endsection

@section('content')
    <div class="content news">
        <div class="news-wrapper">

{{--            {{ dd( request('lang')['ru'] ) }}--}}

            <form class="news-header">
                <ul class="l-check-list">
                    <li>
                        <label class="checkbox-label">
                            <input type="checkbox" name="lang[ru]" {{ !request('lang') || isset(request('lang')['ru']) ? 'checked' : '' }}>
                            <span class="checkbox-name">Rus</span>
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="checkbox-label">
                            <input type="checkbox" name="ru[dota]" {{ !request('lang') || isset(request('lang')['ru']) && isset(request('ru')['dota']) ? 'checked' : '' }}>
                            <span class="checkbox-name">Dota2</span>
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="checkbox-label">
                            <input type="checkbox" name="ru[cs]" {{ !request('lang') || isset(request('lang')['ru']) && isset(request('ru')['cs']) ? 'checked' : '' }}>
                            <span class="checkbox-name">Cs:go</span>
                            <span class="checkmark"></span>
                        </label>
                    </li>
                </ul>
                <a href="" class="c-link">{{ __('l.how_it_works') }}</a>
                <ul class="r-check-list">
                    <li>
                        <label class="checkbox-label">
                            <input type="checkbox" name="lang[en]" {{ !request('lang') || isset(request('lang')['en']) ? 'checked' : '' }}>
                            <span class="checkbox-name">Eng</span>
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="checkbox-label">
                            <input type="checkbox" name="en[dota]" {{ !request('lang') || isset(request('lang')['en']) && isset(request('en')['dota']) ? 'checked' : '' }}>
                            <span class="checkbox-name">Dota2</span>
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    <li>
                        <label class="checkbox-label">
                            <input type="checkbox" name="en[cs]" {{ !request('lang') || isset(request('lang')['en']) && isset(request('en')['cs']) ? 'checked' : '' }}>
                            <span class="checkbox-name">Cs:go</span>
                            <span class="checkmark"></span>
                        </label>
                    </li>
                </ul>
{{--                <input type="submit" value="применить">--}}

            </form>
            <script>
                $('.news-header').change(function () {
                    $(this).submit()
                })
            </script>

            <div class="twitter-col n-col">
                <div class="title-col">
                    <span class="icon"><img src="/img/news-icon2.png" alt=""></span>
                    <p>Twitter</p>
                    <span class="watch-btn hidden"></span>
                </div>
                <ul class="n-col-nav">
                    <li><a href="#tw-news_actual" class="active">{{ __('l.last_day') }}</a></li>
                    <li><a href="#tw-news_past">{{ __('l.last_week') }}</a></li>
                </ul>
                <div class="news-list">
                    <div class="news-list-wrapper" id="tw-news_actual">
                        @foreach($twNews->sortByDesc('post_created') as $item)
                            <div class="news-post">
                                <div class="header-post">
                                    <div class="left">
                                        <div class="img-div">
                                            <img src="/img/game2-team.png" alt="">
                                        </div>
                                        <p  class="name-user">{{ $item->newsSource->name ?? '' }}</p>
                                        <p class="login-user">{{ '@'.$item->newsSource->source }}</p>
                                    </div>
                                    <div class="right"><span>8</span></div>
                                </div>
                                <div class="content-post">
                                    {{ $item->content }}
                                </div>
                                <div class="footer-post">
                                    <div class="left">
                                        <span class="repost">{{ $item->replies }}</span>
                                        <span class="likes">{{ $item->likes }}</span>
                                    </div>
                                    <div class="right">
                                        <span class="time-post">{{ date('H:i', $item->post_created) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="news-list-wrapper" id="tw-news_past" style="display:none;">
                        @foreach($twNewsPast->sortByDesc('post_created') as $item)
                            <div class="news-post">
                                <div class="header-post">
                                    <div class="left">
                                        <div class="img-div">
                                            <img src="/img/game2-team.png" alt="">
                                        </div>
                                        <p  class="name-user">{{ $item->newsSource->name ?? '' }}</p>
                                        <p class="login-user">{{ '@'.$item->newsSource->source }}</p>
                                    </div>
                                    <div class="right"><span>8</span></div>
                                </div>
                                <div class="content-post">
                                    {{ $item->content }}
                                </div>
                                <div class="footer-post">
                                    <div class="left">
                                        <span class="repost">{{ $item->replies }}</span>
                                        <span class="likes">{{ $item->likes }}</span>
                                    </div>
                                    <div class="right">
                                        <span class="time-post">{{ date('H:i d-m-Y', $item->post_created) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="telegram-col n-col">
                <div class="title-col">
                    <span class="icon"><img src="/img/news-icon3.png" alt=""></span>
                    <p>Telegram</p>
                    <span class="watch-btn"></span>
                </div>
                <ul class="n-col-nav">
                    <li><a href="#tg-news_actual" class="active">{{ __('l.last_day') }}</a></li>
                    <li><a href="#tg-news_past">{{ __('l.last_week') }}</a></li>
                </ul>
                <div class="news-list">
                    <div class="news-list-wrapper" id="tg-news_actual">
                        @foreach($tgNews->sortByDesc('post_created') as $item)
                            <div class="news-post">
                                <div class="header-post">
                                    <div class="left">
                                        <div class="img-div">
                                            <img src="/img/game2-team.png" alt="">
                                        </div>
                                        <p  class="name-user">{{ $item->newsSource->name ?? '' }}</p>
                                        <p class="login-user">{{ '@'.$item->newsSource->source }}</p>
                                    </div>
                                    <div class="right"><span>134</span></div>
                                </div>
                                <div class="content-post">
                                    {{ $item->content }}
                                </div>
                                <div class="footer-post">
                                    <div class="left">
                                        <span class="watch">{{ $item->views }}</span>
                                    </div>
                                    <div class="right">
                                        <span class="time-post">{{ date('H:i', $item->post_created) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="news-list-wrapper" id="tg-news_past" style="display: none;">
                        @foreach($tgNewsPast->sortByDesc('post_created') as $item)
                            <div class="news-post">
                                <div class="header-post">
                                    <div class="left">
                                        <div class="img-div">
                                            <img src="/img/game2-team.png" alt="">
                                        </div>
                                        <p  class="name-user">{{ $item->newsSource->name ?? '' }}</p>
                                        <p class="login-user">{{ '@'.$item->newsSource->source }}</p>
                                    </div>
                                    <div class="right"><span>134</span></div>
                                </div>
                                <div class="content-post">
                                    {{ $item->content }}
                                </div>
                                <div class="footer-post">
                                    <div class="left">
                                        <span class="watch">{{ $item->views }}</span>
                                    </div>
                                    <div class="right">
                                        <span class="time-post">{{ date('H:i d-m-Y', $item->post_created) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="single-scrollbar n-col"></div>

            <script>
                $('.n-col-nav li a').click(function () {
                	$(this).parents('.n-col-nav').siblings('.news-list').find('.news-list-wrapper').hide();

	                console.log($($(this).attr('href')) );
                    $($(this).attr('href')).show()
                    $(this).parent('li').siblings('li').find('a').removeClass('active')
                    $(this).addClass('active')
                })
            </script>

            {{--ВРЕМЕННЫЕ СТИЛИ END--}}
{{--            <div class="twitter-col n-col">--}}
{{--                <div class="title-col">--}}
{{--                    <span class="icon"><img src="/img/news-icon2.png" alt=""></span>--}}
{{--                    <p>Twitter</p>--}}
{{--                    <span class="watch-btn hidden"></span>--}}
{{--                </div>--}}
{{--                <ul class="n-col-nav">--}}
{{--                    <li><a href="">Сутки</a></li>--}}
{{--                    <li><a href="" class="active">Неделя</a></li>--}}
{{--                </ul>--}}
{{--                <div class="news-list">--}}
{{--                    @foreach($twNewsPast->sortByDesc('post_created') as $item)--}}
{{--                        <div class="news-post">--}}
{{--                            <div class="header-post">--}}
{{--                                <div class="left">--}}
{{--                                    <div class="img-div">--}}
{{--                                        <img src="/img/game2-team.png" alt="">--}}
{{--                                    </div>--}}
{{--                                    <p  class="name-user">{{ $item->newsSource->name ?? '' }}</p>--}}
{{--                                    <p class="login-user">@danil_gugu</p>--}}
{{--                                </div>--}}
{{--                                <div class="right"><span>8</span></div>--}}
{{--                            </div>--}}
{{--                            <div class="content-post">--}}
{{--                                {{ $item->content }}--}}
{{--                            </div>--}}
{{--                            <div class="footer-post">--}}
{{--                                <div class="left">--}}
{{--                                    <span class="repost">{{ $item->replies }}</span>--}}
{{--                                    <span class="likes">{{ $item->likes }}</span>--}}
{{--                                </div>--}}
{{--                                <div class="right">--}}
{{--                                    <span class="time-post">Вчера, 18:09</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="telegram-col n-col">--}}
{{--                <div class="title-col">--}}
{{--                    <span class="icon"><img src="/img/news-icon3.png" alt=""></span>--}}
{{--                    <p>Telegram</p>--}}
{{--                    <span class="watch-btn"></span>--}}
{{--                </div>--}}
{{--                <ul class="n-col-nav">--}}
{{--                    <li><a href="">Сутки</a></li>--}}
{{--                    <li><a href="" class="active">Неделя</a></li>--}}
{{--                </ul>--}}
{{--                <div class="news-list">--}}
{{--                    @foreach($tgNewsPast->sortByDesc('post_created') as $item)--}}
{{--                        <div class="news-post">--}}
{{--                            <div class="header-post">--}}
{{--                                <div class="left">--}}
{{--                                    <div class="img-div">--}}
{{--                                        <img src="/img/game2-team.png" alt="">--}}
{{--                                    </div>--}}
{{--                                    <p  class="name-user">{{ $item->newsSource->name ?? '' }}</p>--}}
{{--                                    <p class="login-user">@dvachannel</p>--}}
{{--                                </div>--}}
{{--                                <div class="right"><span>134</span></div>--}}
{{--                            </div>--}}
{{--                            <div class="content-post">--}}
{{--                                {{ $item->content }}--}}
{{--                            </div>--}}
{{--                            <div class="footer-post">--}}
{{--                                <div class="left">--}}
{{--                                    <span class="watch">{{ $item->views }}</span>--}}
{{--                                </div>--}}
{{--                                <div class="right">--}}
{{--                                    <span class="time-post">6:00</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('scripts')
    <script type="text/javascript">

		$('.news-list').jScrollPane({
			showArrows: true,
			arrowScrollOnHover: true,
			verticalGutter: 0,
			contentWidth: '0px'
		});


		$(".news .watch-btn").click(function() {
			$(this).toggleClass("hidden");
		});

    </script>
@endsection

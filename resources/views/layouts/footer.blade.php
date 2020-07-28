<footer>
    <div class="container clearfix">
        <div class="logo-footer">
            <a href="{{'/'.App::getLocale()}}" class="logo">
                <img class="d-only" src="/img/Z11-logo-dark.png" alt="">
                <img class="l-only" src="/img/Z11-logo-light.png" alt="">
            </a>
        </div>

        <ul class="menu-footer clearfix">
            <li class="active"><a href="">{{ __('l.main') }}</a></li>
            <li><a href="#modalT" rel="modal:open">{{ __('l.rules') }}</a></li>
        </ul>

        <ul class="footer-info">
            <li class="li-f">{{ __('l.powered_by') }} <span class="red">{{ __('l.creator') }}</span></li>
            <li>{{ __('l.all_rights_reserved') }} <span class="green">{!! __('l.all_rights_reserved_date') !!}</span></li>
            <li>
                <p><span class="green"><i class="far fa-envelope"></i></span>Info@z11.live</p>
                <p><span class="red"><i class="far fa-envelope"></i></span>admin@z11.live</p>
            </li>
            <li>
                <p><span class="green">{{ __('l.design') }}</span>: krisemka7@gmail.com</p>
                <p><span class="red">{{ __('l.layout') }}</span>: webden41k@gmail.com</p>
            </li>
        </ul>
    </div>
</footer>


<script src="/js/jquery-3.1.1.min.js"></script>
<script src="/js/jquery.mousewheel.js"></script>
<script src="{{ asset('js/jquery.jscrollpane.min.js') }}"></script>
<script src="/js/slick.min.js"></script>
<script src="/js/jquery.modal.min.js"></script>
<script src="/js/script.js"></script>
<script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},100); if (typeof window.run_stream_after === "function") {run_stream_after();}};</script>

@if (Route::currentRouteName() === 'main')

<script type="text/javascript">
    if($(window).width() < 1699) {
    $('.side-online .listMess').jScrollPane({
    showArrows: true,
    arrowScrollOnHover: true,
    verticalGutter: 0,
    contentWidth: '0px'
    });
    }

    if($(window).width() < 1599) {
    $(".side-online .menu-side-v2 li").removeClass("active");
    $(".side-online .match-list-info li").removeClass("open");
    $(".side-online").addClass("hide");

    $(".menu-side-v2 .link-live").click(function() {
    $(".menu-side-v2 li").removeClass("active");
    $(".side-online").addClass("hide");
    $(".match-list-info .live").addClass("open");
    $(".match-list-info .last").removeClass("open");
    $(".match-list-info .future").removeClass("open");
    $(this).addClass("active");
    });

    $(".menu-side-v2 .link-future").click(function() {
    $(".menu-side-v2 li").removeClass("active");
    $(".side-online").addClass("hide");
    $(".match-list-info .future").addClass("open");
    $(".match-list-info .last").removeClass("open");
    $(".match-list-info .live").removeClass("open");
    $(this).addClass("active");
    });



    $(".menu-side-v2 .link-chat").click(function() {
    $(".menu-side-v2 li").removeClass("active");
    $(".side-online").removeClass("hide");
    $(this).addClass("active");
    $(".match-list-info .future").removeClass("open");
    $(".match-list-info .live").removeClass("open");
    });


    $(".menu-side-v2 .link-last").click(function() {
    $(".menu-side-v2 li").removeClass("active");
    $(".side-online").addClass("hide");
    $(".side-online .box-shadow").show();
    $(".match-list-info .last").addClass("open");
    $(".match-list-info .future").removeClass("open");
    $(".match-list-info .live").removeClass("open");
    $(this).addClass("active");
    });
    }
</script>
<script>

</script>
@endif


@if (Route::currentRouteName() === 'main.results' || Route::currentRouteName() === 'main.schedule')
<script type="text/javascript">
    let datepicker_lang = '{{ App::getLocale() }}';
</script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/datepicker-ru.js"></script>
<script type="text/javascript">

$('.result-slider').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 1919,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1439,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 1119,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 799,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
        ]
    });

    $.datepicker.setDefaults($.datepicker.regional[datepicker_lang ? datepicker_lang : 'ru'])

    function getDataRowNumber(width) {
        if (width >= 1903){
            return 3;
        } else if(width >= 1439 && width < 1903) {
            return 2;
        }else if (width >= 1119 && width < 1439){
            return 1;
        } else if(width >= 799 && width < 1119) {
            return 0;
        } else {
            return 0;
        }
    }

    $("#datepicker").datepicker({
        @switch (Route::currentRouteName())
            @case('main.results')
                dateFormat: 'yy-mm-dd', minDate:(-365), maxDate:(0),
                @break
            @case('main.schedule')
                dateFormat: 'yy-mm-dd', minDate:(0), maxDate:(365),
                @break
        @endswitch
        onSelect: function (date, datepicker) {
            let currentDay = datepicker.currentDay, currentMonth = datepicker.currentMonth, $container = $('.side-container');
            currentMonth = currentMonth + 1; // in js the months start with 0
            currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;
            currentDay = currentDay < 10 ? '0' + currentDay : currentDay;

            let row_name = 'row-' + currentDay + '_' + currentMonth, find_row = $container.find('#' + row_name);

            if (typeof find_row.html() != 'undefined' && find_row.html().indexOf != -1) {
                let data_row = getDataRowNumber($(window).width()), block_number_four = $container.find('[data-row-number="'+data_row+'"]'), block_number_four_container = $container.find('[data-row-number="'+data_row+'_display_container"]');
                block_number_four_container.empty();
                block_number_four_container[0].setAttribute("style", block_number_four[0].getAttribute("style"));
                find_row.clone().appendTo( block_number_four_container );
                block_number_four_container.addClass('active');
            }
        }
    });

    if ($(window).width() < 1699) {
        $('.side-online .listMess').jScrollPane({
            showArrows: true,
            arrowScrollOnHover: true,
            verticalGutter: 0,
            contentWidth: '0px'
        });
    }

    if ($(window).width() < 1599) {
        $(".side-online .menu-side-v2 li").removeClass("active");
        $(".side-online .match-list-info li").removeClass("open");
        $(".side-online").addClass("hide");

        $(".menu-side-v2 .link-live").click(function () {
            $(".menu-side-v2 li").removeClass("active");
            $(".side-online").addClass("hide");
            $(".match-list-info .live").addClass("open");
            $(".match-list-info .last").removeClass("open");
            $(".match-list-info .future").removeClass("open");
            $(this).addClass("active");
        });

        $(".menu-side-v2 .link-future").click(function () {
            $(".menu-side-v2 li").removeClass("active");
            $(".side-online").addClass("hide");
            $(".match-list-info .future").addClass("open");
            $(".match-list-info .last").removeClass("open");
            $(".match-list-info .live").removeClass("open");
            $(this).addClass("active");
        });

        $(".menu-side-v2 .link-chat").click(function () {
            $(".menu-side-v2 li").removeClass("active");
            $(".side-online").removeClass("hide");
            $(this).addClass("active");
            $(".match-list-info .future").removeClass("open");
            $(".match-list-info .live").removeClass("open");
        });

        $(".menu-side-v2 .link-last").click(function () {
            $(".menu-side-v2 li").removeClass("active");
            $(".side-online").addClass("hide");
            $(".side-online .box-shadow").show();
            $(".match-list-info .last").addClass("open");
            $(".match-list-info .future").removeClass("open");
            $(".match-list-info .live").removeClass("open");
            $(this).addClass("active");
        });
    }
</script>
@endif

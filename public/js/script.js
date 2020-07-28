'use strict';

function iconFunction(x) {
  x.classList.toggle("change");
  $(".mobile-menu").toggleClass("open");
}


  let head = document.head,
      link = document.createElement('link');
  link.rel = 'stylesheet';

  if (localStorage.getItem('themeStyle') === 'light') {
    link.href = '';
    $('#switch'). attr("checked", "checked");
    $('#switch-mob'). attr("checked", "checked");
  }

  else {

    link.href = '/css/dark.css';
    $('#switch').removeAttr('checked');
    $('#switch-mob').removeAttr('checked');

  }
  head.appendChild(link);


  let volumeType = localStorage.getItem('volume');
  if ( volumeType && volumeType == 0)
      document.getElementById('switchM').checked = true;

  document.getElementById('switchM').addEventListener('change', ev => {
      let btn = ev.target;

      if (btn.checked) {
          localStorage.setItem('volume', 0);

      } else {
          localStorage.setItem('volume', 0.7);
      }
  });


  document.getElementById('switch').addEventListener('change', ev => {
    let btn = ev.target;

    if (btn.checked) {
      link.href = '';
      localStorage.setItem('themeStyle', 'light');

    }
    else {

      link.href = '/css/dark.css';
      localStorage.setItem('themeStyle', 'dark');
    }
  });

  document.getElementById('switch-mob').addEventListener('change', ev => {
    let btn = ev.target;

    if (btn.checked) {
      link.href = '';
      localStorage.setItem('themeStyle', 'light');

    }
    else {

      link.href = '/css/dark.css';
      localStorage.setItem('themeStyle', 'dark');
    }
  });




$('.big-banner').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 15000
});



$(".menu-side-v2 .link-live").click(function() {
  $(".menu-side-v2 .link-future").removeClass("active");
  $(".match-list-info .future").removeClass("open");
  $(".match-list-info .live").addClass("open");
  document.getElementById("match_live_container").setAttribute("style", "display: block;");
  document.getElementById("match_future_container").setAttribute("style", "display: none;");
  $(this).addClass("active");
});

$(".menu-side-v2 .link-future").click(function() {
  $(".menu-side-v2 .link-live").removeClass("active");
  $(".match-list-info .live").removeClass("open");
  $(".match-list-info .future").addClass("open");
  document.getElementById("match_live_container").setAttribute("style", "display: none;");
  document.getElementById("match_future_container").setAttribute("style", "display: block;");
  $(this).addClass("active");
});



$(".menu-side-v2 .link-chat").click(function() {
  $(".menu-side-v2 .link-last").removeClass("active");
  $(".side-online").removeClass("hide");
  $(this).addClass("active");

});


$(".menu-side-v2 .link-last").click(function() {
  $(".menu-side-v2 .link-chat").removeClass("active");
  $(".side-online").addClass("hide");
  $(".match-list-info .last").addClass("open");
  $(this).addClass("active");
});


// $(".match-list-info .match-item").click(function() {
//   $(".match-list-info li").removeClass("focus");
//   $(this).parent().addClass("focus");
//   //$(".match-open").addClass("open");
// });


$('.scroll-pane').jScrollPane({
  showArrows: true,
  arrowScrollOnHover: true
});


//ADD TO COSPLAY PAGE


$('.cosplay-list-one').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
        {
            breakpoint: 1023,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },{
            breakpoint: 550,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
$('.cosplay-list-two').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
        {
            breakpoint: 1023,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },{
            breakpoint: 550,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
//
// $('.cosplay-list-three').slick({
//     infinite: true,
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     arrows: true,
//     dots: false,
//     responsive: [
//         {
//             breakpoint: 767,
//             settings: {
//                 slidesToShow: 2,
//                 slidesToScroll: 1
//             }
//         },
//         {
//             breakpoint: 550,
//             settings: {
//                 slidesToShow: 1,
//                 slidesToScroll: 1
//             }
//         }
//     ]
// });

function postLike(idImage, type, fromPoll = false) {
    $.ajax({
        method: 'POST',
        url: '/cosplay',
        data: {
            image: idImage,
            type: type,
            isPoll: fromPoll
        },
        success: data => {
            console.log(data)
        }
    })
}

$(".item-cosplay .marks li").click(function() {
    let used = $(this).hasClass('active');
    let likeOrDislike = $(this).hasClass('like') ? 'like' : 'dislike';

    $(this).parent().find( "li" ).removeClass("active");
    $(this).toggleClass("active");

    if (!used)
        postLike( $(this).attr('idImage'), likeOrDislike );
});

$(".best-point .like").click(function() {
    $(this).toggleClass("active");
});

$(function() {
    $("ul.head-menu").on("click", "li:not(.active)", function () {
        $(this)
            .addClass("active")
            .siblings()
            .removeClass("active")
            .closest("div.table-match-right")
            .find("ul.tabs__content")
            .removeClass("active")
            .eq($(this).index())
            .addClass("active");
    });
});

var search = document.querySelector('#search_z11');
var results = document.querySelector('#search_list');
var templateContent = document.querySelector('#resultstemplate').content;
search.addEventListener('keyup', function handler(event) {
    while (results.children.length) results.removeChild(results.firstChild);
    var inputVal = new RegExp(search.value.trim(), 'i');
    var set = Array.prototype.reduce.call(templateContent.cloneNode(true).children, function searchFilter(frag, item, i) {
        if (inputVal.test(item.textContent) && frag.children.length < 5) frag.appendChild(item);
        return frag;
    }, document.createDocumentFragment());
    results.appendChild(set);
});


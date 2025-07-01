$('.main-slider-carousel').owlCarousel({
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  loop: true,
  margin: 0,
  nav: false,
  autoplay: false,
  autoplayTimeout: 9000,
  //autoHeight: true,
  smartSpeed: 500,
  //autoplay: 6000,
  navText: ['<span class="flaticon-left-arrow"></span>', '<span class="flaticon-right-arrow"></span>'],
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 1
    },
    800: {
      items: 1
    },
    1024: {
      items: 1
    },
    1200: {
      items: 1
    }
  }
});
// banner-carousel
if ($('.banner-carousel').length) {
  $('.banner-carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: true,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    active: true,
    smartSpeed: 1000,
    autoplay: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      800: {
        items: 1
      },
      1024: {
        items: 1
      }
    }
  });
}

/*-----------------------------------
   Back to Top
   -----------------------------------*/
var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


$(document).ready(function(){
 let scroll_link = $('.scroll');

  //smooth scrolling -----------------------
  scroll_link.click(function(e){
      e.preventDefault();
      let url = $('body').find($(this).attr('href')).offset().top- 60;
      $('html, body').animate({
        scrollTop : url
      },700);
      $(this).parent().addClass('active');
      $(this).parent().siblings().removeClass('active');
      return false; 
   });
});

//wow js
    var wow = new WOW({
        animateClass: 'animated',
        offset: 100,
        mobile: false,
        duration: 1000,
    });
    wow.init();

//scorl animation js
var $single_portfolio_img = $('.overlay_effect');
var $window = $(window);

function scroll_addclass() {
  var window_height = $(window).height() - 200;
  var window_top_position = $window.scrollTop();
  var window_bottom_position = (window_top_position + window_height);

  $.each($single_portfolio_img, function () {
    var $element = $(this);
    var element_height = $element.outerHeight();
    var element_top_position = $element.offset().top;
    var element_bottom_position = (element_top_position + element_height);

    //check to see if this current container is within viewport
    if ((element_bottom_position >= window_top_position) &&
      (element_top_position <= window_bottom_position)) {
      $element.addClass('is_show');
    }
  });
}

$window.on('scroll resize', scroll_addclass);
$window.trigger('scroll');

// sticky
$(window).on('scroll', function () {
  var scroll = $(window).scrollTop();
  if (scroll < 200) {
    $("#header-sticky").removeClass("sticky-menu");
  } else {
    $("#header-sticky").addClass("sticky-menu");
  }
});

//AOS.init({
      //  once: true
    //});

$(document).ready(function(){  
  var currentRoute = "/";
    if (currentRoute === "/") 
      {
            //  Age Restriction Modal
            var isLegalAge = localStorage.getItem("isLegalAge");
        
            if (isLegalAge === "true") 
            {
                $('#onloadpopup').modal('hide');
            }
            else
            {
                $('#onloadpopup').modal('show');
            }
            
            $('.btn-yes').on('click', function() {
                localStorage.setItem("isLegalAge", "true");
        
                // Close the modal
                $('#onloadpopup').modal('hide');
            });
        
            $('.btn-no').on('click', function() {
                $('.notext').show();
            });
      }
    });


$(document).ready(function(){
    $(".button a").click(function(){
        $(".overlay").fadeToggle(200);
       $(this).toggleClass('btn-open').toggleClass('');
    });
});
$('.overlay').on('click', function(){
    $(".overlay").fadeToggle(200);   
    $(".button a").toggleClass('btn-open').toggleClass('');
    open = false;
});


$(".readmore-link").click( function(e) {
  // record if our text is expanded
  var isExpanded =  $(e.target).hasClass("expand");
  
  //close all open paragraphs
  $(".readmore.expand").removeClass("expand");
  $(".readmore-link.expand").removeClass("expand");
  
  // if target wasn't expand, then expand it
  if (!isExpanded){
    $( e.target ).parent( ".readmore" ).addClass( "expand" );
    $(e.target).addClass("expand");  
  } 
});

function displayText() {
  var text = document.getElementById("textField");
  text.style.display = "block";
}


const phoneInput = document.querySelector("#phoneInput");

  // Initialize intlTelInput
  const iti = window.intlTelInput(phoneInput, {
    initialCountry: "IN",
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.min.js"
  });

  // Set initial country based on the user's location
  iti.promise.then(() => {
    const countryCode = iti.getSelectedCountryData().iso2;
    iti.setCountry(countryCode);
  });

  // Listen for the country change event
  phoneInput.addEventListener("countrychange", function() {
    const countryCode = iti.getSelectedCountryData().iso2;
    console.log("Selected country code:", countryCode);
  });

      
    
      
    
  
    

/*Parallax*/

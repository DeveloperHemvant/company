// setup
var sliderBool = false,
	sliderBreakpoint = 667,
	sliderSettings = {
		mobileFirst: true,
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		arrows: false,
		autoplay: false,
		responsive: [{
				breakpoint: sliderBreakpoint,
				settings: "unslick"
			}

		]
	};

function sliderInit(sliderElem) {
	if (window.innerWidth <= sliderBreakpoint) {
		if (sliderBool == false) {
			$("" + sliderElem + "").slick(sliderSettings);
			sliderBool = true;
		}
	} else {
		sliderBool = false;
	}
}

// init
sliderInit(".our-courses .row");

// resize
$(window).resize(function () {
	sliderInit(".our-courses .row");
});

$('.our-courses .row').slick({
	dots: true,
  infinite: true,
  autoplay: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
	
})


.on("setPosition", function () {
    resizeSlider();
  });

$(window).on("resize", function (e) {
  resizeSlider();
});

var slickHeight = $(".slick-track").outerHeight();

var slideHeight = $(".slick-track").find(".slick-slide").outerHeight();

function resizeSlider() {
  $(".slick-track")
    .find(".slick-slide .box-content")
    .css("height", slickHeight + "px");
}



// setup
var sliderBool = false,
	sliderBreakpoint = 667,
	sliderSettings = {
		mobileFirst: true,
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		arrows: false,
		autoplay: false,
		responsive: [{
				breakpoint: sliderBreakpoint,
				settings: "unslick"
			}

		]
	}
	

// function sliderInit(sliderElem) {
// 	if (window.innerWidth <= sliderBreakpoint) {
// 		if (sliderBool == false) {
// 			$("" + sliderElem + "").slick(sliderSettings);
// 			sliderBool = true;
// 		}
// 	} else {
// 		sliderBool = false;
// 	}
// }

// init
sliderInit(".juniorcode  .row");

// resize
$(window).resize(function () {
	sliderInit(".juniorcode  .row");
});

// setup
var sliderBool = false,
	sliderBreakpoint = 500,
	sliderSettings = {
		mobileFirst: true,
		dots: true,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		arrows: false,
		autoplay: false,
		responsive: [{
				breakpoint: sliderBreakpoint,
				settings: "unslick"
			}

		]
	};

// function sliderInit(sliderElem) {
// 	if (window.innerWidth <= sliderBreakpoint) {
// 		if (sliderBool == false) {
// 			$("" + sliderElem + "").slick(sliderSettings);
// 			sliderBool = true;
// 		}
// 	} else {
// 		sliderBool = false;
// 	}
// }

// init
sliderInit(".cliente");

// resize
$(window).resize(function () {
	sliderInit(".cliente");
});



  $(".home-Slider").slick({
    autoplay:true,
    autoplaySpeed:10000,
    speed:600,
    slidesToShow:1,
    slidesToScroll:1,
    pauseOnHover:false,
    dots:false,
    pauseOnDotsHover:true,
    cssEase:'linear',
	fade: true,
   // fade:true,
    draggable:false,
    prevArrow:'<button class="PrevArrow"></button>',
    nextArrow:'<button class="NextArrow"></button>', 
  });
  
  
  $('.counting').each(function() {
  var $this = $(this),
      countTo = $this.attr('data-count');
  
  $({ countNum: $this.text()}).animate(
    { countNum: countTo },
    {
      duration: 5000,
      easing:'linear',
      step: function() {
        $this.text(Math.floor(this.countNum));
      },
      complete: function() {
        $this.text(this.countNum);
      }
    }
  );
});
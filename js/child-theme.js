$(document).ready(function () {

	$.cookieBar({
			style:'bottom',
			infoLink:  'https://www.scienceandstuff.com/privacy-policy/',
			infoTarget:'_blank',
			expireDays: 365
		  });
		

	$('.trending-carousel').slick({
		infinite: true,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: false,
		autoplay: false,
		autoplaySpeed: 4000,
		cssEase: 'linear',
		speed: 1000,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true,
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					dots: true,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});

	$('.videos-carousel').slick({
		infinite: true,
		speed: 300,
		slidesToShow: 4,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		cssEase: 'linear',
		speed: 1000,
		arrows: false,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true
				}
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					dots: true,
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: true,
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});

	$('.featured-post').click(function (e) {
		e.preventDefault();
		var h = $(this).find('a').attr('href');
		window.location.href = h;
	});

	if ($('iframe').length > 0) {
		$('iframe').parent().addClass('ratio ratio-16x9')
	}

	var stickyOffset = $('.sticky').offset().top;
	$(window).scroll(function() {
	var sticky = $('.sticky'),
		scroll = $(window).scrollTop();

	if (scroll >= stickyOffset) sticky.addClass('fixed-top');
		else sticky.removeClass('fixed-top');
	});

	

});
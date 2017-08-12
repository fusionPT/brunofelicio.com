$(document).ready(function() {

	// Close mobile menu

	$( ".close-btn" ).on( "click", function() {
	  //console.log('Success!');
		$( ".menu-overlay" ).fadeOut( 200, function() {
	    $(".menu-overlay").css("display", "none");
	  });
	});

	$( ".mobile-menu-toggle" ).on( "click", function() {
	  //console.log('Success!');

		$( ".menu-overlay" ).fadeIn( 200, function() {
	    $(".menu-overlay").css("display", "block");
	  });

	});


	//

	$("img.lazy").lazyload({
			threshold : 200,
			effect : "fadeIn"
	});

	$("a.screenshot").fancybox({
		'transitionIn'		: 'fade',
		'transitionOut'		: 'fade',
		'showCloseButton'	: false,
		'titlePosition' 	: 'inside',
		'overlayOpacity'	: '0.8',
		'overlayColor'		: '#fff'
	});

	function getPlayerShots (){

	    console.log("Loading dribbble shots");

			$.jribbble.setToken('2784cf9d3d8abea842e4752f76b77aa14939e568cf6c4da558a1d5f459d64e8c');

			$.jribbble.users('brunofelicio').shots({per_page: 4}).then(function(shots) {

			  	var html = [];

			  shots.forEach(function(shot) {
			    html.push('<li class="thumb">');
			    html.push('<a href="' + shot.html_url + '">');
			    html.push('<img class="overlay-image" src="' + shot.images.normal + '" ');
			    html.push('alt="' + shot.title + '"></a></li>');
			    });

			  $('.portfolio').html(html.join(''));

		});

	}

	getPlayerShots();



});

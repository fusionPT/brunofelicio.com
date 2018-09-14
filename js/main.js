$(document).ready(function() {

	// Close mobile menu

	$( ".close-btn" ).on( "click", function() {
	  //console.log('Success!');

		$(".menu-overlay ul li").toggleClass('menu-anim').promise().done(function(){
			$(".menu-overlay").toggleClass('overlay-anim');
		});

		/*$( ".menu-overlay" ).fadeOut( 200, function() {
	    $(".menu-overlay").css("display", "none");
	  });*/
	});

	$( ".mobile-menu-toggle" ).on( "click", function() {
	  //console.log('Success!');

		$(".menu-overlay").toggleClass('overlay-anim').promise().done(function(){
			$(".menu-overlay ul li").addClass('menu-anim');
		});
		/*$( ".menu-overlay" ).fadeIn( 200, function() {
	    $(".menu-overlay").css("display", "block");
	  });*/

	});


	// End of mobile menu


	$(".lazy").Lazy({
        beforeLoad: function(element) {
					var image_height = (element).height();
					console.log("Image height is:" + image_height);
					$(".top-image").animate({
						height: (image_height + 120),
					});
        },
        afterLoad: function(element) {
					element.addClass('lazyAnimation');

        },
        onError: function(element) {
            // called whenever an element could not be handled
        },
        onFinishedAll: function() {

        }
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

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

					$('.top-image .lazy').addClass('lazyAnimation');
					$('.pf-item .lazy').addClass('lazyOpacity');
					$('.screenshot .lazy').addClass('lazyOpacity');

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


			$.jribbble.setToken('4ede761d04082a5979c78395034951584d593b51bb1f00c4f7150d25d2141d45');

			$.jribbble.users('brunofelicio').shots({per_page: 4}).then(function(shots) {

			  	var html = [];

			  shots.forEach(function(shot) {
			    html.push('<li class="thumb">');
			    html.push('<a href="' + shot.html_url + '">');
			    html.push('<img class="overlay-image" src="' + shot.images.normal + '" ');
			    html.push('alt="' + shot.title + '"></a></li>');
			    });

			  $('.page-template-about-php .content').html(html.join(''));

		});

	}

	getPlayerShots();



});

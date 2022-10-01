$(document).ready(function() {

	// Close mobile menu

	$( ".close-btn" ).on( "click", function() {
	  //console.log('Success!');

		$(".menu-overlay ul li").toggleClass('menu-anim').promise().done(function(){
			$(".menu-overlay").toggleClass('overlay-anim');
		});
	});

	$( ".mobile-menu-toggle" ).on( "click", function() {

		$(".menu-overlay").toggleClass('overlay-anim').promise().done(function(){
			$(".menu-overlay ul li").addClass('menu-anim');
		});

	});


	// End of mobile menu

	$(".lazy").Lazy({
        beforeLoad: function(element) {
					var image_height = (element).height();
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
		'overlayColor'		: '#000',
		'maxWidth'        : '100%',
		'fitToView'       : false,
    'width'           : '100%',
    'height'          : 'auto',
    'autoSize'        : false,
		'closeClick'  : true,
		'helpers' : {
          'overlay' : {
							'css': {
								'background-color': '#fff',
								'opacity'					: 0.8
							},
              'locked': false,
							'overlay' : {'closeClick': true}
          }
    }
	});

	$( ".fancybox-opened" ).on( "click", function() {
	  console.log('Click!');

		$.fancybox.close();
	});



});

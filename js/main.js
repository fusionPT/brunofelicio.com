$(document).ready(function() {
	console.log('Script loaded!'); 

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

	
	$(document).ready(function () {
		$('.custom-password-form').off('submit').on('submit', function (e) {
			e.preventDefault(); // Prevent form submission
	
			const $form = $(this);
			const $button = $form.find('.password-submit');
			const postID = $form.data('post-id');
			const password = $form.find('input[name="post_password"]').val();
			const ajaxURL = ajax_object.ajax_url;
	
			// Clear previous error messages
			const $error = $form.find('.password-error');
			$error.removeClass('visible').text('');
	
			// Add spinner and disable button
			$button.prop('disabled', true).html('<span class="spinner"></span>');
	
			// Send the AJAX request
			$.ajax({
				url: ajaxURL,
				type: 'POST',
				data: {
					action: 'validate_password',
					post_id: postID,
					password: password,
				},
				success: function (response) {
					if (response.success) {
						// Password is correct, reload the page
						location.reload();
					} else {
						// Show the error message inline
						$error.text(response.data || 'Incorrect password. Please try again.').addClass('visible');
						$button.prop('disabled', false).html('Submit'); // Reset button
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.error('AJAX Error:', textStatus, errorThrown);
					$error.text('An error occurred. Please try again.').addClass('visible');
					$button.prop('disabled', false).html('Submit'); // Reset button
				},
			});
		});
	});
	

});

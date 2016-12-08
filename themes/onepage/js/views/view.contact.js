/*
Name: 			View - Contact
Written by: 	Okler Themes - (http://www.okler.net)
Version: 		3.3.0
*/

(function($) {

	'use strict';

	/*
	Contact Form: Basic
	*/
	$('#contactForm:not([data-type=advanced])').validate({
		submitHandler: function(form) {

			var $form = $(form),
				$messageSuccess = $('#contactSuccess'),
				$messageError = $('#contactError'),
				$submitButton = $(this.submitButton);

			$submitButton.button('loading');

			// Ajax Submit
			$.ajax({
				type: 'POST',
				url: $form.attr('action'),
				data: {
					name: $form.find('#name').val(),
					email: $form.find('#email').val(),
					subject: $form.find('#subject').val(),
					message: $form.find('#message').val()
				},
				dataType: 'json',
				complete: function(data) {
					if (data.response == 'success') {

						$messageSuccess.removeClass('hidden');
						$messageError.addClass('hidden');

						// Reset Form
						$form.find('.form-control')
							.val('')
							.blur()
							.parent()
							.removeClass('has-success')
							.removeClass('has-error')
							.find('label.error')
							.remove();

						if (($messageSuccess.position().top - 80) < $(window).scrollTop()) {
							$('html, body').animate({
								scrollTop: $messageSuccess.offset().top - 80
							}, 300);
						}

						return;

					} else {

						$messageError.removeClass('hidden');
						$messageSuccess.addClass('hidden');

						if (($messageError.position().top - 80) < $(window).scrollTop()) {
							$('html, body').animate({
								scrollTop: $messageError.offset().top - 80
							}, 300);
						}

						$form.find('.has-success')
							.removeClass('has-success');

					}

					$submitButton.button('reset');
				}
			});
		}
	});

	/*
	Contact Form: Advanced
	*/
	$('#contactFormAdvanced, #contactForm[data-type=advanced]').validate({
		onkeyup: false,
		onclick: false,
		onfocusout: false,
		rules: {
			'captcha': {
				captcha: true
			},
			'checkboxes[]': {
				required: true
			},
			'radios': {
				required: true
			}
		}
	});

}).apply(this, [jQuery]);
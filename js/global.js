"use strict";

/*globals $, jQuery, window, document */

(function () {

	var NUDGE_ME = 30, //amount subtracted (will move image down)
		nav, hidden, details, wide, links, arrows, current = 0, 
		emailTrigger, emailVisible = false, preloaded = {},
		subnav, footer, emailForm, emailThanks, emailWrapper, controls;

	function verticalAlign() {
		var size, wrap, elem = $(this);
		size = parseInt(this.height, 10);
		wrap = parseInt(wide.css('height'), 10);
		
		elem.css('margin-top', (((wrap - size) / 2) - NUDGE_ME) + 'px');
	
		//elem.fadeIn('fast');	
		elem.show();
	}

	function loadImage(src) {
		wide.find('img').hide().attr({src: src}).load(verticalAlign);	
	}

	function galleryPrev(all, curr) {
		return curr - 1 >= 0 ? curr - 1 : all - 1;
	}

	function galleryNext(all, curr) {
		return curr + 1 < all ? curr + 1 : 0;
	}

	function loadGallery(ctx) {
		var images = [], current = 0, stat = subnav.find('span');
		if (ctx.find('.attached').length) {
			images.push(ctx.attr('data-image'));
			
			ctx.find('.attached').each(function () {
				images.push($(this).attr('data-src'));
			});
		
			stat.text('1/' + images.length);
			subnav
				.show()
				.find('a').unbind().click(function () {
					current = this.className === 'prev' ? 
						galleryPrev(images.length, current) :  galleryNext(images.length, current);
					loadImage(images[current]);
					
					stat.text((current + 1) + '/' + images.length);
					
					return false;
				});		
			
		}
	}

	function showImage() {
		var elem = $(this), nextImage;
		
		current = links.index(this);
		
		links.removeClass('on');
		elem.addClass('on');
		details.find('h3').html(elem.text() + '<span>' + elem.attr('rel') + '</span>');
	
		loadImage(elem.attr('data-image'));
		
		if (current < links.length - 1) {
			nextImage = current + 1;
			
			if (!Object.hasOwnProperty.call(preloaded, nextImage)) {
				(new Image()).src = links.eq(nextImage).attr('data-image');
				preloaded[nextImage] = true;
			}	
		}
		
		subnav.hide();
		loadGallery(elem);
	
		return false;
	}
	
	function getNext() {
		current = current + 1 >= links.length ? 0 : current + 1;
		return current;
	}
	
	function getPrev() {
		current = current - 1 < 0 ? links.length - 1 : current - 1;
		return current;	
	}

	function move() {
		links.eq(this.className === 'prev' ? getPrev() : getNext()).trigger('click');
		return false;
	}
	
	function toggleEmail(override) {
		if (emailVisible || override === 1) {
			if ($('body').hasClass('page-template-buy-php')) {
				footer.hide();
			}		
		
			emailWrapper.hide();
			wide.show();
			details.show();
			hidden.hide();
			nav.fadeIn();
			controls.fadeIn();
			emailVisible = false;
		} else {
			hidden.show();
			nav.hide();
			wide.hide();
			details.hide();
			controls.hide();
			emailWrapper.show();
			footer.show();
			emailVisible = true;
		}
	}	

	function doSubmit() {
		var response;
		
		$.ajax({
			type 	: 'post',
			url		: ENDPOINT + '/ajax/email.php',
			data	: $(this).serialize(),
			dataType: 'json',
			success : function(data) {
				if (data && data.errors) {	
					response = data.errors;
					if (response.length) {
						$(response).each(function() {
							$('#' + this).show();
						});
					} else {
						$('.error').hide();
					}
				} else {
					emailForm.hide();
					emailThanks.show();
				}
			}, 
			complete: function() {

			}
		});
		
		return false;
	}
	

	$(document).ready(function () {
		details = $('.details');
		hidden = $('.hidden');
		nav = $('.nav, .links');
		wide = $('.wide');
		links = $('.links').find('a');
		arrows = $('.next, .prev');
		emailTrigger = $('.email');
		emailWrapper = $('#email_wrapper');
		controls = $('.controls');
		subnav = $('.more-of');
		footer = $('.footer');
		
		links.click(showImage);
		arrows.click(move);
		emailTrigger.click(toggleEmail);
		emailForm = $('form');
		emailThanks = $('#thanks');
		emailForm.submit(doSubmit);
		
		$('#submit_email').click(function () {
			emailForm.submit();
		});
		
		if (links) {
			links.eq(0).trigger('click');
		}
		
		$('img', wide).live('click', function () {
			links.eq(getNext()).trigger('click');
		});	

		(new Image()).src = ENDPOINT + '/images/stripes/yellow.png';
		(new Image()).src = ENDPOINT + '/images/stripes/orange.png';
		(new Image()).src = ENDPOINT + '/images/stripes/green.png';
		(new Image()).src = ENDPOINT + '/images/stripes/blue.png';								
		(new Image()).src = ENDPOINT + '/images/email_fire_2.gif';
		(new Image()).src = ENDPOINT + '/images/arrows/gray-left.png';	
		(new Image()).src = ENDPOINT + '/images/arrows/gray-right.png';		
	});

}());
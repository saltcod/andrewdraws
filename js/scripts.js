jQuery(function($) {

 		 


	$(window).load(function(){
		init();
	});


	function init() {
		var illustrations = $('#illustrations');
 		
 		illustrations.fadeIn();
 		$('#loader').fadeOut(700);

		filters = {};

		illustrations.imagesLoaded( function(){ 
			illustrations.isotope({
				itemSelector : '.post-thumbnail',
				transformsEnabled: false,
				masonry: {
					columnWidth: 165,
					gutterWidth: 20
				}
			});
		});
	}
	 

}); //Last


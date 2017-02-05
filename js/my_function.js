

// EXPOSE FUNCTIONS
$(function() {

	// expose the form when it's clicked or cursor is focused
	var form = $(".expose").bind("click keydown", function() {

		$(this).expose({

			// when exposing is done, change form's background color
			onLoad: function() {
				form.css({backgroundColor: '#b9d065'});
			},

			// when "unexposed", return to original background color
			onClose: function() {
				form.css({backgroundColor: null});
			}

		});
	});
});


$(document).ready(function() {
			
$("a.box").fancybox({
				'titleShow'		: true,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'titlePosition'	: 'over',
				 'overlayOpacity': '0.8',
				 'padding': 2, // optional
				  'overlayColor': '#000'
			});
			
			$("a[rel=group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
		});
		
		$("#vimeo_2").click(function() {
		$.fancybox({
			'autoScale'		: false,
	        'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'titlePosition'	: 'over',
				 'overlayOpacity': '0.8',
				 'padding': 5, // optional
				  'overlayColor': '#000',
			'title'			: this.title,
			'width'			: 630,
			'height'		: 360,
			'href'			: this.href.replace(new RegExp("([0-9])","i"),'moogaloop.swf?clip_id=$1'),
			'type'			: 'swf'
		});

		return false;
	});
			
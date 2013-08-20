/**
 * User: Green
 * Date: 2013/8/14
 * Time: 下午 3:33
 */

(function($)
{
	$(window).load(function(){
		var train = $('#top_nav_head');

		train.mouseover(function(){
			console.log('s');
			$('.train_jump').fadeOut().remove();
			var jump_1 = $('<div class="train_jump"></div>').append('聽').appendTo($(this)).hide();
			var jump_2 = $('<div class="train_jump"></div>').append('收').appendTo($(this)).hide();
			var jump_3 = $('<div class="train_jump"></div>').append('即').appendTo($(this)).hide();
			var jump_4 = $('<div class="train_jump"></div>').append('立').appendTo($(this)).hide();


			jump_1.fadeIn().animate({
				top: '-50' + 'px',
				left: '0' + 'px'
			});

			jump_2.fadeIn().animate({
				top: '-100' + 'px',
				left: '0' + 'px'
			});

			jump_3.fadeIn().animate({
				top: '-150' + 'px',
				left: '0' + 'px'
			});

			jump_4.fadeIn().animate({
				top: '-200' + 'px',
				left: '0' + 'px'
			});

		})
	});
})(jQuery);

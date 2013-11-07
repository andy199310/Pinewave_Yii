/**
 * User: Green
 * Date: 2013/8/14
 * Time: 下午 3:33
 */

(function($)
{
	$(window).load(function(){


        var status = 0;
        $('#listen_now').click(
            function(){
				switch(status){
					case 0:
						status = 1;
						MRP.play();
						$('#listen_now').css("background-image", "url(/file/img/main/player_pause.png)");
						break;
					case 1:
						status = 2;
						MRP.stop();
						$('#listen_now').css("background-image", "url(/file/img/main/player_play.png)");
						console.log('1');
						break;
					case 2:
						status = 1;
						MRP.play();
						$('#listen_now').css("background-image", "url(/file/img/main/player_pause.png)");
						console.log('2');
						break;
				}
            	console.log('hi');
            }
        );

		/*var train = $('#top_nav_head');

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

		})*/
	});
})(jQuery);

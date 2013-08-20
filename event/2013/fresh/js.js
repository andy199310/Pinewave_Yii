/**
 * User: Green
 * Date: 2013/8/14
 * Time: 下午 1:45
 */
(function($)
{
	$(window).load(function(){
		for(var i=1; i<6; i++){
			var button = $('#day' + i + '_right_down_1').attr('day', i);
			var target = $('#day' + i + '_right_up');
			var link = $('#day' + i + '_mid');

			if(data[i] == 'now'){
				button.mouseover(function(){
					$('.wait').fadeOut().remove();

					var tag = $('<div class="wait"></div>').append('直播中');
					tag.appendTo($(this)).fadeIn();
				}).mouseout(function(){
						console.log('s');
						$('.wait').fadeOut();
					});
			}else if(data[i] != undefined){
				button.click(function(){
					var i = $(this).attr('day');
					console.log(i);
					$('#player').remove();
					var player = $('<div id="player"></div>').html('<br><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="105" height="38" id="niftyPlayer1" align=""><param name=movie value="niftyplayer.swf?file=/file/program/'+data[i]+'.mp3&as=1"><param name=quality value=high><param name=bgcolor value=#FFFFFF><embed src="niftyplayer.swf?file=/file/program/'+data[i]+'.mp3&as=1" quality=high bgcolor=#FFFFFF width="165" height="38" name="niftyPlayer1" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>');
					player.css({
						left: '173px',
						top: '-23px',
						position: 'relative'
					});
					var target = $('#day' + i + '_right_up');
					player.appendTo(target);
				});
			}else{
				button.mouseover(function(){
					$('.wait').fadeOut().remove();

					var tag = $('<div class="wait"></div>').append('敬請期待');
					tag.appendTo($(this)).fadeIn();
				}).mouseout(function(){
						console.log('s');
						$('.wait').fadeOut();
					});
			}


			if(list[i] == 'over'){

				link.mouseover(function(){
					$('.wait_l').fadeOut().remove();

					var tag = $('<div class="wait_l"></div>').append('已截止');
					tag.appendTo($(this)).fadeIn();
				}).mouseout(function(){
						console.log('s');
						$('.wait_l').fadeOut();
					});

			}else if (list[i] != undefined){
				link.parent().attr('href', list[i]);
			}else{
				link.mouseover(function(){
					$('.wait_l').fadeOut().remove();

					var tag = $('<div class="wait_l"></div>').append('敬請期待');
					tag.appendTo($(this)).fadeIn();
				}).mouseout(function(){
						console.log('s');
						$('.wait_l').fadeOut();
					});
			}

		}
	});
})(jQuery);
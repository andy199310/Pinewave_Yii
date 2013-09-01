/**
 * User: Green
 * Date: 2013/8/13
 * Time: 上午 2:45
 */


(function($)
{
	$.schedule = function(){
		console.log($('#next_month').html());
		$("#next_month").click(function(){
			console.log('hi');
			var dataTag = $('#schedule_month');
			var year = parseInt(dataTag.attr('y'));
			var month = parseInt(dataTag.attr('m'));

			if(month >= 12){
				year += 1;
				month = 1;
			}else{
				month += 1;
			}

			dataTag.attr('y', year);
			dataTag.attr('m', month);
			$('#schedule_date').text(month);

			$.post('/index.php/ajaxSchedule', 'y=' + year + '&m=' + month, recieveData);
		});

		$("#previous_month").click(function(){
			var dataTag = $('#schedule_month');
			var year = parseInt(dataTag.attr('y'));
			var month = parseInt(dataTag.attr('m'));


			if(month <= 1){
				month = 12;
				year -= 1;
			}else{
				month -= 1;
			}

			dataTag.attr('y', year);
			dataTag.attr('m', month);
			$('#schedule_date').text(month);
			$.post('/index.php/ajaxSchedule', 'y=' + year + '&m=' + month, recieveData);
		});

		function recieveData(data){
			var element = $('#schedule');

			element.fadeOut('slow', function(){
				element.html(data);
				element.fadeIn();
			});

		}
	};
})(jQuery);

(function($)
{
	$(window).load(function(){
		$.schedule();
	});
})(jQuery);
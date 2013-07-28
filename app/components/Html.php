<?php
class Html extends CHtml{
	public static function headImgButton($name){
		$bUrl = Yii::app()->request->baseUrl;
		$imgPath = $bUrl.'/file/img/main/'.$name.'.png';


		$imgTag = CHtml::tag('img', array(
			'src' => $imgPath,
			'class' => 'top_nav_word',
		), '', false);

//		$carTag = CHtml::tag('div', array(
//			'src' => $carPath,
//			'class' => 'top_nav_car',
//		));

		$link = CHtml::tag('a',array(
			'href' => $bUrl.'/index.php/'.$name.'',
		),$imgTag,true);

		$div = CHtml::tag('div', array(
			'class' => 'top_nav_item',
		), $link);

		return $div;
	}

	public static function blockHead($id='',$display='none'){
		$head=
			CHtml::tag('div',array(
					'class'	=>'cnt_warpped',
					'id'	=>$id.'_warpped',
				),
				'',false).
			CHtml::tag('div',array(
					'class'	=>'cnt_head',
					'id'	=>$id.'_head',
					'style'	=>'display:'.$display.';'
				),
				'',true).
			CHtml::tag('div',array(
					'class'	=>'cnt_body',
					'id'	=>$id.'_body',
					'style'	=>'display:'.$display.';'
				),
				'',false);
		return $head;
	}

}
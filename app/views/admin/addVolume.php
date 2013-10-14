<div class="form">
	<?php $form = $this->beginWidget('CActiveForm'); ?>

	<?=$form->errorSummary($model)?>

	<div class="row">
		<?=$form->label($model, 'count') ?>
		<?=$form->textField($model,'count', array('value' => $model->count('`pid` = :pid', array(':pid' => $pid)))) ?>
		<?=$form->error($model,'count') ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'datetime'); ?>

		<?php $this->widget('application.extensions.CJuiDateTimePicker', array(
			'model'=>$scheduleModel,
			'attribute'=>'datetime',
			'mode'=>'datetime',
			'options'=>array(
//				'showAnim'=>'fold',
				'dateDormat'=>'yyyy-MM-dd',
				'timeFormat'=>'hh:mm:ss',
				'showSecond'=>true,
//				'changeMonth'=>true,
//				'changeYear'=>true,
//				'yearRange'=>'2013:2020',
				'defaultDate'=>'now',
			),
			'htmlOptions'=>array('onClick'=>"$('#ui-datepicker-div').css('z-index', '20');"), // fix datepicker so it's always on top
		)); ?>
		<?php echo $form->error($model,'datetime'); ?>
	</div>

<!--	<div class="row">-->
<!--		--><?php //echo $form->labelEx($model,'replay_datetime'); ?>
<!---->
<!--		--><?php //$this->widget('zii.widgets.jui.CJuiDatePicker', array(
//			'model'=>$model,
//			'attribute'=>'replay_datetime',
//			'options'=>array(
//				'showAnim'=>'fold',
//				'dateFormat'=>'yy-mm-dd ',
//				'changeMonth'=>true,
//				'changeYear'=>true,
//				'yearRange'=>'2013:2020',
//				'defaultDate'=>'2013-09-01'
//			),
//			'htmlOptions'=>array(
//				'readonly'=>'true',
//				'onFocus'=>'this.blur()',
//			),
//		)); ?>
<!--		--><?php //echo $form->error($model,'replay_datetime'); ?>
<!--	</div>-->

	<div class="row submit">
		<?=CHtml::submitButton('送出') ?>
	</div>


	<?php $this->endWidget(); ?>
</div>
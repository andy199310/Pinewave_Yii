<div class="form">
	<?php $form = $this->beginWidget('CActiveForm'); ?>

	<?=$form->errorSummary($model)?>

	<div class="row">
		<?=$form->label($model, 'class') ?>
		<?=$form->dropDownList($model,'class',CHtml::listData($model->programClassIdArray(),'id','name')) ?>
		<?=$form->error($model,'class') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'name') ?>
		<?=$form->textField($model, 'name') ?>
		<?=$form->error($model, 'name') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'dj') ?>
		<?=$form->textField($model, 'dj') ?>
		<?=$form->error($model, 'dj') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'introduction') ?>
		<?php
		$this->widget('application.extensions.ETinyMce',
			array(
				'model' => $model,
				'name' => 'introduction',
				'attribute' => 'introduction',
				'editorTemplate' => 'full',
			));
		?>
		<?=$form->error($model, 'introduction') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'simple_intro') ?>
		<?=$form->textArea($model, 'simple_intro') ?>
		<?=$form->error($model, 'simple_intro') ?>
	</div>

	<div class="row submit">
		<?=CHtml::submitButton('送出') ?>
	</div>


	<?php $this->endWidget(); ?>
</div>

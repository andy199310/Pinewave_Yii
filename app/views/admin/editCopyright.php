現正編輯版權清單： <br>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm'); ?>

	<?=$form->errorSummary($model)?>

	<div class="row">
		<?=$form->label($model, 'name') ?>
		<?=$form->textField($model, 'name') ?>
		<?=$form->error($model, 'name') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'singer') ?>
		<?=$form->textField($model, 'singer') ?>
		<?=$form->error($model, 'singer') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'lyricist') ?>
		<?=$form->textField($model, 'lyricist') ?>
		<?=$form->error($model, 'lyricist') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'composer') ?>
		<?=$form->textField($model, 'composer') ?>
		<?=$form->error($model, 'composer') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'arranger') ?>
		<?=$form->textField($model, 'arranger') ?>
		<?=$form->error($model, 'arranger') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'company') ?>
		<?=$form->textField($model, 'company') ?>
		<?=$form->error($model, 'company') ?>
	</div>

	<div class="row">
		<?=$form->label($model, 'playCount') ?>
		<?=$form->textField($model, 'playCount') ?>
		<?=$form->error($model, 'playCount') ?>
	</div>


	<div class="row submit">
		<?=CHtml::submitButton('送出') ?>
	</div>


	<?php $this->endWidget(); ?>
</div>

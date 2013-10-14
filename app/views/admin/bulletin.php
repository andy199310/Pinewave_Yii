製作中的公告YA

<?php
/**
 * User: Green
 * Date: 2013/9/2
 * Time: 下午 12:50
 */
?>
<div class="form">
	<?php $form = $this->beginWidget('CActiveForm'); ?>

<?=$form->errorSummary($bulletinModel)?>

<div class="row">
	<?=$form->label($bulletinModel, 'author') ?>
	<?=$form->textField($bulletinModel, 'author', array('value'=>'pinewave')) ?>
	<?=$form->error($bulletinModel, 'author') ?>
</div>

<div class="row">
	<?=$form->label($bulletinModel, 'title') ?>
	<?=$form->textField($bulletinModel, 'title') ?>
	<?=$form->error($bulletinModel, 'title') ?>
</div>

<div class="row">
	<?=$form->label($bulletinModel, 'content') ?>
	<?php
	$this->widget('application.extensions.ETinyMce',
		array(
			'model' => $bulletinModel,
			'name' => 'content',
			'attribute' => 'content',
			'editorTemplate' => 'full',
		));
	?>
	<?=$form->error($bulletinModel, 'content') ?>
</div>

<div class="row submit">
	<?=CHtml::submitButton('送出') ?>
</div>


<?php $this->endWidget(); ?>
</div>

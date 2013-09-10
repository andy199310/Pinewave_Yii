<?php
/**
 * User: Green
 * Date: 2013/9/4
 * Time: 下午 6:20
 */

$form = $this->beginWidget(
	'CActiveForm',
	array(
		'id' => 'upload-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)
);
// ...
echo $form->labelEx($model, 'file');
echo $form->fileField($model, 'file');
echo $form->error($model, 'file');
// ...
?>
<div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php
$this->endWidget();
<?php
/**
 * User: Green
 * Date: 2013/9/26
 * Time: 上午 2:47
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
		<?php echo CHtml::submitButton($model->isNewRecord ? '上傳' : '修改'); ?>
	</div>
<?php
$this->endWidget();
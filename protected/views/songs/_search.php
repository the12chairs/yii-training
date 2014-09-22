<?php
/* @var $this SongsController */
/* @var $model Songs */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'band_id'); ?>
		<?php echo $form->textField($model,'band_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('common','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
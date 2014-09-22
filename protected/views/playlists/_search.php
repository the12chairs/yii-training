<?php
/* @var $this PlaylistsController */
/* @var $model Playlists */
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
		<?php echo $form->label($model,Yii::t('users', 'Email')); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'song_id'); ?>
		<?php echo $form->textField($model,'song_id'); ?>
	</div>

	<div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('common','Search')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
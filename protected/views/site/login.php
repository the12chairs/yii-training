<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('users', 'Login'),
        ))
);

$this->pageTitle=Yii::app()->name . ' - Login';
?>

<h1><?php echo Yii::t('users', 'Login'); ?></h1>

<p><?php echo Yii::t('users', 'Please fill out the following form with your login credentials:');?></p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model, Yii::t('users', 'Email')); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,Yii::t('users', 'Password')); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,Yii::t('users', 'rememberMe')); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo TbHtml::submitButton(Yii::t('users', 'Login')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

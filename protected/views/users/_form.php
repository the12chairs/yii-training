<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id'=>'users-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <fieldset>


        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'login'); ?>
            <?php echo $form->textField($model,'login',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'login'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>



        <div class="row">
            <?php echo $form->labelEx($model,'role'); ?>
            <?php echo TbHtml::dropDownList('role', '', array('administrator' => 'administrator', 'user' => 'user'), array('span' => 1)); ?>

            <?php echo $form->error($model,'role'); ?>
        </div>
    </fieldset>
    <div class="row buttons">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
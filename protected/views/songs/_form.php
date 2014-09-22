<?php
/* @var $this SongsController */
/* @var $model Songs */
/* @var $form CActiveForm */
?>

<div class="form">




    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id'=>'songs-form',
        'enableAjaxValidation'=>false,
    )); ?>
    <fieldset>


        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'band_id'); ?>
            <?php echo $form->textField($model,'band_id'); ?>
            <?php echo $form->error($model,'band_id'); ?>
        </div>


    </fieldset>

    <div class="row buttons">
        <?php echo TbHtml::submitButton($model->isNewRecord ? Yii::t('common', 'Create') : Yii::t('common', 'Save')); ?>
    </div>


    <?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this PlaylistsController */
/* @var $model Playlists */
/* @var $form CActiveForm */
?>

<div class="form">


    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'layout' => TbHtml::FORM_LAYOUT_HORIZONTAL,
        'id'=>'playlists-form',
        'enableAjaxValidation'=>false,
    )); ?>

    <fieldset>
        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'user_id'); ?>
            <?php echo $form->textField($model,'user_id'); ?>
            <?php echo $form->error($model,'user_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'song_id'); ?>
            <?php echo $form->textField($model,'song_id'); ?>
            <?php echo $form->error($model,'song_id'); ?>
        </div>

    </fieldset>

    <div class="row buttons">
        <?php echo TbHtml::submitButton($model->isNewRecord ?  Yii::t('common', 'Create') : Yii::t('common', 'Save')); ?>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
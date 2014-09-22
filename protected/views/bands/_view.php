<?php
/* @var $this BandsController */
/* @var $data Bands */
?>

<div class="view">

    <?php if(Yii::app()->user->isAdmin()): ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
        <br />
    <?php endif; ?>


	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

    <b><?php echo Yii::t('bands', 'Total songs:');?>:</b>
    <?php echo $data->songsCount; ?>
    <br />

</div>
<?php
/* @var $this PlaylistsController */
/* @var $data Playlists */
?>

<div class="view">

    <?php if(Yii::app()->user->isAdmin()): ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
        <br />
    <?php endif; ?>

    <b><?php echo Yii::t('bands', 'Band');?>:</b>
    <?php echo $data->song->band->name; ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('song_id')); ?>:</b>
	<?php echo CHtml::encode($data['song']->title); ?>
	<br />



    <?php echo CHtml::link(Yii::t('songs', 'Remove'),array('removeSong',
        'entity' => $data->id,
        ));
    ?>

</div>
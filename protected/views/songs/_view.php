<?php
/* @var $this SongsController */
/* @var $data Songs */
?>

<div class="view">

    <?php if(Yii::app()->user->isAdmin()): ?>
        <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
        <br />
    <?php endif; ?>


	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

    <?php
	/*
    <b><?php echo CHtml::encode($data->getAttributeLabel('band_id')); ?>:</b>
	<?php echo CHtml::encode($data->band_id); ?>
    ?>
	*/
    ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('band_id')); ?>:</b>
    <?php echo $data['band']['name']; ?>
	<br />
    <b><?php echo Yii::t('genres', 'Genres');?>:</b>
    <?php
        foreach($data['genres'] as $genre)
            echo $genre['name'] .' ';
    ?>
    <br />

    <?php
        if(Yii::app()->user->isAdmin())
        {
            echo  CHtml::link(Yii::t('songs', 'Add Genre'), array('addGenre', 'id' => $data->id));
            echo  CHtml::link(Yii::t('songs', 'To playlist'), array('addToPlaylist', 'id' => $data->id));
        }
    else
    {
        echo  CHtml::link(Yii::t('songs', 'To playlist'), array('addToPlaylist', 'id' => $data->id));
    }
    ?>


</div>
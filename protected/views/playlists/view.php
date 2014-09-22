<?php
/* @var $this PlaylistsController */
/* @var $model Playlists */



$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('playlists', 'Playlists')=>array('index'),
            $model->id,
        ))
);


$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('playlists', 'List Playlists'), 'url'=>array('index')),
        array('label'=>Yii::t('playlists', 'Create Playlist'), 'url'=>array('create')),
        array('label'=>Yii::t('playlists', 'Update Playlist'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('playlists', 'Delete Playlist'), 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array(
                'delete',
                'id'=>$model->id),
            'confirm'=>
                Yii::t('common',
                    'Are you sure you want to delete this item?'))),
        array('label'=>Yii::t('playlists', 'Manage Playlists'), 'url'=>array('admin')),
    )
));

?>

<h1><?php echo Yii::t('playlists', 'View Playlist'); ?> #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'song_id',
	),
)); ?>

<?php
/* @var $this PlaylistsController */
/* @var $model Playlists */




$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('playlists', 'Playlists')=>array('index'),
            $model->id=>array('view','id'=>$model->id),
            Yii::t('common', 'Update'),
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('playlists', 'List Playlists'), 'url'=>array('index')),
        array('label'=>Yii::t('playlists', 'Create Playlist'), 'url'=>array('create')),
        array('label'=>Yii::t('playlists', 'View Playlist'), 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>Yii::t('playlists', 'Manage Playlists'), 'url'=>array('admin')),
    )
));
?>
<h1><?php echo Yii::t('playlists','Update Playlist'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
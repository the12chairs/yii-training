<?php
/* @var $this PlaylistsController */
/* @var $dataProvider CActiveDataProvider */



$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('playlists', 'Playlist'),
        ))
);

if(Yii::app()->user->isAdmin())
{
    $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
        'items' => array(
            array('label' => Yii::t('common','Operations')),
            TbHtml::menuDivider(),
            array('label'=>Yii::t('playlists', 'Create Playlist'), 'url'=>array('create')),
            array('label'=>Yii::t('playlists', 'Manage Playlists'), 'url'=>array('admin')),
        )
    ));
}
?>
<h1><?php echo Yii::t('playlists', 'Playlist'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

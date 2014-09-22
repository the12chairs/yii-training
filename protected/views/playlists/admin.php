<?php
/* @var $this PlaylistsController */
/* @var $model Playlists */




$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('playlists', 'Playlists')=>array('index'),
            Yii::t('common', 'Manage'),
        ))
);


$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('playlists', 'List Playlists'), 'url'=>array('index')),
        array('label'=>Yii::t('playlists', 'Create Playlist'), 'url'=>array('create')),
    )
));


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#playlists-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('playlists', 'Manage Playlists'); ?></h1>


<?php echo CHtml::link(Yii::t('common', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'playlists-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{items}",
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'id',
            'header' => 'id',
            'htmlOptions' => array('color' =>'width: 60px'),
            'filter' => CHtml::activeTextField($model, 'id'),
        ),
        array(
            'name'=> 'usr.email',
            'header' => Yii::t('users', 'Email'),
            'filter' => CHtml::activeTextField($model, 'user_id'),
        ),
        array(
            'name'=> 'song.title',
            'header' => Yii::t('songs', 'Title'),
            'filter' => CHtml::activeTextField($model, 'song_id'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>


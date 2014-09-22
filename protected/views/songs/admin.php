<?php
/* @var $this SongsController */
/* @var $model Songs */



$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('songs', 'Songs')=>array('index'),
            Yii::t('common', 'Manage'),
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('songs', 'List Songs'), 'url'=>array('index')),
        array('label'=>Yii::t('songs', 'Create Song'), 'url'=>array('create')),
    )
));


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#songs-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('songs', 'Manage Songs'); ?></h1>



<?php echo CHtml::link(Yii::t('common', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'songs-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{items}",
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'id',
            'header' => 'id',
            'htmlOptions' => array('color' =>'width: 60px'),
        ),
        array(
            'name'=> 'title',
            'header' => Yii::t('title', Yii::t('songs', 'Title')),
            'filter' => CHtml::activeTextField($model, 'title'),
        ),
        array(
            'name'=> 'band.name',
            'header' => Yii::t('bands', 'Name'),
            'filter' => CHtml::activeTextField($model, 'band_id'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>



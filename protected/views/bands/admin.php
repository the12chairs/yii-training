<?php
/* @var $this BandsController */
/* @var $model Bands */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('bands','Bands')=>array('index'),
            Yii::t('common', 'Manage'),
        ))
);


$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('bands', 'List Bands'), 'url'=>array('index')),
        array('label'=>Yii::t('bands', 'Create Band'), 'url'=>array('create')),
    )
));


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bands-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('bands', 'Manage Bands'); ?></h1>



<?php echo CHtml::link(Yii::t('common', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'bands-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{items}",
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'id',
            'header' => 'id',
            'filter' => CHtml::activeTextField($model, 'id'),
        ),
        array(
            'name'=> 'name',
            'header' => Yii::t('bands', 'Name'),
            'filter' => CHtml::activeTextField($model, 'name'),
        ),

        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>


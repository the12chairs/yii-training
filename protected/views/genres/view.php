<?php
/* @var $this GenresController */
/* @var $model Genres */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array (
        Yii::t('genres', 'Genres')=>array('index'),
        $model->name,
    ),

));

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('genres', 'List Genres'), 'url'=>array('index')),
        array('label'=>Yii::t('genres', 'Create Genre'), 'url'=>array('create')),
        array('label'=>Yii::t('genres', 'Update Genre'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('genres', 'Delete Genre'), 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array(
                'delete',
                'id'=>$model->id),
            'confirm'=>
                Yii::t('common',
                    'Are you sure you want to delete this item?'))),
        array('label'=>Yii::t('genres', 'Manage Genres'), 'url'=>array('admin')),
    )
));
?>

<h1><?php echo Yii::t('genres', 'View Genre') ?> #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>

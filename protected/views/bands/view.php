<?php
/* @var $this BandsController */
/* @var $model Bands */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('bands', 'Bands')=>array('index'),
            $model->name,
        ))
);



$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('bands', 'List Bands'), 'url'=>array('index')),
        array('label'=>Yii::t('bands', 'Create Band'), 'url'=>array('create')),
        array('label'=>Yii::t('bands', 'Update Band'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('bands', 'Delete Band'), 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array(
                'delete',
                'id'=>$model->id),
            'confirm'=>
                Yii::t('common',
                    'Are you sure you want to delete this item?'))),
        array('label'=>Yii::t('bands', 'Manage Bands'), 'url'=>array('admin')),
    )
));
?>

<h1><?php echo Yii::t('bands', 'View Band'); ?> "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
));
?>

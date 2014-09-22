<?php
/* @var $this SongsController */
/* @var $model Songs */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('songs', 'Songs')=>array('index'),
            $model->title,
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('songs', 'List Songs'), 'url'=>array('index')),
        array('label'=>Yii::t('songs', 'Create Song'), 'url'=>array('create')),
        array('label'=>Yii::t('songs', 'Update Song'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('songs', 'Delete Song'), 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array(
                'delete',
                'id'=>$model->id),
            'confirm'=>
                Yii::t('common',
                    'Are you sure you want to delete this item?'))),
        array('label'=>Yii::t('songs', 'Manage Songs'), 'url'=>array('admin')),
    )
));
?>

<h1><?php echo Yii::t('songs', 'View Song'); ?> "<?php echo $model->title; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'band_id',
	),
)); ?>

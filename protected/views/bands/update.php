<?php
/* @var $this BandsController */
/* @var $model Bands */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('bands', 'Bands')=>array('index'),
            $model->name=>array('view','id'=>$model->id),
            Yii::t('common', 'Update'),
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('bands', 'List Bands'), 'url'=>array('index')),
        array('label'=>Yii::t('bands', 'Create Band'), 'url'=>array('create')),
        array('label'=>Yii::t('bands', 'View Band'), 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>Yii::t('bands', 'Manage Bands'), 'url'=>array('admin')),
    )
));
?>


<h1><?php echo Yii::t('bands', 'Update Band'); ?> "<?php echo $model->name; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
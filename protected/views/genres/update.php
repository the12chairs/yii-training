<?php
/* @var $this GenresController */
/* @var $model Genres */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('genres', 'Genres')=>array('index'),
            $model->name=>array('view','id'=>$model->id),
            Yii::t('common', 'Update'),
        ))
);


$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('genres', 'List Genres'), 'url'=>array('index')),
        array('label'=>Yii::t('genres', 'Create Genre'), 'url'=>array('create')),
        array('label'=>Yii::t('genres', 'View Genre'), 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>Yii::t('genres', 'Manage Genres'), 'url'=>array('admin')),
    )
));

?>

<h1><?php echo Yii::t('genres', 'Update Genre'); ?> <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
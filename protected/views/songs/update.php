<?php
/* @var $this SongsController */
/* @var $model Songs */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('songs','Songs')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yii::t('common', 'Update'),
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('songs', 'List Songs'), 'url'=>array('index')),
        array('label'=>Yii::t('songs', 'Create Song'), 'url'=>array('create')),
        array('label'=>Yii::t('songs', 'View Song'), 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>Yii::t('songs', 'Manage Songs'), 'url'=>array('admin')),
    )
));

?>

<h1><?php echo Yii::t('songs', 'Update Song'); ?> <?php echo $model->title; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
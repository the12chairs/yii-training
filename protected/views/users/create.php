<?php
/* @var $this UsersController */
/* @var $model Users */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('users', 'Users')=>array('index'),
            Yii::t('common', 'Create'),
        ))
);



$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
        array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
    )
));
?>

<h1><?php echo Yii::t('users', 'Create User'); ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
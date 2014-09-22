<?php
/* @var $this UsersController */
/* @var $model Users */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('users', 'Users')=>array('index'),
            $model->login=>array('view','id'=>$model->id),
            Yii::t('users', 'Update'),
        ))
);

$this->menu=array(
	array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
	array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
	array('label'=>Yii::t('users', 'View User'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('users', 'Update User'); ?> <?php echo $model->login; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
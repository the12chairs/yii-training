<?php
/* @var $this UsersController */
/* @var $model Users */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('users', 'Users')=>array('index'),
            $model->login,
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
        array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
        array('label'=>Yii::t('users', 'Update User'), 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>Yii::t('users', 'Delete User'), 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array(
                'delete',
                'id'=>$model->id),
            'confirm'=>
                Yii::t('common',
                    'Are you sure you want to delete this item?'))),
        array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
    )
));
?>

<h1><?php echo Yii::t('users', 'View User'); ?> <?php echo $model->login; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'email',
		'password',
		'role',
	),
)); ?>

<?php
/* @var $this UsersController */
/* @var $model Users */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('users', 'Users')=>array('index'),
            Yii::t('common', 'Manage'),
        ))
);

$this->widget('bootstrap.widgets.TbNav', array(
    'type' => TbHtml::NAV_TYPE_LIST,
    'items' => array(
        array('label' => Yii::t('common','Operations')),
        TbHtml::menuDivider(),
        array('label'=>Yii::t('users', 'List Users'), 'url'=>array('index')),
        array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
    )
));



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('users', 'Manage Users'); ?></h1>



<?php echo CHtml::link(Yii::t('common', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'users-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'template' => "{items}",
    'type' => TbHtml::GRID_TYPE_STRIPED,
    'columns' => array(
        array(
            'name' => 'id',
            'header' => 'id',
            'htmlOptions' => array('color' =>'width: 60px'),
        ),
        array(
            'name'=> 'login',
            'header' => Yii::t('login', Yii::t('users', Yii::t('users', 'Login'))),
            'filter' => CHtml::activeTextField($model, 'login'),
        ),
        array(
            'name'=> 'email',
            'header' => Yii::t('email', Yii::t('users', Yii::t('users', 'Email'))),
            'filter' => CHtml::activeTextField($model, 'email'),
        ),
        array(
            'name'=> 'password',
            'header' => Yii::t('password', Yii::t('users', Yii::t('users', 'Password'))),
            'filter' => CHtml::activeTextField($model, 'password'),
        ),
        array(
            'name'=> 'role',
            'header' => Yii::t('role', Yii::t('users', Yii::t('users', 'Role'))),
            'filter' => CHtml::activeTextField($model, 'role'),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>



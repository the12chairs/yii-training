<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('users', 'Users'),
        ))
);


if(Yii::app()->user->isAdmin())
{
    $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
        'items' => array(
            array('label' => Yii::t('common','Operations')),
            TbHtml::menuDivider(),
            array('label'=>Yii::t('users', 'Create User'), 'url'=>array('create')),
            array('label'=>Yii::t('users', 'Manage Users'), 'url'=>array('admin')),
        )
    ));
}

?>

<h1><?php echo Yii::t('users', 'Users'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

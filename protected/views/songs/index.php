<?php
/* @var $this SongsController */
/* @var $dataProvider CActiveDataProvider */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('songs', 'Songs'),
        ))
);

if(Yii::app()->user->isAdmin())
{
    $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
        'items' => array(
            array('label' => Yii::t('common','Operations')),
            TbHtml::menuDivider(),
            array('label'=>Yii::t('songs', 'Create Song'), 'url'=>array('create')),
            array('label'=>Yii::t('songs', 'Manage Songs'), 'url'=>array('admin')),
        )
    ));
}

?>

<h1><?php echo Yii::t('songs', 'Songs'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

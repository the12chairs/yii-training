<?php
/* @var $this BandsController */
/* @var $dataProvider CActiveDataProvider */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('bands', 'Bands'),
        ))
);

if(Yii::app()->user->isAdmin())
{
    $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
        'items' => array(
            array('label' => Yii::t('common','Operations')),
            TbHtml::menuDivider(),
            array('label'=>Yii::t('bands', 'Create Band'), 'url'=>array('create')),
            array('label'=>Yii::t('bands', 'Manage Bands'), 'url'=>array('admin')),
        )
    ));
}
?>

<h1><?php echo Yii::t('bands', 'Bands'); ?> </h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

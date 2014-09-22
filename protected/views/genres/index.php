<?php
/* @var $this GenresController */
/* @var $dataProvider CActiveDataProvider */


$this->widget('bootstrap.widgets.TbBreadcrumb', array(
        'links' => array(
            Yii::t('genres', 'Genres'),
        ))
);

if(Yii::app()->user->isAdmin())
{
    $this->widget('bootstrap.widgets.TbNav', array(
        'type' => TbHtml::NAV_TYPE_LIST,
        'items' => array(
            array('label' => Yii::t('common','Operations')),
            TbHtml::menuDivider(),
            array('label'=>Yii::t('genres', 'Create Genre'), 'url'=>array('create')),
            array('label'=>Yii::t('genres', 'Manage Genres'), 'url'=>array('admin')),
        )
    ));
}
?>


<h1><?php echo Yii::t('genres', 'Genres'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

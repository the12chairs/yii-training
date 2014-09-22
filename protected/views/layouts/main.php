<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/build/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/build/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/build/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/build/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/build/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <?php Yii::app()->bootstrap->register(); ?>

</head>

<body>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('main', 'Home'), 'url'=>array('/site/index')),
                array('label'=>Yii::t('main', 'Users'), 'url'=>array('/users/index'), 'visible'=>Yii::app()->user->isAdmin()),
                array('label'=>Yii::t('main', 'My playlist'), 'url'=>array('/playlists/index'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('main', 'Genres'), 'url'=>array('/genres/index'), 'visible'=>Yii::app()->user->isAdmin()),
                array('label'=>Yii::t('main', 'Songs'), 'url'=>array('/songs/index')),
                array('label'=>Yii::t('main', 'Bands'), 'url'=>array('/bands/index')),
				array('label'=>Yii::t('main', 'Login'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('main', 'Logout') .'('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('main', 'ru'), 'url'=>array('/site/setLang?lang=ru')),
                array('label'=>Yii::t('main', 'en'), 'url'=>array('/site/setLang?lang=en')),
            ),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
    </div><!-- page -->
    <?php $this->widget('ext.hoauth.widgets.HOAuth'); ?>
        <?php echo Yii::t('main', 'All Rights Reserved.'); ?>
        <br/>
		<?php echo Yii::powered(); ?>

	</div><!-- footer -->


</body>
</html>

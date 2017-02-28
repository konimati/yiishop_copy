<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Strona Główna', 'url'=>array('/sklep/index')),
				array('label'=>'Kategorie', 'url'=>array('/sklep/kategorie')),
				array('label'=>'Rejestracja', 'url'=>array('/sklep/rejestracja')),
				array('label'=>'Logowanie', 'url'=>array('/logowanie')),
				array('label'=>'Logowanie2', 'url'=>array('/sklep/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/sklep/logout'), 'visible'=>!Yii::app()->user->isGuest)
				//array('label'=>'Wyloguj', 'url'=>array('/zaloguj/wyloguj')),
			),
		));*/ 
			if (Yii::app()->user->isGuest) {
                    $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                            	array('label'=>'Strona Główna', 'url'=>array('/sklep/index')),
                            	array('label'=>'Kategorie', 'url'=>array('/sklep/kategorie')),
                            	array('label'=>'Rejestracja', 'url'=>array('/sklep/register')),
								array('label'=>'Login', 'url'=>array('/sklep/login')),
                            ),
                        )); 
            } else {
                   	$this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                            	array('label'=>'Strona Główna', 'url'=>array('/sklep/index')),
                            	array('label'=>'Edycja konta', 'url'=>array('/users/index')),
                            	array('label'=>'Dodaj produkt', 'url'=>array('/admin/dodaj'), 'visible'=>Yii::app()->user->getState('admin')),
								array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/sklep/logout'))
                            ),
                        ));                     
            }
		?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

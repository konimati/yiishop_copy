<?php

class AdminController extends Controller
{
	public function actionIndex()
	{
		if(Yii::app()->session['zalogowany'] != 'tak' || Yii::app()->user->getState('admin') != '1')
        {
            $this->redirect(array('sklep/index'));
        }
		$this->pageTitle = 'Konto Admina';
		

        $this->render('index',
        	array(
        		// 'DaneAdresy' => $DaneAdresy,
        		// 'model' => $AdresModel,
        		)
        	);
	}
	public function actionDodaj()
	{
		if(Yii::app()->session['zalogowany'] != 'tak' || Yii::app()->user->getState('admin') != '1')
        {
            $this->redirect(array('sklep/index'));
        }
        $this->pageTitle = 'Konto Admina - Dodaj produkt';

        $model = new ProduktyModel;
        $DaneProdukty = $model -> PobierzProduktyBezObrazka();

        if(isset($_POST['ProduktyModel']))
		{
			$model->attributes=$_POST['ProduktyModel'];
			$model->produkt_data_dodania= date("Y-m-d H:i:s"); 
			// validate user input and redirect to the previous page if valid
			if($model->validate())
        	{
        		
        	    if($model->DodajProdukt())
        		{
        			$this->redirect(array('sklep/index'));
        		}
            	return;
        	}
				
		}
		// display the login form
		$this->render('dodaj',
			array(
				'model'=>$model,
				'DaneProdukty'=>$DaneProdukty,

				));
	}
	// public function actions()
	// {
	// 	// captcha action renders the CAPTCHA image displayed on the contact page
	// 	return array(
	// 		'captcha'=>array(
	// 			'class'=>'CCaptchaAction',
	// 			'backColor'=>0xFFFFFF,
	// 		),
	// 		'page'=>array(
	// 			'class'=>'CViewAction',
	// 		),
	// 	);
	// }
	//rejestracja
	// public function actionIndex()
	// {
	// 	$model=new Users;

 //    	// if(isset($_POST['ajax']) && $_POST['ajax']==='users-index-form')
 //    	// {
 //     //    	echo CActiveForm::validate($model);
 //     //    	Yii::app()->end();
 //    	// }

 //    	if(isset($_POST['Users']))
 //    	{
 //        	$model->attributes=$_POST['Users'];
 //        	$model->data_dodania= date("Y-m-d H:i:s"); 
 //        	$model->admin= 0;        	
 //        	if($model->validate())
 //        	{
 //        		if($model->passHash())
 //        		{
 //        			if($model->DodajUzytkownika())
 //        			{
 //        				$this->redirect(array('sklep/login'));
 //        			}
 //        		}
 //            	return;
 //        	}
 //    	}
 //    	$this->render('index',array('model'=>$model));
		
	// }

}
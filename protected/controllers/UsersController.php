<?php

class UsersController extends Controller
{
	public function actionIndex()
	{
		if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('sklep/index'));
        }
		$this->pageTitle = 'Edytuj Konto';
		$AdresModel = new AdresModel;
		$AdresModel->idUser = Yii::app()->user->id;
        $DaneAdresy = $AdresModel->WybierzAdresUzytkownika();

        //var_dump($DaneAdresy); exit();
        //$Strony = new CPagination(intval($IloscProduktow));
        //$Strony->pageSize = 3;

        //$DaneProduktow = $ProduktyModel->WybierzProdukty($Strony->pageSize, $Strony->currentPage);

        if(isset($_POST['AdresModel']))
    	{
    		//print_r($_POST['AdresModel']);exit();
    		if(empty($DaneAdresy))
    		{	
    			$AdresModel->attributes=$_POST['AdresModel'];
    			if($AdresModel->validate())
    			{
    				if(isset($_POST['AdresModel']['nr_lokalu']))
	    			{
	    				$AdresModel->nr_lokalu = $_POST['AdresModel']['nr_lokalu'];
	    			}
    				if($AdresModel->DodajAdresUzytkownika())
	        		{
	        			$this->redirect(array('users/index'));
	        		}
    			}
    		}
    		else
    		{
    			
    			$AdresModel->attributes=$_POST['AdresModel'];

    			if($AdresModel->validate())
    			{
    				if(isset($_POST['AdresModel']['nr_lokalu']))
	    			{
	    				$AdresModel->nr_lokalu = $_POST['AdresModel']['nr_lokalu'];
	    			}
    				if($AdresModel->AktualizujAdres())
	        		{
	        			$this->redirect(array('users/index'));
	        		}
    			}
    		}   

            return;
    	}

        $this->render('index',
        	array(
        		'DaneAdresy' => $DaneAdresy,
        		'model' => $AdresModel,
        		)
        	);
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
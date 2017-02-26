<?php

class SklepController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->pageTitle = 'Strona Główna';
        $ProduktyModel = new ProduktyModel;
        $IloscProduktow = $ProduktyModel->LiczWszystkieProdukty();

        $Strony = new CPagination(intval($IloscProduktow));
        $Strony->pageSize = 3;

        $DaneProduktow = $ProduktyModel->WybierzProdukty($Strony->pageSize, $Strony->currentPage);


        $this->render('index',
        	array(
        		'DaneProduktow' => $DaneProduktow,
        		'Strony' => $Strony,
        		)
        	);
	}
	public function actionProdukt($id)
	{
		if(!is_numeric($id))
    	{
    		exit();
    	}  	

        $ProduktyModel = new ProduktyModel;
        $SmakiModel = new SmakiModel;
        $WybranyProdukt = $ProduktyModel->WybierzProdukt($id);
        $WybranySmakProduktu = $SmakiModel->WybierzSmakProduktu($id);

        foreach ($WybranyProdukt as $Produkt) {
    		$this->pageTitle = 'Produkt: '.$Produkt['nazwa'];
    	}

        $this->render('produkt',
        	array(
        		'WybranyProdukt' => $WybranyProdukt,
        		'WybranySmakProduktu' => $WybranySmakProduktu,
        		)
        	);
	}

	//logowanie
	public function actionLogin()
	{
		if(Yii::app()->session['zalogowany'] == 'tak')
        {
            $this->redirect(array('sklep/index'));
        }
		$model=new LoginForm;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				//echo 'tak';
				Yii::app()->session['zalogowany'] = 'tak';
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	//wylogowanie
	public function actionLogout()
	{
		if(Yii::app()->session['zalogowany'] != 'tak')
        {
            $this->redirect(array('sklep/index'));
        }
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionRegister()
	{
		if(Yii::app()->session['zalogowany'] == 'tak')
        {
            $this->redirect(array('sklep/index'));
        }

		$model=new Users;

    	if(isset($_POST['Users']))
    	{
        	$model->attributes=$_POST['Users'];
        	$model->data_dodania= date("Y-m-d H:i:s"); 
        	$model->admin= 0;        	
        	if($model->validate())
        	{
        		if($model->passHash())
        		{
        			if($model->DodajUzytkownika())
        			{
        				$this->redirect(array('sklep/login'));
        			}
        		}
            	return;
        	}
    	}
    	$this->render('register',array('model'=>$model));
	}

	
	/**
	 * This is the action to handle external exceptions.
	 */
	// public function actionError()
	// {
	// 	if($error=Yii::app()->errorHandler->error)
	// 	{
	// 		if(Yii::app()->request->isAjaxRequest)
	// 			echo $error['message'];
	// 		else
	// 			$this->render('error', $error);
	// 	}
	// }

	// /**
	//  * Displays the contact page
	//  */
	// public function actionContact()
	// {
	// 	$model=new ContactForm;
	// 	if(isset($_POST['ContactForm']))
	// 	{
	// 		$model->attributes=$_POST['ContactForm'];
	// 		if($model->validate())
	// 		{
	// 			$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
	// 			$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
	// 			$headers="From: $name <{$model->email}>\r\n".
	// 				"Reply-To: {$model->email}\r\n".
	// 				"MIME-Version: 1.0\r\n".
	// 				"Content-Type: text/plain; charset=UTF-8";

	// 			mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
	// 			Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
	// 			$this->refresh();
	// 		}
	// 	}
	// 	$this->render('contact',array('model'=>$model));
	// }

	// /**
	//  * Displays the login page
	//  */
	// public function actionLogin()
	// {
	// 	$model=new LoginForm;

	// 	// if it is ajax validation request
	// 	if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	// 	{
	// 		echo CActiveForm::validate($model);
	// 		Yii::app()->end();
	// 	}

	// 	// collect user input data
	// 	if(isset($_POST['LoginForm']))
	// 	{
	// 		$model->attributes=$_POST['LoginForm'];
	// 		// validate user input and redirect to the previous page if valid
	// 		if($model->validate() && $model->login())
	// 			$this->redirect(Yii::app()->user->returnUrl);
	// 	}
	// 	// display the login form
	// 	$this->render('login',array('model'=>$model));
	// }

	// /**
	//  * Logs out the current user and redirect to homepage.
	//  */
	// public function actionLogout()
	// {
	// 	Yii::app()->user->logout();
	// 	$this->redirect(Yii::app()->homeUrl);
	// }
}
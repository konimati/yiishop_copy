<?php

class Users extends CFormModel
{
	public $username;
	public $password;
	public $email;
	public $admin;
	public $data_dodania;

	
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, email', 'required'),
			array('username', 'length', 'min'=>6, 'max'=>32),
			array('password', 'length', 'min'=>6, 'max'=>32),
			array('email', 'email'),
			array('username', 'authenticateLogin'),
			array('email', 'authenticateEmail'),
			// password needs to be authenticated
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function authenticateLogin($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$PobierzLogin = Yii::app()->db->createCommand('SELECT * FROM uzytkownicy WHERE user = :Login');
			$PobierzLogin->bindValue(':Login',  $this->username, PDO::PARAM_STR);
			$DaneLogin = $PobierzLogin->queryScalar();
			if($DaneLogin != 0)
				$this->addError('username','Login zajęty.');
		}
	}

	public function authenticateEmail($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$PobierzEmail = Yii::app()->db->createCommand('SELECT * FROM uzytkownicy WHERE email = :Email');
			$PobierzEmail->bindValue(':Email',  $this->email, PDO::PARAM_STR);
			$DaneEmail = $PobierzEmail->queryScalar();
			if($DaneEmail != 0)
				$this->addError('email','Email zajęty.');
		}
	}
	
	public function passVerify($login, $haslo)
	{
		$HasloUzytkownika = Yii::app()->db->createCommand('SELECT pass FROM uzytkownicy	WHERE user = :Login'); 
		$HasloUzytkownika->bindValue(':Login',  $login, PDO::PARAM_STR);
		$HasloDB = $HasloUzytkownika->queryScalar();
		if (password_verify($haslo, $HasloDB))
			return true;
		else
			return false;
	}
	public function passHash()
	{
		$this->password = password_hash($this->password, PASSWORD_DEFAULT);
		return true;
	}

	public function WybierzUzytkownika($login)
	{
		$WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT * FROM uzytkownicy WHERE user = :Login');
		$WybierzUzytkownikow->bindValue(':Login',  $login, PDO::PARAM_STR);
		$DaneUzytkownicy = $WybierzUzytkownikow->queryAll();

		return $DaneUzytkownicy; 
	}

	public function LiczIleLoginowLubEmaili($login, $email) 
	{
		$WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT count(idUser) FROM uzytkownicy	WHERE user = :Login OR email = :Email'); 
		$WybierzUzytkownikow->bindValue(':Login',  $username, PDO::PARAM_STR);
		$WybierzUzytkownikow->bindValue(':Email',  $email, PDO::PARAM_STR);
		$DaneUzytkownicy = $WybierzUzytkownikow->queryScalar();
		
		return $DaneUzytkownicy;
	}

	public function DodajUzytkownika()
	{
		
		$DodajUzytkownika = Yii::app()->db->createCommand('INSERT INTO uzytkownicy (user, pass, email, admin, data_dodania) VALUES (:User, :Pass, :Email, :Admin, :Data_dodania)');
		$DodajUzytkownika->bindValue(':User', $this->username, PDO::PARAM_STR);
		$DodajUzytkownika->bindValue(':Pass', $this->password, PDO::PARAM_STR);
		$DodajUzytkownika->bindValue(':Email', $this->email, PDO::PARAM_STR);
		$DodajUzytkownika->bindValue(':Admin', $this->admin, PDO::PARAM_BOOL);
		$DodajUzytkownika->bindValue(':Data_dodania', $this->data_dodania, PDO::PARAM_STR);
		
		$DodajUzytkownika ->execute();

		return true;
	}
}

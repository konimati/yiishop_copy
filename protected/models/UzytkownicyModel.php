<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UzytkownicyModel extends CFormModel
{
	public $login;
	public $haslo;
	public $powtorz_haslo;
	public $email;
	public $data_dodania;
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('login, haslo', 'required'),
			array('login', 'length', 'max'=>150), 
			array('haslo', 'length', 'max'=>50),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'ID',
			'login' => 'Login',
			'haslo' => 'Hasło',
		);
	}

	public function passVerify()
	{
		$HasloUzytkownika = Yii::app()->db->createCommand('SELECT pass FROM uzytkownicy	WHERE user = :Login'); 
		$HasloUzytkownika->bindValue(':Login',  $this->login, PDO::PARAM_STR);
		$HasloDB = $HasloUzytkownika->queryScalar();
		if (password_verify($this->haslo, $HasloDB))
			return true;
		else
			return false;
	}
	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function LiczIleUzytkownikow() 
	{
		$WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT count(idUser) FROM uzytkownicy	WHERE user = :Login'); 
		$WybierzUzytkownikow->bindValue(':Login',  $this->login, PDO::PARAM_STR);
		$DaneUzytkownicy = $WybierzUzytkownikow->queryScalar();
		
		return $DaneUzytkownicy;
	}

	// public function LiczIleLoginowLubEmaili() 
	// {
	// 	$WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT count(idUser) FROM uzytkownicy	WHERE user = :Login OR email = :Email'); 
	// 	$WybierzUzytkownikow->bindValue(':Login',  $this->login, PDO::PARAM_STR);
	// 	$WybierzUzytkownikow->bindValue(':Email',  $this->email, PDO::PARAM_STR);
	// 	$DaneUzytkownicy = $WybierzUzytkownikow->queryScalar();
		
	// 	return $DaneUzytkownicy;
	// }

	public function WybierzUzytkownika()
	{
		$WybierzUzytkownikow = Yii::app()->db->createCommand('SELECT * FROM uzytkownicy WHERE user = :Login');
		$WybierzUzytkownikow->bindValue(':Login',  $this->login, PDO::PARAM_STR);
		$DaneUzytkownicy = $WybierzUzytkownikow->queryAll();

		return $DaneUzytkownicy; 
	}
}

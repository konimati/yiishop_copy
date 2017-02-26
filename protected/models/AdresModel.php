<?php

class AdresModel extends CFormModel
{
	public $imie;
	public $nazwisko;
	public $miejscowosc;
	public $ulica;
	public $nr_domu;
	public $nr_lokalu;
	public $kod_pocztowy;
	public $idUser;

	public function rules()
	{
		return array(
			// username and password are required
			array('imie, nazwisko, miejscowosc, ulica, nr_domu, kod_pocztowy', 'required'),
			array('imie', 'length', 'min'=>2, 'max'=>42),
			array('nazwisko', 'length', 'min'=>2, 'max'=>42),
			array('miejscowosc', 'length', 'min'=>2),
			// password needs to be authenticated
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function attributeLabels()
	{
		return array(
			'imie'=>'Imię',
			'nazwisko'=>'Nazwisko',
			'miejscowosc'=>'Niejscowość',
			'ulica'=>'Ulica',
			'nr_domu'=>'Nr domu',
			'nr_lokalu'=>'Nr lokalu',
			'kod_pocztowy'=>'Kod pocztowy',
		);
	}

	
	
	public function WybierzAdresUzytkownika()
	{
		$WybierzAdresUzytkownika = Yii::app()->db->createCommand('SELECT * FROM adresy WHERE idUser = :IdUser');
		$WybierzAdresUzytkownika->bindValue(':IdUser',  $this->idUser, PDO::PARAM_STR);
		$DaneUzytkownicy = $WybierzAdresUzytkownika->queryAll();

		return $DaneUzytkownicy; 
	}

	public function DodajAdresUzytkownika()
	{
		
		$DodajAdresUzytkownika = Yii::app()->db->createCommand('INSERT INTO adresy (imie, nazwisko, miejscowosc, ulica, nr_domu, nr_lokalu, kod_pocztowy, idUser) VALUES (:imie, :nazwisko, :miejscowosc, :ulica, :nr_domu, :nr_lokalu, :kod_pocztowy, :idUser)');
		$DodajAdresUzytkownika->bindValue(':imie', $this->imie, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':nazwisko', $this->nazwisko, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':miejscowosc', $this->miejscowosc, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':ulica', $this->ulica, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':nr_domu', $this->nr_domu, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':nr_lokalu', $this->nr_lokalu, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':kod_pocztowy', $this->kod_pocztowy, PDO::PARAM_STR);
		$DodajAdresUzytkownika->bindValue(':idUser', $this->idUser, PDO::PARAM_INT);
		
		$DodajAdresUzytkownika->execute();

		return true;
	}

	public function UsunAdres()
	{
		$UsunWpis = Yii::app()->db->createCommand('DELETE FROM adresy WHERE idUser = :idUser');
		$UsunWpis->bindValue(':idUser',  $id, PDO::PARAM_INT);
		$UsunWpis->execute();

		return true;
	}

	public function AktualizujAdres()
	{
		
		$AktualizujAdresUzytkownika = Yii::app()->db->createCommand('UPDATE adresy SET imie = :imie, nazwisko = :nazwisko, miejscowosc = :miejscowosc, ulica = :ulica, nr_domu = :nr_domu, nr_lokalu = :nr_lokalu, kod_pocztowy = :kod_pocztowy WHERE idUser = :idUser');
		$AktualizujAdresUzytkownika->bindValue(':imie', $this->imie, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':nazwisko', $this->nazwisko, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':miejscowosc', $this->miejscowosc, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':ulica', $this->ulica, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':nr_domu', $this->nr_domu, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':nr_lokalu', $this->nr_lokalu, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':kod_pocztowy', $this->kod_pocztowy, PDO::PARAM_STR);
		$AktualizujAdresUzytkownika->bindValue(':idUser', $this->idUser, PDO::PARAM_INT);
		
		$AktualizujAdresUzytkownika->execute();

		return true;
	}

	// public function authenticateLogin($attribute,$params)
	// {
	// 	if(!$this->hasErrors())
	// 	{
	// 		$PobierzLogin = Yii::app()->db->createCommand('SELECT * FROM uzytkownicy WHERE user = :Login');
	// 		$PobierzLogin->bindValue(':Login',  $this->username, PDO::PARAM_STR);
	// 		$DaneLogin = $PobierzLogin->queryScalar();
	// 		if($DaneLogin != 0)
	// 			$this->addError('username','Login zajęty.');
	// 	}
	// }

	// public function authenticateEmail($attribute,$params)
	// {
	// 	if(!$this->hasErrors())
	// 	{
	// 		$PobierzEmail = Yii::app()->db->createCommand('SELECT * FROM uzytkownicy WHERE email = :Email');
	// 		$PobierzEmail->bindValue(':Email',  $this->email, PDO::PARAM_STR);
	// 		$DaneEmail = $PobierzEmail->queryScalar();
	// 		if($DaneEmail != 0)
	// 			$this->addError('email','Email zajęty.');
	// 	}
	// }
}

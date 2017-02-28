<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_id;
	private $_state;


	public function authenticate()
	{
		//znajduje wiersz o określonych wartościach atrybutów
		//pobrać z modelu wszystkei info o danych loginie
		$users = new Users;
		$info_user = $users -> WybierzUzytkownika($this->username);
		//sprawdzić czy znalazł uzytkownika o padanych loginie
		if($users === null)
		{
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else
		{//sprawdzić podane hasło w modelu Users
			if($users->passVerify($this->username, $this->password))
			{
				foreach ($info_user as $key) {
					$this->_id=$key['idUser'];
					$this->setState('admin', $key['admin']); 
					//Yii::app()->session['admin'] = $key['admin']; 
				}

				unset($info_user);
				$this->errorCode=self::ERROR_NONE;
			}else{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			}
			
		}
		
		return !$this->errorCode;
	}

	public function getId()
    {
        return $this->_id;
    }

 //    public function setState($name,$value)
	// {
	//     $this->_state[$name]=$value;
	// }
 


	

	// public function authenticate()
	// {
	// 	$users=array(
	// 		// username => password
	// 		'demo'=>'demo',
	// 		'admin'=>'admin',
	// 	);
	// 	if(!isset($users[$this->username]))
	// 		$this->errorCode=self::ERROR_USERNAME_INVALID;
	// 	elseif($users[$this->username]!==$this->password)
	// 		$this->errorCode=self::ERROR_PASSWORD_INVALID;
	// 	else
	// 		$this->errorCode=self::ERROR_NONE;
	// 	return !$this->errorCode;
	// }
}
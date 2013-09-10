<?php
/**
 * User: Green
 * Date: 2013/8/19
 * Time: 下午 11:50
 */

class PinewaveUserIdentity extends CUserIdentity{

	private $_id;

	public function authenticate(){
		if($this->password == 'liverBroken' && $this->username == 'pinewave'){
			// Login successful
			$this->_id= '1';
			$this->errorCode = self::ERROR_NONE;
		}else{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}

		return !$this->errorCode;
	}

	public function getId()	{
		return $this->_id;
	}
}
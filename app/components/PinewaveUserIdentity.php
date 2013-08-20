<?php
/**
 * User: Green
 * Date: 2013/8/19
 * Time: 下午 11:50
 */

class PinewaveUserIdentity extends CUserIdentity{

	public function authenticate(){
		if($this->password === 'liverBroken' && $this->username === 'pinewave'){
			// Login successful
			$this->errorCode = self::ERROR_NONE;
		}else{
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}

		return !$this->errorCode;
	}
}
<?php 

class One {

	protected $param_one; 
	public function __construct(){
		$this->param_one = 101; 
	}
}


class Two extends One{
	public function __construct(){
		parent::__construct(); 
		echo ( $this->param_one > 10 ) ? " more then 10 " : "less then 10";  
	}

}

$one = new Two; 


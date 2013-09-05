<?php 

class History {
	private $_history;
	
 	public function save(){
 		$this->_history = get_object_vars($this); 
 	}

 	public function rollback(){
 		if( ! $this->_history ) return false; 

 		foreach ($this->_history as $key => $value) {
 			$this->{$key} = $value; 
 		}

 	}
}

class MyClass extends History {
	public $x = 10;
	public $y = 20; 

	public function someFunc(){
		return get_object_vars($this);  
 	}
 	

}

$c = new MyClass; 
echo "<br><br>"; 
var_dump($c); 



$c->x = 100; 


$c->save(); 

echo "<br><br>"; 
var_dump($c); 

$c->x = 15; 
$c->save(); 
echo "<br><br>"; 
var_dump($c); 


$c->rollback(); 


echo "<br><br>"; 
var_dump($c); 

echo $c->x; 
$c->rollback(); 
echo $c->x;  
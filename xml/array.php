<?php

$res = array(); 

$arr = array(
	array('id' => 1, 'title' => 'Cat1', 'parent_id' => 0), 
	array('id' => 2, 'title' => 'Cat2', 'parent_id' => 0),
	array('id' => 3, 'title' => 'Sub1', 'parent_id' => 1), 
	array('id' => 4, 'title' => 'Sub zero', 'parent_id' => 3)
	); 

function has_parent($arr, $parent_id){ 

	foreach ($arr as $entry) {
		if ($entry['id'] == $parent_id) return $entry; 
	}
	return false; 
}

function full_path($arr, $start, &$res){
	if (has_parent($arr, $start['parent_id'])) {
		$parent = has_parent($arr, $start['parent_id']); 
		//echo $start['title']; 
		array_push($res, $start['title']); 
		full_path($arr, $parent, $res); 
	} else {
		//echo $start['title']; 
		array_push($res, $start['title']); 
	}
}

full_path($arr, $arr[3], $res);

print_r($res);  


?>
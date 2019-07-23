<?php
function merge_sort($array=[])
{
	if(count($array) == 1 ) return $array;
	
	$mid = count($array) / 2;
    $left = array_slice($array, 0, $mid);
    $right = array_slice($array, $mid);
	$left = merge_sort($left);
	$right = merge_sort($right);

	return merge($left, $right);
}
function merge($left, $right){
	$data =[];

	while (count($left) > 0 && count($right) > 0){
		if($left[0] > $right[0]){
			$data[] = $right[0];
			$right = array_slice($right , 1);
		}else{
			$data[] = $left[0];
			$left = array_slice($left, 1);
		}
	}

	while (count($left) > 0){
		$data[] = $left[0];
		$left = array_slice($left, 1);
	}

	while (count($right) > 0){
		$data[] = $right[0];
		$right = array_slice($right, 1);
	}
	return $data;
}


$array = [100, 54, 7, 2, 5, 4, 123,234,1000];
print_r(merge_sort($array));
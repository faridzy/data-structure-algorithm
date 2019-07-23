<?php
function quick_sort($array=[])
{
	$array1=[];
	$array2=[];

	if(count($array)<2)
	{
		return $array;
	}

	$pivotKey=key($array);
	$pivot=array_shift($array);

	foreach ($array as $key => $value) 
	{
		if($value <= $pivot)
		{
			$array1[]=$value;
		}else
		{
			$array2[]=$value;

		}
			
	}
	return array_merge(quick_sort($array1),array($pivotKey=>$pivot),quick_sort($array2));
}

$angka = [10,3,11,8,9,6,12];
print_r(quick_sort($angka));
<?php
function bubble_sort($array=[]) {
    $size = count($array)-1;
    for ($i=0; $i<$size; $i++) {
        for ($j=0; $j<$size-$i; $j++) {
            $k = $j+1;
            if ($array[$k] < $array[$j]) {
                // Swap elements at indices: $j, $k
                list($array[$j], $array[$k]) = array($array[$k], $array[$j]);
            }
        }
    }
    return $array; 
}

$array = [3,2,5,1,100,2300,2,3,2];
print_r(bubble_sort($array));
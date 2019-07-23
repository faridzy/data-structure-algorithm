<?php
function insertion_sort($array=[])
{
    for ($i = 0; $i < count($array); $i++) {
        $val = $array[$i];
        $j = $i-1;
        while ($j>=0 && $array[$j] > $val) {
            $array[$j+1] = $array[$j];
            $j--;
        }
        $array[$j+1] = $val;
    }
 
    return $array;
}

$array = [3,2,5,1,100,2300,2,3,2];
print_r(insertion_sort($array));
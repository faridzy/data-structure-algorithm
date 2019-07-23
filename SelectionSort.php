<?php
function selection_sort($array=[])
{
    for ($i=0; $i<count($array)-1; $i++) {
        $min = $i;
        for ($j=$i+1; $j<count($array); $j++) {
            if ($array[$j]<$array[$min]) {
                $min = $j; 
            }
        }
        //swap posisi
        $temp = $array[$min];
        $array[$min] = $array[$i];
        $array[$i] = $temp;
        //end swap
    }

    return $array;
}

$array = [3,2,5,1,100,2300,2,3,2];
print_r(selection_sort($array));
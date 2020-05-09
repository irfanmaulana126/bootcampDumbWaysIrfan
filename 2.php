<?php
    $str=array("12","0","1","3","5","9","10");
    $arr = array();
   $arrLength=count($str);
   $arrLength2=count($str);
    for($i = 1; $i <= $arrLength; $i++) {
        --$arrLength2;
        $arr []=$str[$arrLength2]; 
        echo $str[$arrLength2].' ';
    }    
    print_r($arr);

?>
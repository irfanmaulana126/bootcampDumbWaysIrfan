<?php
    $str="mamaMakanPepayaWaktuBuka";
   
    $result = preg_replace("([A-Z])", " $0", $str);
    $str=explode(' ', $result);
    for ($i=0;$i<count($str);$i++){
        echo $str[$i].', ';
    }

?>
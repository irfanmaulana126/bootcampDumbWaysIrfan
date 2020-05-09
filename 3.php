<?php
pola(5);
function pola($a)
{
    if($a%2==1){
        for ($i=1; $i<=$a; $i++){
            for ($j=$a; $j > $i; $j--) { 
                echo "&nbsp;";
            }
            for ($k=1; $k <= $a; $k++) { 
                echo " * ";
            }
            echo "</br>";
        }
    }else{
        echo "Bukan Ganjil";
    }

}
?>
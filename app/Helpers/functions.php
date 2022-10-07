<?php

function array_exists_in_array($array1, $array2) {
    
    $verificador = 0;

    foreach($array1 as $item) {
        if($item->id == $array2->id) {
            $verificador = $verificador + 1;
        }
    }

    if($verificador == 0) {
        return false;
    }

    return true;
}
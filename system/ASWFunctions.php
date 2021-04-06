<?php 

function url($name_or_path='', $params = null, $write=true){
    if($write){
        echo ASWRouter::url($name_or_path, $params);
    }else{
        return ASWRouter::url($name_or_path, $params);
    }
} //url




function redirect($name_or_path='', $params = null){
    $url = ASWRouter::url($name_or_path, $params);
    header('Location:'.$url);
} //redirect

?>
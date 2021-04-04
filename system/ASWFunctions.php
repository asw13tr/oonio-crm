<?php 

function url($path='', $params = null, $write=true){

    if($write){
        echo ASWRouter::url($path, $params);
    }else{
        return ASWRouter::url($path, $params);
    }

}//url




function redirect($path='', $params = null){
    $url = ASWRouter::url($path, $params);
    header('Location:'.$url);
}

?>
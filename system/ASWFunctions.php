<?php 

// URL GETİREN FONKSİYON
function url($name_or_path='', $params = null, $write=true){
    if($write){
        echo ASWRouter::url($name_or_path, $params);
    }else{
        return ASWRouter::url($name_or_path, $params);
    }
} //url



// SAYFA YÖNLENDİRME FONKSİYONU
function redirect($name_or_path='', $params = null){
    $url = ASWRouter::url($name_or_path, $params);
    header('Location:'.$url);
} //redirect


// TRANSLATE FONKSİYONU
function _tr($str){
    return $str;
} //_tr



// POST ALMA FONKSİYONU
function post($key, $default=null){
    $result = !isset($_POST[$key]) ? $default : $_POST[$key];
    return $result;
} //post


// GET ALMA FONKSİYONU
function get($key, $default=null){
    $result = !isset($_GET[$key]) ? $default : $_GET[$key];
    return $result;
} //get


// DİZİ VE OBJE NESNELERİNİ EKRANA YAZMAK
function print_obj($obj, $exit=false){
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
    if($exit){ exit; }
} //print_obj



?>
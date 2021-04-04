<?php
ob_start();
session_start();

require_once("./system/ASWBootstrap.php");

$Route = json_decode(json_encode( ASWRouter::getRoute() ));
if($_SERVER['REQUEST_METHOD']!==$Route->requestMethod){
    echo 'Request Methodu hatalı';
    exit;
}

$Params = ASWRouter::getParams();

$pathController = __DIR__.'/app/controllers/'.$Route->controller.'.php';

// Controller dosyası sorgulama
if( !file_exists($pathController) ){
    echo 'Controller dosyası bulunamadı';
}else{
    require_once($pathController);

    // Class varlığı sorgulama
    
    $currentControllerName = $Route->controller;

    if(!class_exists(($currentControllerName))){
        echo $Route->controller.' sınıfı bulunamadı';
    }else{

        // Class içerisindeki method sorgulama.
        if(!method_exists($currentControllerName, $Route->method)){
            echo $Route->method.' methodu bulunamadı';
        }else{
            
            $Class = new $currentControllerName();
            $methodAndClass = [$Class, $Route->method];
            call_user_func_array($methodAndClass,  $Params);

        }

    }

}


?>

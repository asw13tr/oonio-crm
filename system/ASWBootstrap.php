<?php 
    require_once(__DIR__."/ASWSession.php");
    require_once(__DIR__."/ASWCookie.php");
    require_once(__DIR__ . "/../config.php");
    require_once(__DIR__."/ASWDatabase.php");
    require_once(__DIR__."/ASWRouter.php");

    /*
    function __autoload($className) {
        $sinifYolu = __DIR__.'/../app/models/'. $className . ".php";
        if (is_readable($sinifYolu)) {
            require_once $sinifYolu;
        } else {
            print_r($sinifYolu);
            echo "Sınıfa ait dosya bulunamadı.";
        }
    }
    */


    require_once(__DIR__ . "/ASWFunctions.php");

    if(CUSTOM_PHP_FILES!=null && is_array(CUSTOM_PHP_FILES)){
        foreach(CUSTOM_PHP_FILES as $file){
            include_once(__DIR__.'/../'.$file);
        }
    }

    require_once(__DIR__."/ASWModel.php");
    require_once(__DIR__."/ASWView.php");
    require_once(__DIR__."/ASWController.php");
?>
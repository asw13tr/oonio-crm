<?php


class ASWRouter{

    private static $urlRoot = URL_ROOT;
    private $url404  =  URL_404;

    public static $routes = [];
    public static $routesNames = [];




    // Route oluşturma fonksiyonu
    private static function add($mask, $path, $name, $requestMethod='GET'){
        self::$routesNames[$mask] = $name;
        self::$routes[$name] = [
            'requestMethod' => $requestMethod,
            'name'          => $name,
            'mask'           => $mask,
            'controller'    => explode('@', $path)[0],
            'method'       => isset(explode('@', $path)[1])? (explode('@', $path)[1]) : index
        ];
    }





    // GET METHODLU ROUTE OLUŞTURMA FONKSİYONU
    public static function get($mask, $path, $name){
        self::add($mask, $path, $name, 'GET');
    }
    // POST METHODLU ROUTE OLUŞTURMA FONKSİYONU
    public static function post($mask, $path, $name){
        self::add($mask, $path, $name, 'POST');
    }





    // O ANKİ ADRESTEN ROUTE İSMİ BULMA FONKSİYONU
    private static function findRouteName($route){
        $routeParts = explode( '/', trim($route, '/') );
        $result = null;

        foreach(self::$routesNames as $url => $name){
            $urlParts = explode( '/', trim($url, '/') );

            if(count($routeParts) != count($urlParts)){ continue; }

            foreach($urlParts as $key => $val){
                $urlParts[$key] = strpos($val, ':')===0? $routeParts[$key] : $val;
            }

            $newUrl = implode('/', $urlParts);
            if($newUrl==trim($route, '/')){
                $result = $name;
                break;
            }
        }
        return $result;
    } //findRouteName





    // O ANKİ URL DEN PARAMETRELERİ ALAN FONKSİYON
    public static function getParams(){
        $params = [];
        $mask = explode('/', self::getRoute()['mask']);
        $path = explode('/',  trim(self::currentUrl(true), '/') );

        foreach( $mask as $key => $val ){
            if(strpos($val, ':')===0){
                $params[substr($val, 1)] = $path[$key];
            }
        }
        return $params;
    }




    // ANLIK REQUEST BİLGİSİNİ VERİR
    public static function currentRequest(){
        $data = [
            'protocol' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http",
            'host'     => $_SERVER['HTTP_HOST'],
            'uri'      => $_SERVER['REQUEST_URI'],
            'method'   => $_SERVER['REQUEST_METHOD'],
            'path'      => isset($_GET['q'])? $_GET['q'] : null,
            'url'       => self::$urlRoot
        ];
        return json_decode( json_encode( $data ) );
    }//currentRequest





    // ANLIK TAM SİTE ADRESİ
    public static function currentUrl($justPath=false){
        $d = self::currentRequest();
        $urlRoot = !self::$urlRoot? ($d->protocol.'://'.$d->host) : self::$urlRoot ;
        return $justPath? $d->path : ($urlRoot.$d->uri) ;
    }




    // O ANKİ ROOT OBJESİNİ GETİRMEK
    public static function getRoute(){
        $path = self::currentUrl(true);
        if(!isset(self::$routesNames[$path])){
            $routeName = self::findRouteName($path);
            if(!$routeName){ $routeName = '404'; }
        }else{
            $routeName = self::$routesNames[$path];
        }
        return self::$routes[$routeName];
    }





    public static function url($path, $params = null){

        $path =  !isset(self::$routes[$path])? $path : self::$routes[$path]['mask'];
        if($params && is_array($params)){
            foreach($params as $key => $val){
                $path = str_replace(':'.$key, $val, $path);
            }
        }
        return self::$urlRoot.'/'.$path;

    } // url






    public static function getAll(){
        return self::$routes;
    }


}

require_once(__DIR__.'/../routes.php');




?>

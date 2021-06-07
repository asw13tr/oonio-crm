<?php 

class ASWView{

    // Views dosyalarının bulunduğu dizin
    static $pathRoot = __DIR__.'/../app/views/';

    private static $includeBeforeView = [ 'header.php' ];
    private static $includeAfterView = [ 'footer.php' ];


    static function include($path, $datas=[], $allowBeforeInc=true, $allowAfterInc=true){
        extract($datas);

        if($allowBeforeInc){
            foreach( self::$includeBeforeView as $file){ 
                require_once( (self::$pathRoot).self::cleanPhpExt($file) ); 
            }
        }

        require_once( (self::$pathRoot) . self::cleanPhpExt($path) ) ;

        if($allowAfterInc){
            foreach( self::$includeAfterView as $file){ 
                require_once( (self::$pathRoot).self::cleanPhpExt($file) ); 
            }
        }

    } //get

    private static function cleanPhpExt($name){
        return str_replace('.php', '', $name).'.php';
    }//cleanPhpExt

}
?>
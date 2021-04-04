<?php
class ASWSession{



    // SET
    static function set($key, $val=null){
        if(!is_array($key)){
            $_SESSION[$key] = $val;
        }else{
           foreach ($key as $k => $v){
               $_SESSION[$k] = $v;
           }
        }
    } //set





    // GET
    static function get($key, $default = null){
        return isset($_SESSION[$key])? $_SESSION[$key] : $default ;
    } //get





    // ISSET
    static function has($key){
        return isset($_SESSION[$key]);
    }





    // DELETE
    static function delete($key){
        unset($_SESSION[$key]);
    }
    static function remove($key){ self::delete($key); }
    static function trash($key){ self::delete($key); }





    // SET FLASH
    static function setFlash($key, $val=null){
        if(!is_array($key)){
            $_SESSION['flash_sessions'][$key] = $val;
        }else{
            foreach ($key as $k => $v){
                $_SESSION['flash_sessions'][$k] = $v;
            }
        }
    } //setFlash






    // GET FLASH
    static function getFlash($key, $default=null){
        $flash = isset($_SESSION['flash_sessions'][$key])? $_SESSION['flash_sessions'][$key] : $default ;
        self::deleteFlash($key);
        return $flash;
    } //getFlash




    // HAS FLASH
    static function hasFlash($key){
        return isset($_SESSION['flash_sessions'][$key]);
    }


    static function deleteFlash($key){
        unset($_SESSION['flash_sessions'][$key]);
    }
    static function removeFlash($key){ self::deleteFlash($key); }
    static function trashlash($key){ self::deleteFlash($key); }




}  ?>

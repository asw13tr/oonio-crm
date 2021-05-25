<?php
/*
 * ASWSesssion::set(key, val);
 * ASWSesssion::set([k=>v, k2=>v2]);
 *
 * ASWSesssion::has(key);
 * ASWSesssion::get(key, default);
 * ASWSession::delete(key);
 *
 *
 * */
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


    // FLASH SİLMEK
    static function deleteFlash($key){
        unset($_SESSION['flash_sessions'][$key]);
    }
    static function removeFlash($key){ self::deleteFlash($key); }
    static function trashFlash($key){ self::deleteFlash($key); }



    // TÜM SESSIONLARI SİLER
    static function destroy(){
        foreach ($_SESSION as $k => $v){ unset($_SESSION[$k]); }
        session_destroy();
    }
    static function deleteAll(){ self::destroy(); }
    static function removeAll(){ self::destroy(); }
    static function trashAll(){ self::destroy(); }



}  ?>

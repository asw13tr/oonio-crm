<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    25.05.2021 20:23
 */

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

class ASWCookie{


    // SET
    static function set($key, $val = null, $minute=120){
        if (!is_array($key)) {
            setcookie($key, $val, time()+(60*$minute), '/');
        } else {
            foreach ($key as $k => $v) {
                setcookie($k, $v, time()+(60*$minute), '/');
            }
        }
    } //set


    // GET
    static function get($key, $default = null){
        return isset($_COOKIE[$key]) ? $_COOKIE[$key] : $default;
    } //get


    // ISSET
    static function has($key){
        return isset($_COOKIE[$key]);
    }


    // DELETE
    static function delete($key){
        setcookie($key, "", time()-3600, '/');
        unset($_COOKIE[$key]);
    }
    static function remove($key){ self::delete($key); }
    static function trash($key){ self::delete($key); }




    // TÜM ÇEREZLERİ SİLER
    static function destroy(){
        foreach($_COOKIE as $k => $v) {
            self::delete($k);
        }
    }
    static function deleteAll(){ self::destroy(); }
    static function removeAll(){ self::destroy(); }
    static function trashAll(){ self::destroy(); }

}

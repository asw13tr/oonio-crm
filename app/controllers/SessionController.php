<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    25.05.2021 14:43
 */

class SessionController extends ASWController
{


    function login(){
        $to = get('to', '/');
        $this->loginCookieControl($to);
        $this->simpleRender('login', ['to'=>$to]);

    } //login


    function loginPost(){
        $username = post('username', false);
        $password = post('password', false);
        $remember = post('remember', false);
        $to = post('to', '/');

        if(!$username || !$password){
            ASWSession::setFlash('flash-danger', 'alanları doldurduğunuzdan emin olun');
            redirect('login');
        }else{
            global $db;
            $sqlDatas = [$username, ASWHelper::encryptPass($password)];
            $user = $db->queryOne('SELECT * FROM users WHERE user_slug=? and user_password=? and user_status>0 and user_level>0', $sqlDatas);

            if(!$user){
                ASWSession::setFlash('flash-danger', 'hatalı giriş denemesi.');
                redirect('login');
            }else{
                unset($user->user_password);
                ASWSession::set('user', $user);
                if($remember==1){
                    $cookies = [
                        'login'=>1,
                        'user_id'=>$user->user_id,
                        'user_slug'=>$user->user_slug
                    ];
                    ASWCookie::set($cookies, 1, 1);
                }
                redirect($to);
            }

        }
    } //loginPost


    function loginCookieControl($to){
        if(ASWCookie::has('login')){

            $login = ASWCookie::get('login', 0);
            $id = ASWCookie::get('user_id', false);
            $username = ASWCookie::get('user_slug', false);

            if($login==1 && $id && $username){
                global $db;
                $sqlDatas = [$id, $username];
                $user = $db->queryOne('SELECT * FROM users WHERE user_id=? and user_slug=? and user_status>0 and user_level>0', $sqlDatas);
                if($user){
                    ASWSession::set('user', $user);
                    redirect($to);
                }
            }
        }
    } //loginCookieControl



    function logout(){
        ASWCookie::destroy();
        ASWSession::destroy();
        redirect('home');
    } //logout





}
?>
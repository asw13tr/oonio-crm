<?php
class ASWHelper{

    static function getSubHeader($title, $icon=null, $buttonsArray=[]){
        $icon = !$icon? null : '<i class="'.$icon.'"></i> ';

        $buttons = [];
        if(is_array($buttonsArray)){
            foreach($buttonsArray as $button){
                $btnIcon = isset($button['icon'])? '<i class="'.$button['icon'].'"></i> ' : null;
                $buttons[] = '<a href="'.$button['url'].'" class="mx-1 '.@$button['class'].'">'.$btnIcon.$button['title'].'</a>';
            }
        }

        $result  = '<div class="row subHeader pt-2"><div class="col"><h5>'.$icon.' '.$title.'</h5></div>';
        $result .= '<div class="col col-sm-4 d-flex justify-content-end">'.implode('', $buttons).'</div>';
        $result .= '</div><hr>';
        return $result;
    } //getSubHeader



    static function fillTheGaps($str, $ayrac='-', $counter=5){
        $newStr= '';
        foreach(str_split($str) as $index => $char){
          $newStr .= $char.( ($index>0 && (($index+1)%$counter==0))? $ayrac : '' );
        }
        return $newStr;
    } //fillTheGaps




    static function encode_customerPass($password){
        $ayrac = '{oio}';
        $newPass = fillTheGaps($password, $ayrac, 3);
        $newPass = base64_encode($newPass);
        $newPass = fillTheGaps($newPass, $ayrac, 3);
        return $newPass;
    } //encode_customerPass



    static function decode_customerPass($password){
        $ayrac = '{oio}';
        $newPass = str_replace($ayrac, '', $password);
        $newPass = base64_decode($newPass);
        $newPass = str_replace($ayrac, '', $newPass);
        return $newPass;
    } //decode_customerPass





    static function encryptPass($password){
        return hash('md5', hash('sha256', base64_encode($password)));
    } //encryptPass





    static function oonioEncrypt($data){
        $cry = ['$:o:',':n!:',':Ni:', ':o:#'];

        if(strlen($data) > 50){$bolme = 5;}
        elseif(strlen($data) >= 20){$bolme = 4;}
        elseif(strlen($data) >= 7){$bolme = 2;}
        else{$bolme = 1;}

        $dataArray = [];

        for($i=0; $i<strlen($data); $i++){
            $dataArray[] = $data[$i];
            if(($i+1) % $bolme == 0){
                $dataArray[] = $cry[rand(0,3)];
            }
        }

        $result = implode('', $dataArray);
        return base64_encode($result);
    } //oonioEncrypt

    static function oonioDecrypt($data){
        $cry = ['$:o:',':n!:',':Ni:', ':o:#'];
        $result = str_replace($cry, '', base64_decode($data));
        return $result;
    } //oonioDecrypt




    static function htmlAlert($title=null, $message, $class="success"){
        $title = !$title? null : '<h4 class="alert-heading">'.$title.'</h4>';
        return '<div class="alert alert-'.$class.' alert-dismissible fade show" role="alert">'.$title.'<p class="p-0 m-0">'.$message.'</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    } //htmlAlert


    static function htmlFloatInput($id, $val=null, $title='', $outerClass='', $extra=null, $type="text"){
        if($type=='textarea'){
            $result =  '<div class="'.$outerClass.'">
                    <div class="form-floating">
                        <textarea autocomplete="off" type="'.$type.'" name="'.$id.'" id="'.$id.'" class="form-control" placeholder="'.$title.'" style="height: 100px" '.$extra.'>'.$val.'</textarea><label for="'.$id.'">'.$title.'</label>
                    </div>
                </div>';
        }else{
            $result =  '<div class="'.$outerClass.'">
                    <div class="form-floating">
                        <input autocomplete="off" type="'.$type.'" name="'.$id.'" id="'.$id.'" class="form-control" placeholder="'.$title.'" value="'.$val.'" '.$extra.'/><label for="'.$id.'">'.$title.'</label>
                    </div>
                </div>';
        }
        return $result;
    } //htmlFloatInput


    static function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }


}//ASWHelper




?>

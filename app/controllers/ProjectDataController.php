<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    05.06.2021 23:41
 */

class ProjectDataController extends ASWController{


    protected $models = ['Project', 'User', 'ProjectData'];

    // PROJEYE YENİ VERİ EKLE
    function save($id){
        $result = ['status'=>false];
        $project = new Project( $id );
        if(!$project->primaryVal){
        }else{

            $projectID = post('data_project', false);
            if($id == $projectID){
                $newProjectDatas = [
                    'data_project'        => $projectID,
                    'data_title'          => post('data_title'),
                    'data_description'    => post('data_description'),
                    'data_value' => json_encode([
                        'keyword'   => post('data_key'),
                        'value'     => ASWHelper::oonioEncrypt(post('data_val'))
                    ]),
                ];

                $ProjectData = new ProjectData();
                $ProjectData = $ProjectData->create($newProjectDatas);

                if(!$ProjectData){ // Data veritabanına eklenemedi.
                }else{
                    $result = array_merge($newProjectDatas, ['status'=>true]);
                }

            } //if($id == $projectID)

        }
        $this->jsonRender($result);
    } // saveData






    public function decrypt($id){
        $val = post('val', false);
        $result = ['status'=>false, 'value'=>$val];
        $user = ASWSession::get('user', false);
        if($val!=false && $user!=false && @$user->user_level>1){
            $result = [
                'status'=>true,
                'id'=>$id,
                'className'=>'row-data-item-'.$id,
                'value'=>ASWHelper::oonioDecrypt($val)
            ];
        }
        $this->jsonRender($result);
    } //decrypt








    // Bilgiyi Silmek
    function delete($id){
        $data = new ProjectData($id);
        $result = [
            'status' => false,
            'title' => _tr('bir sorun oluştu'),
            'message' => _tr('sistemde beklenmedik bir sorun oluştu ve işlem gerçekleşemedi')
        ];
        if(!$data->primaryVal){
            $result['message'] = _tr('belirtilen proje bilgisi sistemde yok');
            $result['timer'] = 2000;
        }else{
            $delete = $data->delete();
            if($delete){
                $result = [
                    'status'    => true,
                    'title'     => _tr('proje bilgisi silindi'),
                    'message'   => _tr('belirtilen proje bilgisi sistemden silindi'),
                    'id'        => $id
                ];
            }
        }
        $this->jsonRender($result);
    } //delete





}


?>
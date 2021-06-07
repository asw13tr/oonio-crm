<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    05.06.2021 23:41
 */

class ProjectDataController extends ASWController{


    protected $models = ['Project', 'User', 'ProjectData'];
    protected $renderDatas = [
        'footerScripts' => ['/static/js/projects.js']
    ];


    private $trTemplate = '<td>:data_id</td>
                    <td><button class="btn btn-default btn-sm text-start">:data_title</button></td>
                    <td>:data_keyword</td>
                    <td>
                        <div class="input-group">
                            <input type="text" id="dataInput:data_id" class="dataInput form-control form-control-sm" placeholder="*******">
                            <button class="btn btn-sm btnDecrypt btn-outline-danger fa fa-eye" 
                                    type="button"
                                    onclick="decryptProjectData(\'show\', \':data_url_decrypt\', \':data_value\')"></button>
                            <button class="btn btn-sm btnDecrypt btn-outline-danger fa fa-eye-slash  d-none" 
                                    type="button"
                                    onclick="decryptProjectData(:data_id, 0,0)"></button>
                            <button class="btn btn-sm btn-outline-primary fa fa-copy" onclick="copyToClipboard(\'dataInput:data_id\')" type="button"></button>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning fa fa-edit text-center" onclick="getDataProjectForm(\':data_url_edit\')"></button>
                            <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel(\'proje verisi silinecek\', \'bu bilgiyi silmek istediğinize emin misiniz? işlem bir daha geri alınamaz\', \':data_url_delete\', \'tr.row-data-item-\')"></button>
                        </div>
                    </td>';


    private function getTrTemplate($data, $justInner = false){
        $extra = json_decode($data->data_value);
        $old = [':data_id', ':data_title', ':data_keyword', ':data_url_decrypt', ':data_value', ':data_url_edit', ':data_url_delete'];
        $new = [$data->data_id, $data->data_title, $extra->keyword, $data->urlDecrypt(), $extra->value, $data->urlEdit(), $data->urlDelete()];
        $template = str_replace($old, $new, $this->trTemplate);
        if($justInner){
         return $template;
        }
        return '<tr class="row-data-item-'.$data->data_id.'">'.$template.'</tr>';
    } //getTrTemplate




    /////////////////////////////////////////////////////////////////////////////////////////////////





    // YENİ PROJE BİLGİSİ EKLEME FORMU
    function create($id){
        $this->simpleRender('projects/form-data', ['project_id'=>$id]);
    } //create


    // PROJEYE YENİ VERİ EKLE
    function save($id){
        $result = ['status'=>false, 'action'=>'create'];
        $project = new Project( $id );
        if(!$project->primaryVal){
            // Gelen id numarasına sahip proje veritabanında yok.
        }else{

            $projectID = post('data_project', false);
            if($id == $projectID){
                $recordDatas = [
                    'data_project'        => $projectID,
                    'data_title'          => post('data_title'),
                    'data_description'    => post('data_description'),
                    'data_value' => json_encode([
                        'keyword'   => post('data_key'),
                        'value'     => ASWHelper::oonioEncrypt(post('data_val'))
                    ])
                ];

                $ProjectData = new ProjectData();
                $ProjectData = $ProjectData->create($recordDatas);

                if(!$ProjectData){ // Data veritabanına eklenemedi.
                }else{
                    $result = array_merge($recordDatas, ['status'=>true, 'action'=>'create', 'template'=>$this->getTrTemplate($ProjectData)]);
                }

            } //if($id == $projectID)

        } // else
        $this->jsonRender($result);
    } // saveData





    /////////////////////////////////////////////////////////////////////////////////////////////////






    // Proje bilgisi düzenleme kontrolü
    function edit($id){
        $projectData = new ProjectData($id);
        $this->simpleRender('projects/form-data', ['data'=>$projectData]);
    } //edit


    // Proje bilgisi güncelleme kontrolü
    function update($id){
        $result = [ 'status'=>false,
                    'action'=>'update',
                    'message'=>_tr('sistemde beklenmedik bir hata oluştu'),
                    'className' => 'error'];
        $ProjectData = new ProjectData($id);

        if(!$ProjectData->primaryVal){
        }else{


                $recordDatas = [
                    'data_project'        => post('data_project'),
                    'data_title'          => post('data_title'),
                    'data_description'    => post('data_description'),
                    'data_value' => json_encode([
                        'keyword'   => post('data_key'),
                        'value'     => ASWHelper::oonioEncrypt(post('data_val'))
                    ]),
                    'data_val'      => ASWHelper::oonioEncrypt(post('data_val'))
                ];
            $ProjectData = $ProjectData->update($recordDatas);

                if(!$ProjectData){ // Data güncellenemedi
                }else{
                    $result = array_merge($recordDatas, ['data_id'=>$id, 'status'=>true, 'className'=>'success', 'action'=>'update', 'template'=>$this->getTrTemplate($ProjectData, true)]);
                }


        }
        $this->jsonRender($result);
    } //update






    /*============================================================================*/





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
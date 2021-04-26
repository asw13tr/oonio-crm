<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    26.04.2021 14:08
 */



class ProjectTagController extends ASWController{


    protected $models = ['ProjectTag'];
    private $tax_key = 'project_tag';





    // ETİKETLER
    function index(){
        $tag = new ProjectTag();
        $datas = [
            'items' => $tag->findAll('ORDER BY tax_id DESC')
        ];
        $this->render('projects/taxonomies', $datas);

    }



    // ETİKET EKLE
    function save(){
        $postDatas = $_POST;
        $postDatas['tax_key'] = $this->tax_key;
        $postDatas['tax_extra'] = json_encode($_POST['tax_extra']);
        $tag = new ProjectTag();
        $tag = $tag->create($postDatas);

        if(!$tag){
            ASWSession::setFlash('flash-danger', 'işlem sırasında beklenmedik bir hata oluştu.');
        }else{
            ASWSession::setFlash('flash-success', 'etiket oluşturuldu');
        }
        redirect('project.tags');
    } //createPost







    // ETİKET DÜZENLEME FORMU
    function edit($id){
        $tag = new ProjectTag($id);

        if(!$tag->primaryVal){
            ASWSession::setFlash('flash-danger', 'etiket bulunamadı');
            redirect('project.tags');
        }else{
            $datas = [
                'items' => $tag->findAll('ORDER BY tax_id DESC'),
                'tag' => $tag
            ];
            $this->render('projects/taxonomies', $datas);
        }
    } //edit


    // ETİKET BİLGİLERİNİ GÜNCELLE
    function update($id){
        $tag = new ProjectTag($id);
        if(!$tag->primaryVal){
            ASWSession::setFlash('flash-danger', 'etiket bulunamadı');
            redirect('project.tags');
        }

        $postDatas = $_POST;
        $postDatas['tax_key'] = $this->tax_key;
        $postDatas['tax_extra'] = json_encode($_POST['tax_extra']);
        $tag = $tag->update($postDatas);

        if(!$tag){
            ASWSession::setFlash('flash-danger', 'etiket güncellenirken bir sorun oluştu');
        }else{
            ASWSession::setFlash('flash-success', 'etiket bilgileri güncellendi');
        }
        redirect('project.tags');
    }







    // ETİKET SİLME
    function delete($id){
        $tag = new ProjectTag($id);
        $result = [
            'status' => false,
            'title' => _tr('bir sorun oluştu'),
            'message' => _tr('sistemde beklenmedik bir sorun oluştu ve işlem gerçekleşemedi')
        ];
        if(!$tag->primaryVal){
            $result['message'] = _tr('belirtilen etiket sistemde yok');
            $result['timer'] = 2000;
        }else{
            $delete = $tag->delete();
            // TODO: "project_taxonomy" tablosundan "tax_id" silinen id ye eşit olanları sil.
            if($delete){
                $result = [
                    'status'    => true,
                    'title'     => _tr('etiket silindi'),
                    'message'   => _tr('belirtilen etiket veritabanından silindi'),
                    'id'        => $id
                ];
            }
        }
        $this->jsonRender($result);
    } //delete


}
?>
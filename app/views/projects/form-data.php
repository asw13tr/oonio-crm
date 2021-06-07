<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    7.06.2021 14:43
 */

$panelTitle = _tr('yeni proje bilgisi ekle');
$action = url('project.data.save', ['id'=>@$project_id], false);
$onsubmit = 'return saveProjectData(event);';
$data_title = '';
$data_key = '';
$data_val = '';
$data_description = '';
$button = '<button class="btn btn-primary rounded my-2"><em class="fa fa-plus"></em> '._tr("yeni veriyi ekle").'</button>';

if(isset($data)){
    $project_id = $data->data_project;
    $panelTitle = _tr('proje bilgisini güncelle');
    $action = url('project.data.update', ['id'=>@$data->data_id], false);
    $onsubmit = 'return saveProjectData(event);';
    $data_title = $data->data_title;
    $extra = json_decode($data->data_value);
    $data_key = $extra->keyword;
    $data_val = ASWHelper::oonioDecrypt($extra->value);
    $data_description = $data->data_description;
    $button = '<button class="btn btn-success rounded my-2"><em class="fa fa-save"></em> '._tr("güncelle").'</button>';
}




?>
<div id="newProjectData" class="card bg-light m-0 p-0">
    <div class="card-header bg-dark text-light"><h5><?php echo $panelTitle; ?></h5></div>
    <div class="card-body">
        <div class="row">
            <form action="<?php echo $action; ?>" onsubmit="<?php echo $onsubmit; ?>" id="formProjectData" class="row">
                <input type="hidden" name="data_project" value="<?php echo $project_id; ?>">
                <?php
                echo ASWHelper::htmlFloatInput('data_title', $data_title, _tr('başlık'), 'col-12 my-2', 'required');
                echo ASWHelper::htmlFloatInput('data_key', $data_key, _tr('anahtar'), 'col-12 my-2', 'required');
                echo ASWHelper::htmlFloatInput('data_val', $data_val, _tr('değer (şifrelenecek)'), 'col-12 my-2', 'password');
                echo ASWHelper::htmlFloatInput('data_description', $data_description, _tr('Açıklama'), 'col-12 my-2',null, 'textarea');
                ?>

                <div class="col-12 text-end"><?php echo $button; ?></div>
            </form>
        </div>
    </div>
</div>

<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    4.06.2021 14:30
 */
?>

<div style="text-align: left">
<?php
    $connections = $project->getConnections();
    $extra = json_decode($project->project_extra);

    echo ASWHelper::getSubHeader($project->project_title, 'fa fa-chevron-right');
?>

    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th width="200"><?php echo _tr('proje'); ?></th>
            <td><?php echo $project->project_title; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('durum'); ?></th>
            <td><?php echo ($project->project_status==1)? _tr('aktif') : _tr('pasif'); ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('özet'); ?></th>
            <td><?php echo $project->project_description; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('etiketler'); ?></th>
            <td><?php foreach($connections['tags'] as $tag){ echo '<span class="btn btn-dark btn-sm m-1">'._tr($tag->tax_val).'</span>'; }; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('çalışanlar'); ?></th>
            <td><?php foreach($connections['users'] as $user){ echo '<span class="btn btn-success btn-sm m-1">'._tr($user->user_name).'</span>'; }; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('muhataplar'); ?></th>
            <td><?php foreach($connections['contacts'] as $contact){
                    $popupUrl = url('contact.popup', ['id'=>$contact->contact_id], false);
                    echo '<button class="btn btn-primary btn-sm m-1" onclick="getPopupInfo(\''.$popupUrl.'\')">'._tr($contact->contact_name).'</button>'; }
                ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('url'); ?></th>
            <td><a href="<?php echo $extra->url; ?>" target="_blank"><?php echo $extra->url; ?></a></td>
        </tr>

        <tr><th colspan="2"><?php echo _tr('ayrıntılar'); ?></th></tr>
        <tr><td colspan="2"><?php echo $project->project_content; ?></td></tr>

        <tr>
            <th width="200"><?php echo _tr('eklenme'); ?></th>
            <td><?php echo $project->project_c_time; ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('güncellenme'); ?></th>
            <td><?php echo $project->project_u_time; ?></td>
        </tr>

    </table>

    <?php ########################################################################################################### ?>
    <?php
        echo ASWHelper::getSubHeader('ilişkili veriler', 'fa fa-chevron-right',
        [
            [   'title' => _tr('veri ekle'),
                'url' => '#newProjectData',
                'class' => 'btnNewProjectData btn btn-primary btn-sm" data-bs-toggle="collapse" role="button',
                'icon' => 'fa fa-plus'
            ]
        ] );
    ?>

    <div id="newProjectData" class="card collapse bg-light">
        <div class="card-header bg-dark text-light"><h5><?php echo _tr('yeni veri bilgileri'); ?></h5></div>
        <div class="card-body p-2">
            <div class="row">
                <form action="<?php echo url('project.data.save', ['id'=>$project->project_id]); ?>" onsubmit="return createNewProjectData(event);" id="newDataForm" class="row">
                <input type="hidden" name="data_project" value="<?php echo $project->project_id; ?>">
                <?php
                echo ASWHelper::htmlFloatInput('data_title', null, _tr('başlık'), 'col-md-4 my-2', 'required');
                echo ASWHelper::htmlFloatInput('data_key', null, _tr('anahtar'), 'col-md-4 my-2', 'required');
                echo ASWHelper::htmlFloatInput('data_val', null, _tr('değer (şifrelenecek)'), 'col-md-4 my-2', 'password');
                echo ASWHelper::htmlFloatInput('data_description', null, _tr('Açıklama'), 'col-12 my-2',null, 'textarea');
                ?>

                <div class="col-12 text-end">
                    <button class="btn btn-primary rounded my-2"><?php echo _tr('yeni veriyi ekle'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>


        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th width="50">#</th>
                <th><?php echo _tr('başlık'); ?></th>
                <th><?php echo _tr('anahtar'); ?></th>
                <th><?php echo _tr('değer'); ?></th>
                <th width="100"></th>
            </tr>
            </thead>

            <tbody>

            <?php foreach($project->getDatas() as $data): $dExtra = json_decode($data->data_value); ?>
                <tr class="row-item-<?php echo $data->data_id; ?>">
                    <td><?php echo $data->data_id; ?></td>
                    <td><button class="btn btn-default btn-sm text-start"><?php echo $data->data_title; ?></button></td>
                    <td><?php echo $dExtra->keyword; ?></td>
                    <td><?php echo $dExtra->value; ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="<?php echo ''; ?>" class="btn btn-warning fa fa-edit text-center"></a>
                            <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('proje silinecek', 'projeyi silmek istediğinize emin misiniz? işlem bir daha geri alınamaz', '<?php echo 1; ?>')"></button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>





</div>


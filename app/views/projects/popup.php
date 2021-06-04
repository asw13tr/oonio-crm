<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    24.05.2021 13:07
 */
?>
<div style="text-align: left">
    <?php
    $connections = $project->getConnections();
    $extra = json_decode($project->project_extra);

    ?>

    <h3><?php echo $project->project_title; ?></h3><hr>
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

    <button class="btn btn-primary" onclick="ajaxNewDataForProject()"><i class="fa fa-plus"></i> <?php echo _tr('veri ekle'); ?></button>

</div>

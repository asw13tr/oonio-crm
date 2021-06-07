<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    7.06.2021 14:40
 */

        echo ASWHelper::getSubHeader('ilişkili veriler', 'fa fa-chevron-right',
        [

            [   'title' => _tr('yeni bilgi ekle'),
                'url' => '#" onclick="getDataProjectForm(\''.url("project.data.create", ['id'=>$project->project_id],0).'\');',
                'class' => ' btn btn-success btn-sm"  role="button',
                'icon' => 'fa fa-plus'
            ]
        ] );
    ?>
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

            <tbody id="datasTableBody">

            <?php foreach($project->getDatas() as $data): $dExtra = json_decode($data->data_value); ?>
                <tr class="row-data-item-<?php echo $data->data_id; ?>">
                    <td><?php echo $data->data_id; ?></td>
                    <td><button class="btn btn-default btn-sm text-start"><?php echo $data->data_title; ?></button></td>
                    <td><?php echo $dExtra->keyword; ?></td>
                    <td>
                        <div class="input-group">
                            <input type="text" id="dataInput<?php echo $data->data_id; ?>" class="dataInput form-control form-control-sm" placeholder="*******">
                            <button class="btn btn-sm btnDecrypt btn-outline-danger fa fa-eye" type="button"
                                    onclick="decryptProjectData('show', '<?php echo $data->urlDecrypt(); ?>', '<?php echo $dExtra->value; ?>')"></button>
                            <button class="btn btn-sm btnDecrypt btn-outline-danger fa fa-eye-slash  d-none" type="button"
                                    onclick="decryptProjectData(<?php echo $data->data_id; ?>, 0,0)"></button>
                            <button class="btn btn-sm btn-outline-primary fa fa-copy" onclick="copyToClipboard('dataInput<?php echo $data->data_id; ?>')" type="button"></button>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning fa fa-edit text-center" onclick="getDataProjectForm('<?php url('project.data.edit', ['id'=>$data->data_id]); ?>');"></button>
                            <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('proje verisi silinecek', 'bu bilgiyi silmek istediğinize emin misiniz? işlem bir daha geri alınamaz', '<?php echo $data->urlDelete(); ?>', 'tr.row-data-item-')"></button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
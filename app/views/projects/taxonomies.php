<?php echo ASWHelper::getSubHeader(_tr('proje etiketleri'), 'fa fa-tags',
    [
        [
            'title' => _tr('proje listesi'),
            'url' => url('projects', null, false),
            'class' => 'btn btn-danger btn-sm',
            'icon' => 'fa fa-chevron-left'
        ]
    ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header"><h4><?php echo _tr('etiketler'); ?></h4></div>
            <div class="card-body p-0">


                <?php if(isset($items)): ?>
                    <table class="table table-striped  table-hover">
                        <thead>
                        <tr>
                            <th width="50">#</th>
                            <th><?php echo _tr('etiket'); ?></th>
                            <th><?php echo _tr('açıklama'); ?></th>
                            <th width="100"></th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach($items as $item): $extra = json_decode($item->tax_extra); ?>
                            <tr class="row-item-<?php echo $item->tax_id; ?>">
                                <td><?php echo $item->tax_id; ?></td>
                                <td><?php echo $item->tax_val ?></td>
                                <td><?php echo $extra->description; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo $item->urlEdit(); ?>" class="btn btn-warning fa fa-edit text-center"></a>
                                        <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('etiket silinecek', 'etiketi silmek istediğinize emin misiniz?', '<?php echo $item->urlDelete(); ?>')"></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>



    <?php
    $title = _tr('etiket oluştur');
    $action = url('project.tag.save', null,false);
    $val = '';
    $description = '';
    $buttons = '<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> '._tr("oluştur").'</button>
                        <button class="btn btn-secondary" type="reset"><i class="fa fa-broom"></i> '._tr("sıfırla").'</button>';

    if(isset($tag)){
        $title = _tr('güncelle') . ' ['.$tag->tax_val.']';
        $action = url('project.tag.update', ['id' => $tag->primaryVal], false);
        $val = $tag->tax_val;
        $extra = json_decode($tag->tax_extra);
        $description = $extra->description;
        $buttons = '<button class="btn btn-success" type="submit"><i class="fa fa-save"></i> '._tr("güncelle").'</button>
                        <button class="btn btn-secondary" type="reset"><i class="fa fa-broom"></i> '._tr("sıfırla").'</button>
                        <a href="'.url("project.tags", null, false).'" class="btn btn-info"><i class="fa fa-times"></i> '._tr("vazgeç").'</a>';
    }
    ?>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $title; ?></h4>
            </div>
            <div class="card-body">
                <form action="<?php echo $action; ?>" method="post">

                    <div class="mb-3">
                        <label for="" class="form-label"><?php echo _tr('etiket'); ?></label>
                        <input type="text" class="form-control" name="tax_val" value="<?php echo $val; ?>" autofocus required/>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label"><?php echo _tr('açıklama'); ?></label>
                        <textarea name="tax_extra[description]" class="form-control" cols="30" rows="3"><?php echo $description; ?></textarea>
                    </div>
                    <div class="border-bottom mb-3"></div>
                    <div class="mb-3"><?php echo $buttons; ?></div>

                </form>
            </div>
        </div>
    </div>


</div>

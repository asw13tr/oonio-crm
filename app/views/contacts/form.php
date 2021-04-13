<?php echo ASWHelper::getSubHeader(_tr('yeni müşteri ekle'), 'fa fa-user-plus',
    [
        [   'title' => 'Vazgeç',
            'url' => url('contacts', null, false),
            'class' => 'btn btn-danger btn-sm',
            'icon' => 'fa fa-arrow-left'
        ]
    ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>

<?php
$action = url('contact.create.post', null, false);
if(isset($contact)){
    $action = url('contact.edit.post', ['id'=>$contact->contact_id], false);
}
?>

<div class="card my-3 col-sm-6">
    <div class="card-header ">
        <a href="<?php url('contacts'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-list-ul"></i> <?php echo _tr('müşteri listesi'); ?></a>
    </div>

    <div class="card-body  crm-form">
        <form action="<?php echo $action; ?>" method="POST">


            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('hitap'); ?></label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="contact_gender" id="contact_gender1" value="male">
                        <label class="form-check-label" for="contact_gender1"><?php echo _tr('bay'); ?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="contact_gender" id="contact_gender2" value="female">
                        <label class="form-check-label" for="contact_gender2"><?php echo _tr('bayan'); ?></label>
                    </div>
                </div>
            </div>


            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('müşteri adı'); ?></label>
                <div class="col">
                    <input type="text" class="form-control" name="contact_name" require autofocus/>
                </div>
            </div>


            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('e-posta'); ?></label>
                <div class="col">
                    <input type="email" class="form-control" name="contact_email"/>
                </div>
            </div>


            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('cep numarası'); ?></label>
                <div class="col">
                    <input type="tel" class="form-control" name="contact_mobile"/>
                </div>
            </div>


            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('telefon numarası'); ?></label>
                <div class="col">
                    <input type="tel" class="form-control" name="contact_phone"/>
                </div>
            </div>

            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('fax'); ?></label>
                <div class="col">
                    <input type="tel" class="form-control" name="contact_extra['fax']"/>
                </div>
            </div>


            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('adres'); ?></label>
                <div class="col">
                    <textarea class="form-control" name="contact_address"></textarea>
                </div>
            </div>

            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('hobiler'); ?></label>
                <div class="col">
                    <input type="text" class="form-control" name="contact_extra['hobbies']"/>
                </div>
            </div>

            <div class="mb-2 row border-bottom pb-2 border-bottom pb-2">
                <label class="col-sm-3 col-form-label" for=""><?php echo _tr('açıklama'); ?></label>
                <div class="col">
                    <textarea type="text" class="form-control" name="contact_extra['description']"></textarea>
                </div>
            </div>





            <div class="">
                <?php if(isset($contact)): ?>
                    <button class="btn btn-primary" name="contact" value="create" ><div class="fa fa-save"></div> <?php echo _tr('güncelle') ?></button>
                <?php else: ?>
                    <button class="btn btn-primary" name="contact" value="create" ><div class="fa fa-save"></div> <?php echo _tr('kaydet') ?></button>
                <?php endif; ?>

            </div>



        </form>
    </div>
</div>

<?php echo ASWHelper::getSubHeader(_tr('müşteri rehberi'), 'fa fa-address-book',
    [
        [   'title' => 'Kişi Ekle',
            'url' => url('contact.create', null, false),
            'class' => 'btn btn-primary btn-sm',
            'icon' => 'fa fa-plus'
        ]
    ] ); ?>
<?php require_once(__DIR__.'/../flash-messages.php'); ?>
<?php if(isset($contacts)): ?>
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th width="50">#</th>
            <th><?php echo _tr('hitap'); ?></th>
            <th><?php echo _tr('müşteri'); ?></th>
            <th width="260"><?php echo _tr('e-posta'); ?></th>
            <th width="130"><?php echo _tr('cep numarası'); ?></th>
            <th width="130"><?php echo _tr('sabit hat'); ?></th>
            <th><?php echo _tr('adres'); ?></th>
            <th width="100"></th>
        </tr>
        </thead>

        <tbody>

        <?php foreach($contacts as $contact): ?>
            <tr class="row-item-<?php echo $contact->contact_id; ?>">
                <td><?php echo $contact->contact_id; ?></td>
                <td><?php echo $contact->contact_gender=='female'? _tr('bayan') : _tr('bay'); ?></td>
                <td><?php echo $contact->contact_name; ?></td>
                <td><a href="mailto:<?php echo $contact->contact_email; ?>" class="text-decoration-none text-dark"><i class="fa fa-paper-plane"></i> <?php echo $contact->contact_email; ?></a></td>
                <td><a href="tel:<?php echo $contact->contact_mobile; ?>" class="text-decoration-none text-dark"><i class="fa fa-mobile-alt"></i> <?php echo $contact->contact_mobile; ?></a></td>
                <td><a href="tel:<?php echo $contact->contact_phone; ?>" class="text-decoration-none text-dark"><i class="fa fa-phone-volume"></i> <?php echo $contact->contact_phone; ?></a></td>
                <td><?php echo $contact->contact_address; ?></td>

                <td>
                    <div class="btn-group">
                        <button class="btn btn-primary fa fa-info text-center"></button>
                        <a href="<?php echo $contact->urlEdit(); ?>" class="btn btn-warning fa fa-edit text-center"></a>
                        <button class="btn btn-danger fa fa-trash text-center" onclick="sweetDel('müşteri silinecek', 'müşteriyi silmek istediğinize emin misiniz?', '<?php echo $contact->urlDelete(); ?>')"></button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
<?php endif; ?>

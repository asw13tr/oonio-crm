<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    23.05.2021 17:45
 */
?>
<div style="text-align: left">

    <h3><?php echo $contact->contact_name; ?></h3><hr>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th><?php echo _tr('cinsiyet'); ?></th>
            <td><?php echo $contact->contact_gender=='female'? _tr('bayan') : _tr('bay'); ?></td>
        </tr>

        <tr>
            <th width="200"><?php echo _tr('müşteri'); ?></th>
            <td><?php echo $contact->contact_name; ?></td>
        </tr>

        <tr>
            <th><?php echo _tr('doğum tarihi'); ?></th>
            <td><?php if($contact->contact_birth){ echo date('d F Y', strtotime($contact->contact_birth)); } ?></td>
        </tr>

        <tr>
            <th><?php echo _tr('e-posta'); ?></th>
            <td><a href="mailto:<?php echo $contact->contact_email; ?>"><?php echo $contact->contact_email; ?></a></td>
        </tr>

        <tr>
            <th><?php echo _tr('telefon'); ?></th>
            <td><a href="teil:<?php echo $contact->contact_phone; ?>"><?php echo $contact->contact_phone; ?></a></td>
        </tr>

        <tr>
            <th><?php echo _tr('mobil'); ?></th>
            <td><a href="teil:<?php echo $contact->contact_mobile; ?>"><?php echo $contact->contact_mobile; ?></a></td>
        </tr>

        <tr>
            <th><?php echo _tr('adres'); ?></th>
            <td><?php echo $contact->contact_address; ?></td>
        </tr>

        <tr>
            <th><?php echo _tr('kayıt'); ?></th>
            <td><?php echo $contact->contact_c_time; ?></td>
        </tr>

        <tr>
            <th><?php echo _tr('güncellenme'); ?></th>
            <td><?php echo $contact->contact_u_time; ?></td>
        </tr>
    </table>

</div>



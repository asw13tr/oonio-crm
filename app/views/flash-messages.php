<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    10.04.2021 23:29
 */


if (ASWSession::hasFlash('flash-danger')) {
    echo ASWHelper::htmlAlert(null, ASWSession::getFlash('flash-danger'), 'danger');
}

if (ASWSession::hasFlash('flash-warning')) {
    echo ASWHelper::htmlAlert(null, ASWSession::getFlash('flash-warning'), 'warning');
}

if (ASWSession::hasFlash('flash-info')) {
    echo ASWHelper::htmlAlert(null, ASWSession::getFlash('flash-info'), 'info');
}

if (ASWSession::hasFlash('flash-success')) {
    echo ASWHelper::htmlAlert(null, ASWSession::getFlash('flash-success'));
}

?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand p-0" href="<?php url('home'); ?>"><img src="<?php url('static/img/logo.svg'); ?>" height="40" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('home'); ?>"><i class="fa fa-tachometer-alt"></i> Başlangıç</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('tasks'); ?>"><i class="fa fa-tasks"></i> Görevler</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('projects'); ?>"><i class="fa fa-briefcase"></i> Projeler</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('contacts'); ?>"><i class="fa fa-address-book"></i> Müşteriler</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('documents'); ?>"><i class="fa fa-folder-open"></i> Dökümanlar</a></li>
            <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('users'); ?>"><i class="fa fa-users"></i> Kullanıcılar</a></li>
        </ul>

        <ul class="navbar-nav me-0 mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" aria-current="page" href="<?php url('logout'); ?>"><i class="fa fa-sign-out-alt"></i> Çıkış</a></li>
        </ul>

    <?php /*
    <form class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    */ ?>
    </div>
</div>
</nav>
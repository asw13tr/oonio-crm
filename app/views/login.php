<?php
/*
 * Company: OONIO | oonio.de
 * Coder:   Furkan Atabaş | atabasch.com
 * Date:    25.05.2021 14:45
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php url('/static/oonio.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Oonio CRM</title>
    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 00px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-floating:focus-within {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body class="text-center">

<main class="form-signin">
    <form action="<?php url('login.post'); ?>" method="post">
        <input type="hidden" name="to" value="<?php echo $to; ?>">
        <img class="mb-4" src="/static/img/logo-dark.svg" alt="" height="100">
        <?php require_once(__DIR__.'/flash-messages.php'); ?>
        <div class="form-floating">
            <input type="name" name="username" class="form-control" id="floatingInput" placeholder="Nutzername">
            <label for="floatingInput">Nutzername</label>
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Passwort</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember" value="1"> Mich erinnern
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Einloggen</button>
        <p class="mt-5 mb-3 text-muted">Oonio &copy; 2010–<?php echo date('Y'); ?></p>
    </form>
</main>



</body>
</html>

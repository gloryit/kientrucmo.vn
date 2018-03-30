<?php
/**
 * @var \PahAdmin\View\AdminView $this
 * @var string $page_title
 */
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= ($page_title)??'Admin Pah'; ?></title>

<meta name="_csrfToken" content="<?= $this->request->getParam('_csrfToken') ?>">

<!-- Bootstrap -->
<link href="/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<!-- Font Awesome -->
<link href="/libs/font-awesome/css/font-awesome.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,900&amp;subset=latin,latin-ext,vietnamese" rel="stylesheet">
<!-- iCheck -->
<link href="/gentelella/vendors/iCheck/skins/flat/green.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<!-- bootstrap-progressbar -->
<link href="/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">
<!-- jVectorMap -->
<link href="/gentelella/production/css/maps/jquery-jvectormap-2.0.3.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet"/>
<link href="/libs/animate.css/animate.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">

<?= $this->fetch('styles_top') ?>

<!-- Custom Theme Style -->
<link href="/libs/custom.css?v=<?= ASSETS_VERSION ?>" rel="stylesheet">


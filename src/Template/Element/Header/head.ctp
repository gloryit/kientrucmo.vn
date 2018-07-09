<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 12/31/2017
 * Time: 3:01 AM
 *
 * @var string $keywords
 * @var string $description
 * @var string $generator
 * @var string $title
 * @var \App\View\AppView $this
 */
?>
<base href="/" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?= h($keywords) ?>" />
<meta name="description" content="<?= h($description) ?>" />
<meta name="author" content="kientrucmo" />
<meta name="generator" content="<?= h($generator) ?>" />
<meta name="robots" content="index, follow" >
<meta property="og:title" content="<?= h($title) ?>" >
<meta property="og:url" content="<?= $this->Url->build($this->request->getUri()->getPath(), true) ?>" >
<meta property="og:image" content="<?= $this->Url->build('/logo/favicon.png', true) ?>" >
<meta property="og:description" content="<?= h($description) ?>" >
<meta property="og:type" content="website" />
<title><?= h($title) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="/logo/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/css/template.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/css/responsive.css" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/jquery-noconflict.js" type="text/javascript"></script>
<script src="/js/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/js/caption.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/global.js" type="text/javascript"></script>
<script src="/js/init.js" type="text/javascript"></script>
<script src="/js/mootools-core.js" type="text/javascript"></script>
<script src="/js/core.js" type="text/javascript"></script>
<script src="/js/jquery.drawer.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/jquery.hoversliding.js"></script>

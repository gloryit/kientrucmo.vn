<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->element('Admin/Header/head') ?>
</head>

<body class="nav-md footer_fixed">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?= $this->Url->build(['controller' => 'Posts', 'action' => 'index', 'plugin' => 'PahAdmin']) ?>" class="site_title"><i class="fa fa-paw"></i> <span>Kiến trúc PAH</span></a>
                </div>

                <div class="clearfix"></div>

                <?= $this->element('Admin/SideMenu/menu_profile') ?>

                <br />

                <?= $this->element('Admin/SideMenu/sidebar_menu') ?>

                <?= $this->element('Admin/Footer/footer_buttons') ?>
            </div>
        </div>
        <?= $this->element('Admin/Header/top_navigation') ?>
        <div class="right_col" role="main">
            <!-- top tiles -->
            <?= $this->fetch('content') ?>
        </div>
        <?= $this->element('Admin/Footer/footer') ?>
    </div>
</div>

<?= $this->element('Admin/Footer/scripts') ?>

</body>
</html>

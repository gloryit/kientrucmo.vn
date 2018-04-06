<?php
/**
 * @var \PahAdmin\View\AdminView $this
 */
?>
<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="/images/img.jpg" alt=""><?= $user['first_name'] . ' ' . $user['last_name'] ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= $this->Url->build(['_name' => 'app:homes']) ?>" target="_blank"><i class="fa fa-google-plus-circle pull-right"></i> View Site</a></li>
                        <li><a href="#"><i class="fa fa-sign-out pull-right"></i> Change Password</a></li>
                        <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout', 'plugin' => 'PahAdmin']) ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

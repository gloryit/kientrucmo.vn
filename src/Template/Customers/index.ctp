<?php
/**
 * Created by PhpStorm.
 * User: minhphuc
 * Date: 06/01/2018
 * Time: 10:04
 *
 * @var \App\Model\Entity\Post $post
 * @var \App\Model\Entity\Menu $menu
 * @var \App\View\AppView $this
 */

?>

<?php if ($post): ?>
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <?= $this->element('Posts/detail') ?>

            <?= $this->element('Sidebar/sidebar') ?>
        </div>
    </div>
<?php endif ?>

<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 7:21 PM
 *
 * @var \App\Model\Entity\Post $post
 * @var \App\Model\Entity\Group $group
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

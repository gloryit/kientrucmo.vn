<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu[] $menus
 * @var \App\Model\Entity\Menu[] $child_menus
 */
?>
<ul class="nav menu nav-pills vtem-menu" id="menu14e52c68f0e7306">
    <?php foreach ($menus as $menu) : ?>
        <?php if (!$menu->parent_menu && $menu->level == 0): ?>
            <li class="item-188 deeper parent">
                <a href="#" class="text-uppercase"><?= $menu->name ?></a>
            </li>
        <?php else : ?>
            <li class="item-103 deeper parent">
                <span class="text-uppercase"><?= h($menu->name) ?></span>
                <ul class="nav-child unstyled small">
                    <?php foreach ($child_menus as $child) : ?>
                        <?php if ($child->parent_id === $menu->id) : ?>
                            <li class="item-1 text-uppercase"><a href="#"><?= h($child->name) ?></a></li>
                        <?php endif ?>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
    <?php endforeach ?>
</ul>

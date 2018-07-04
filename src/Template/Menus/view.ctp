<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Posts'), ['controller' => 'Posts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Post'), ['controller' => 'Posts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Parent Menu') ?></th>
            <td><?= $menu->has('parent_menu') ? $this->Html->link($menu->parent_menu->name, ['controller' => 'Menus', 'action' => 'view', $menu->parent_menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($menu->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($menu->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($menu->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($menu->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($menu->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($menu->is_active) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($menu->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($menu->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Menus') ?></h4>
        <?php if (!empty($menu->child_menus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->child_menus as $childMenus): ?>
            <tr>
                <td><?= h($childMenus->id) ?></td>
                <td><?= h($childMenus->parent_id) ?></td>
                <td><?= h($childMenus->lft) ?></td>
                <td><?= h($childMenus->rght) ?></td>
                <td><?= h($childMenus->name) ?></td>
                <td><?= h($childMenus->slug) ?></td>
                <td><?= h($childMenus->description) ?></td>
                <td><?= h($childMenus->is_active) ?></td>
                <td><?= h($childMenus->created) ?></td>
                <td><?= h($childMenus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $childMenus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $childMenus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $childMenus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childMenus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Posts') ?></h4>
        <?php if (!empty($menu->posts)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Uri') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Header') ?></th>
                <th scope="col"><?= __('Content') ?></th>
                <th scope="col"><?= __('Dsp Order') ?></th>
                <th scope="col"><?= __('Is Active') ?></th>
                <th scope="col"><?= __('Menu Id') ?></th>
                <th scope="col"><?= __('Author') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->posts as $posts): ?>
            <tr>
                <td><?= h($posts->id) ?></td>
                <td><?= h($posts->uri) ?></td>
                <td><?= h($posts->title) ?></td>
                <td><?= h($posts->slug) ?></td>
                <td><?= h($posts->header) ?></td>
                <td><?= h($posts->content) ?></td>
                <td><?= h($posts->dsp_order) ?></td>
                <td><?= h($posts->is_active) ?></td>
                <td><?= h($posts->menu_id) ?></td>
                <td><?= h($posts->author) ?></td>
                <td><?= h($posts->created) ?></td>
                <td><?= h($posts->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>

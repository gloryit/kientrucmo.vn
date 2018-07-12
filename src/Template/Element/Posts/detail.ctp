<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/2/2018
 * Time: 10:18 PM
 *
 * @var \App\Model\Entity\Post $post
 * @var \App\Model\Entity\Menu $menu
 * @var \App\View\AppView $this
 * @var string $isPage
 */
?>

<div class="vtem-section-inside container clearfix">
    <div class="row section-content clearfix">
        <div id="block14f6445da903186" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-component  col-md-8   " data-vgrid="8">
            <div class="vtem-block-inside clearfix">
                <div class="item-page" itemscope="" itemtype="https://schema.org/Article">
                    <meta itemprop="inLanguage" content="vi-VN">
                    <div class="page-header">
                        <h2 itemprop="headline">
                            <?= h($post->title) ?>
                        </h2>
                    </div>
                    <dl class="article-info muted">
                        <dt class="article-info-term">
                            Chi tiết
                        </dt>
                        <dd class="createdby" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                            Viết bởi <span itemprop="name"><?= h($post->author) ?></span>
                        </dd>
                        <dd class="category-name">
                            Chuyên mục: <a href="<?= $this->Url->build(h($post->menu->slug), true) ?>" itemprop="genre"><?= h($post->menu->name) ?></a>
                        </dd>
                        <dd class="create">
                            <span class="icon-calendar" aria-hidden="true"></span>
                            <time datetime="2015-01-22T17:47:37+07:00" itemprop="dateCreated">Được viết: <?= h(date_format($post->created, 'd/m/Y')) ?></time>
                        </dd>
                    </dl>
                    <div itemprop="articleBody">
                        <?= $this->Escape->purify($post->content) ?>

                        <?= $this->element('Modules/dichvu')?>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->element('Sidebar/sidebar') ?>
    </div>
</div>

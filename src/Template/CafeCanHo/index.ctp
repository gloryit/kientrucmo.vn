<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 11:04 PM
 *
 * @var \App\Model\Entity\Post[] $posts
 * @var \App\Model\Entity\Menu $menu
 * @var \App\View\AppView $this
 * @var string $isPage
 */
?>

<div id="section14f6445ba467817" class="vtem-section main-content clearfix"
     style="background-color:rgb(34, 34, 34); color:#222222;">
    <div class="vtem-section-inside container clearfix">
        <div class="row section-content clearfix">
            <div id="block14f6445da903186" style="background-color:rgba(255, 255, 255, 0); color:#333333"
                 class="vtem-block system widget-component  col-md-8   " data-vgrid="8">
                <div class="vtem-block-inside clearfix">
                    <?php if ($posts): ?>
                        <div class="blog" itemscope="" itemtype="https://schema.org/Blog">
                            <div class="items-row cols-2 row-0 row-fluid clearfix">
                                <?php foreach ($posts as $post): ?>
                                    <div class="span6">
                                        <div class="item column-1" itemprop="blogPost" itemscope="" itemtype="https://schema.org/BlogPosting">
                                            <div class="page-header">
                                                <h2 itemprop="name">
                                                    <a href="<?= $this->Url->build(['_name' => $isPage . ':view', h($post->slug)]) ?>" itemprop="url"><?= h($post->title) ?></a>
                                                </h2>
                                            </div>
                                            <dl class="article-info muted">
                                                <dt class="article-info-term">Chi tiết</dt>
                                                <dd class="createdby" itemprop="author" itemscope="" itemtype="https://schema.org/Person">Viết bởi <span itemprop="name"><?= h($post->author) ?></span></dd>
                                                <dd class="category-name">Chuyên mục: <a href="#" itemprop="genre"><?= $post->menu->name ?></a></dd>
                                                <dd class="create">
                                                    <span class="icon-calendar" aria-hidden="true"></span>
                                                    <time datetime="<?= h($post->created) ?>" itemprop="dateCreated">Được viết: <?= h(date_format($post->created, 'd/m/Y')) ?></time>
                                                </dd>
                                            </dl>
                                            <p>
                                                <img property="image" src="<?= h($post->link_images) ?>" alt="<?= h($post->slug) ?>" width="350" height="250" style="width: 350px; height: 250px">
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <?= ''//$this->element('pagination') ?>
                    <?php endif ?>
                </div>
            </div>

            <?= $this->element('Sidebar/sidebar') ?>
        </div>
    </div>
</div>

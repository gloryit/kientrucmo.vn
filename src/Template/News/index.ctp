<?php
/**
 * Created by PhpStorm.
 * User: glory
 * Date: 1/4/2018
 * Time: 7:17 PM
 *
 * @var \App\Model\Entity\Post[] $posts
 * @var \App\Model\Entity\Group $group
 * @var \App\View\AppView $this
 */
?>

<div class="vtem-section-inside container clearfix">
    <div class="row section-content clearfix">
        <div id="block14f6445da903186" style="background-color:rgba(255, 255, 255, 0); color:#333333" class="vtem-block system widget-component  col-md-8   " data-vgrid="8">
            <div class="vtem-block-inside clearfix">
                <div class="blog" itemscope="" itemtype="https://schema.org/Blog">
                    <?php foreach ($posts as $post): ?>
                        <div class="items-row cols-1 row-0 row-fluid clearfix">
                            <div class="span12">
                                <div class="item column-1" itemprop="blogPost" itemscope="" itemtype="https://schema.org/BlogPosting">
                                    <div class="page-header">
                                        <h2 itemprop="name">
                                            <a href="<?= $this->Url->build(['_name' => 'news:view', h($post->slug)]) ?>" itemprop="url"><?= h($post->title) ?></a>
                                        </h2>
                                    </div>
                                    <dl class="article-info muted">
                                        <dt class="article-info-term">
                                            Chi tiết							</dt>
                                        <dd class="createdby" itemprop="author" itemscope="" itemtype="https://schema.org/Person">
                                            Viết bởi <span itemprop="name"><?= h($post->author) ?></span> </dd>
                                        <dd class="category-name">
                                            Chuyên mục: <a href="<?= $this->Url->build(['_name' => 'app:news']) ?>" itemprop="genre"><?= h($group->title) ?></a> </dd>
                                        <dd class="create">
                                            <span class="icon-calendar" aria-hidden="true"></span>
                                            <time datetime="2018-01-03T12:17:32+07:00" itemprop="dateCreated">
                                                Được viết: 03 Tháng 1 2018					</time>
                                        </dd>
                                    </dl>
                                    <div><img src="<?= h($post->link_images) ?>" alt="Thiet ke noi that + p a h vn nha 1" width="350" height="526" style="margin: 2px 10px 10px 5px; float: left;"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                    <?= ''//$this->element('pagination') ?>
                </div>
            </div>
        </div>
        <?= $this->element('Sidebar/sidebar') ?>
    </div>
</div>

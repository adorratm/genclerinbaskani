<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?= $page_title ?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>

<section class="services-one">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline"><?= $settings->company_name ?></span>
            <h2 class="section-title__title"><?= $page_title ?></h2>
        </div>
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php if (!empty($blogs)) : ?>
                <?php foreach ($blogs as $key => $value) : ?>
                    <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                        <!--Services One Single Start-->
                        <div class="col-xl-4 col-lg-4 wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <div class="services-one__single h-100">
                                <div class="services-one__single-inner">
                                    <div class="services-one__shape-1">
                                        <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-1.webp") ?>" alt="<?= $value->title ?>">
                                    </div>
                                    <div class="services-one__shape-2">
                                        <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-2.webp") ?>" alt="<?= $value->title ?>">
                                    </div>
                                    <a href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= lang("viewBlog") ?>">
                                        <div class="services-one__img-box">
                                            <div class="services-one__img">
                                                <img width="1000" height="1000" data-src="<?= get_picture("blogs_v", $value->img_url) ?>" class="img-fluid lazyload" alt="<?= $value->title ?>" title="<?= $value->title ?>" />
                                            </div>
                                        </div>
                                    </a>
                                    <h3 class="services-one__title"><a href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/" . $value->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= $value->title ?></a></h3>
                                    <p class="services-one__text">
                                        <?php foreach ($categories as $k => $v) : ?>
                                            <?php if ($v->id == $value->category_id) : ?>
                                                <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><?= $v->title ?></a>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </p>
                                    <div class="services-one__btn-box">
                                        <a class="services-one__btn" href="<?= base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$value->seo_url}") ?>" title="<?= $value->title ?>"><?= lang("viewBlog") ?> <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Services One Single End-->
                    <?php endif ?>
                <?php endforeach ?>
                <?php if (!empty($links)) : ?>
                    <div class="col-12 text-center">
                        <div class="blog-page__pagination">
                            <?= @$links ?>
                        </div>
                    </div>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>
</section>
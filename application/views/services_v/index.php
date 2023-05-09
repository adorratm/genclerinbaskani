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
            <?php if (!empty($services)) : ?>
                <?php foreach ($services as $k => $v) : ?>
                    <!--Services One Single Start-->
                    <div class="col-xl-4 col-lg-4 wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                        <div class="services-one__single h-100">
                            <div class="services-one__single-inner">
                                <div class="services-one__shape-1">
                                    <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-1.webp") ?>" alt="<?= $v->title ?>">
                                </div>
                                <div class="services-one__shape-2">
                                    <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-2.webp") ?>" alt="<?= $v->title ?>">
                                </div>
                                <a href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>">
                                    <div class="services-one__img-box">
                                        <div class="services-one__img">
                                            <img width="1000" height="1000" data-src="<?= get_picture("services_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" />
                                        </div>
                                    </div>
                                </a>
                                <h3 class="services-one__title"><a href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= $v->title ?></a></h3>
                                <div class="services-one__btn-box">
                                    <a class="services-one__btn" href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= lang("viewService") ?> <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Services One Single End-->
                <?php endforeach ?>
                <?php if (empty($services)) : ?>
                    <div class="col-12">
                        <div class="alert alert-warning rounded-0 shadow" role="alert">
                            <h4 class="alert-heading"><?= lang("warning") ?></h4>
                            <p><?= lang("weCantFindAnyServicesWithYourSearch") ?></p>
                            <hr>
                            <p class="mb-0"><?= lang("youCanSearchDifferentServices") ?></p>
                        </div>
                    </div>
                <?php endif ?>
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
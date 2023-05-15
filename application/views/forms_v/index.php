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
            <?php if (!empty($forms)) : ?>
                <?php foreach ($forms as $k => $v) : ?>
                    <!--Services One Single Start-->
                    <div class="col-xl-4 col-lg-4 mb-4">
                        <div class="item-listing-container-skrn">
                            <a href="<?= base_url(lang("routes_forms") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewForm") ?>"> <img width="1000" height="1000" data-src="<?= get_picture("forms_v", $v->img_url) ?>" class="img-fluid lazyload" alt="<?= $v->title ?>" title="<?= $v->title ?>" /></a>
                            <div class="item-listing-text-skrn">
                                <div class="item-listing-text-skrn-vertical-align">
                                    <h6>
                                        <a href="<?= base_url(lang("routes_forms") . "/" . $v->seo_url) ?>" rel="dofollow" title="<?= lang("viewForm") ?>">
                                            <?= $v->title ?>
                                        </a>
                                    </h6>
                                </div><!-- close .item-listing-text-skrn-vertical-align -->
                            </div><!-- close .item-listing-text-skrn -->
                        </div>
                    </div>
                    <!--Services One Single End-->
                <?php endforeach ?>
                <?php if (empty($forms)) : ?>
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
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($slides)) : ?>
    <div class="flexslider progression-studios-dashboard-slider">
        <ul class="slides">
            <?php $i = 0 ?>
            <?php foreach ($slides as $key => $value) : ?>
                <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                    <?php $sUrl = null; ?>
                    <?php if ($value->allowButton) : ?>
                        <?php if (!empty($value->button_url)) : ?>
                            <?php $sUrl = $value->button_url ?>
                        <?php endif ?>
                        <?php if (!empty($value->category_id) && $value->category_id > 0) : ?>
                            <?php $sCategory = $this->general_model->get("service_categories", null, ["isActive" => 1, "id" => $value->category_id]); ?>
                            <?php if (!empty($sCategory)) : ?>
                                <?php $sUrl = base_url(lang("routes_services") . "/" . $sCategory->seo_url) ?>
                            <?php endif ?>
                        <?php endif ?>
                        <?php if (!empty($value->service_id) && $value->service_id > 0) : ?>
                            <?php $sService = $this->general_model->get("services", null, ["isActive" => 1, "id" => $value->service_id]); ?>
                            <?php if (!empty($sService)) : ?>
                                <?php $sUrl = base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $sService->seo_url) ?>
                            <?php endif ?>
                        <?php endif ?>
                        <?php if (!empty($value->page_id) && $value->page_id > 0) : ?>
                            <?php $sPage = $this->general_model->get("service_categories", null, ["isActive" => 1, "id" => $value->page_id]); ?>
                            <?php if (!empty($sPage)) : ?>
                                <?php $sUrl = base_url(lang("routes_services") . "/" . $sPage->seo_url) ?>
                            <?php endif ?>
                        <?php endif ?>
                        <?php if (!empty($value->sector_id) && $value->sector_id > 0) : ?>
                            <?php $sSector = $this->general_model->get("sectors", null, ["isActive" => 1, "id" => $value->sector_id]); ?>
                            <?php if (!empty($sSector)) : ?>
                                <?php $sUrl = base_url(lang("routes_sectors") . "/" . lang("routes_sector_detail") . "/" . $sSector->url) ?>
                            <?php endif ?>
                        <?php endif ?>
                    <?php endif ?>
                    <li class="progression_studios_animate_left">
                        <div class="progression-studios-slider-dashboard-image-background">



                            <div class="progression-studios-slider-display-table position-absolute">
                                <div class="progression-studios-slider-vertical-align">

                                    <div class="container">
                                        <?php if (!empty($value->video_url) && !empty($value->video_caption)) : ?>
                                            <a class="progression-studios-slider-play-btn afterglow" href="#VideoLightbox-<?= $i ?>" rel="dofollow" title="<?= $value->video_caption ?>"><i class="fas fa-play"></i></a>
                                            <video id="VideoLightbox-<?= $i ?>" width="960" height="540" data-youtube-id="<?= $value->video_url ?>"></video>
                                        <?php endif ?>

                                        <div class="progression-studios-slider-dashboard-caption-width">
                                            <div class="progression-studios-slider-caption-align">
                                                <h2><a href="<?= $sUrl == null ? base_url() : $sUrl ?>" title="<?= $value->title ?>" rel="dofollow"><?= $value->title ?></a></h2>
                                                <p class="progression-studios-slider-description"><?= $value->description ?></p>
                                                <?php if ($value->allowButton) : ?>
                                                    <a class="btn btn-green-pro btn-slider-pro btn-shadow-pro afterglow" href="<?= $sUrl == null ? base_url() : $sUrl ?>" title="<?= $value->title ?>" rel="dofollow"><i class="fas fa-link"></i> <?= $value->button_caption ?></a>
                                                <?php endif ?>

                                                <div class="clearfix"></div>

                                            </div><!-- close .progression-studios-slider-caption-align -->
                                        </div><!-- close .progression-studios-slider-caption-width -->

                                    </div><!-- close .container -->

                                </div><!-- close .progression-studios-slider-vertical-align -->
                            </div><!-- close .progression-studios-slider-display-table -->

                            <?php if (!empty($value->allowButton) && !empty($value->button_caption) && !empty($sUrl)) : ?>
                                <a rel="dofollow" title="<?= $value->title ?>" href="<?= $sUrl ?>">
                                    <img width="1920" height="750" data-src="<?= get_picture("slides_v", $value->img_url) ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                                </a>
                            <?php else : ?>
                                <img width="1920" height="750" data-src="<?= get_picture("slides_v", $value->img_url) ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                            <?php endif ?>

                            <div class="progression-studios-slider-mobile-background-cover"></div>
                        </div><!-- close .progression-studios-slider-image-background -->
                    </li>
                    <?php $i++ ?>
                <?php endif ?>
            <?php endforeach ?>
        </ul>
    </div><!-- close .progression-studios-slider - See /js/script.js file for options -->
<?php endif ?>
<div class="dashboard-container">
    <?php $this->load->view(@str_replace("/index", "", $this->viewFolder) . "/desktop"); ?>
</div>
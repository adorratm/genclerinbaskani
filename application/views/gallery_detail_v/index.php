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
        <div class="row align-items-stretch align-self-stretch align-content-stretch <?= ($gallery->gallery_type != "files" ? "lightgallery" : null) ?>">
            <?php if (!empty($gallery_items)) : ?>
                <?php $j = 0 ?>
                <?php foreach ($gallery_items as $key => $value) : ?>
                    <?php if ($gallery->gallery_type == "files") : ?>
                        <?php $extension = pathinfo(FCPATH . "galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}/" . $value->url)["extension"] ?>
                        <div class="<?= strto("lower", $extension) === "pdf" ? "col-lg-6 col-md-12" : "col-xl-4 col-lg-4" ?>  wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <?php if (strto("lower", $extension) === "pdf") : ?>
                                <iframe loading="lazy" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" frameborder="0" class="w-100 lazyload vh-100"></iframe>
                            <?php else : ?>
                                <div class="services-one__single h-100">
                                    <div class="services-one__single-inner">
                                        <div class="services-one__shape-1">
                                            <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-1.webp") ?>" alt="<?= $value->title ?>">
                                        </div>
                                        <div class="services-one__shape-2">
                                            <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-2.webp") ?>" alt="<?= $value->title ?>">
                                        </div>
                                        <div class="services-one__img-box">
                                            <div class="services-one__img">
                                                <img width="1000" height="1000" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $gallery->img_url) ?>" class="img-fluid lazyload" alt="<?= $value->title ?>" title="<?= $value->title ?>" />
                                            </div>
                                        </div>
                                        <h3 class="services-one__title"><a rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?>><?= !empty($value->title) && !empty($extension) ? $value->title . "." . $extension : $value->url ?></a></h3>
                                        <div class="services-one__btn-box">
                                            <a class="services-one__btn" rel="dofollow" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" alt="<?= $value->title ?>" <?= (!empty($extension) && $extension != "pdf" ? "download='" . (!empty($value->title) ? $value->title . "." . $extension : null) . "'" : "target='_blank'") ?>><i class="fa fa-download"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php else : ?>
                        <div class="<?= ($gallery->gallery_type == "videos" || $gallery->gallery_type == "video_urls" ? "col-12 col-lg-6 col-xl-6" : "col-xl-4 col-lg-4") ?> wow fadeInUp animated mb-4" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
                            <?php if ($gallery->gallery_type == "videos") : ?>
                                <video id="my-video<?= $key ?>" controls preload="auto" width="100%">
                                    <source src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" />
                                </video>
                            <?php elseif ($gallery->gallery_type == "video_urls") : ?>
                                <?= htmlspecialchars_decode($value->url) ?>
                            <?php else : ?>
                                <div class="services-one__single h-100">
                                    <div class="services-one__single-inner">
                                        <div class="services-one__shape-1">
                                            <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-1.webp") ?>" alt="<?= $value->title ?>">
                                        </div>
                                        <div class="services-one__shape-2">
                                            <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/shapes/services-one-shape-2.webp") ?>" alt="<?= $value->title ?>">
                                        </div>
                                        <a class="lightimg lightimg<?= $j ?>" rel="dofollow" data-exthumbimage="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" href="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" title="<?= $value->title ?>">
                                            <div class="services-one__img-box">
                                                <div class="services-one__img">
                                                    <img width="1000" height="1000" data-src="<?= get_picture("galleries_v/{$gallery->gallery_type}/{$gallery->folder_name}", $value->url) ?>" class="img-fluid lazyload" alt="<?= $value->title ?>" title="<?= $value->title ?>" />
                                                </div>
                                            </div>
                                        </a>
                                        <?php if (!empty($value->title) || !empty($value->description)) : ?>
                                            <h3 class="services-one__title"><a href="<?= base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/" . $value->url) ?>" rel="dofollow" title="<?= lang("viewService") ?>"><?= $value->title ?></a></h3>
                                            <p class="services-one__text"><?= $value->description ?></p>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    <?php endif ?>
                    <?php $j++ ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>
    </div>
    </div>
</section>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        if (($('#lightgallery, .lightgallery').length > 0)) {
            $('#lightgallery, .lightgallery').lightGallery({
                selector: '.lightimg',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage'
            })
        }
    });
</script>
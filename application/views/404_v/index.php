<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?=lang("pageNotFound")?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>

<div class="dashboard-container">
    <!-- About Section Start -->
    <div class="section section-padding">
        <div class="container">
            <!-- About Image/Content Start -->
            <div class="about-image-content-area">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8 text-center mb-3" data-aos="fade-up" data-aos-delay="400">
                        <div class="about-image">
                            <picture>
                                <img loading="lazy" data-src="<?= asset_url("public/images/404.webp") ?>" alt="<?= lang("pageNotFound") ?>" class="img-fluid lazyload">
                            </picture>
                        </div>
                    </div>
                    <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="300">
                        <!-- About Content Start -->
                        <div class="about-content-area">
                            <h2 class="title"><i class="fa-regular fa-face-sad-cry"></i> <?= lang("pageNotFound") ?></h2>
                            <p class="my-4"><?= lang("404Desc") ?></p>
                            <a rel="dofollow" href="<?= base_url() ?>" title="<?= lang("404Home") ?>" class="btn btn-default text-center mx-auto justify-content-center"><?= lang("404Home") ?></a>
                        </div>
                        <!-- About Content End -->
                    </div>

                </div>
            </div>
            <!-- About Image/Content End -->
        </div>
    </div>
    <!-- About Section End -->
</div>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($homeitems)) : ?>
    <!--Testimonial One Start-->
    <section class="testimonial-one">
        <div class="testimonial-one__shape-1 float-bob-x d-none d-xxl-block">
            <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/testimonial-one-shape-1.webp") ?>" alt="<?= $settings->company_name ?>">
        </div>
        <div class="testimonial-one__shape-3 float-bob-y d-none d-xxl-block">
            <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/testimonial-one-shape-3.webp") ?>" alt="<?= $settings->company_name ?>">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="testimonial-one__carousel owl-carousel owl-theme thm-owl__carousel" data-owl-options='{
                            "loop": true,
                            "autoplay": true,
                            "margin": 30,
                            "nav": true,
                            "dots": false,
                            "smartSpeed": 500,
                            "autoplayTimeout": 4000,
                            "navText": ["<span class=\"fa fa-arrow-left\"></span>","<span class=\"fa fa-arrow-right\"></span>"],
                            "responsive": {
                                "0": {
                                    "items": 1
                                },
                                "768": {
                                    "items": 1
                                },
                                "992": {
                                    "items": 1
                                },
                                "1200": {
                                    "items": 1
                                }
                            }
                        }'>
                        <?php foreach ($homeitems as $key => $value) : ?>
                            <?php if (strtotime($value->sharedAt) <= strtotime("now")) : ?>
                                <!--Testimonial One Single Start-->
                                <div class="item">
                                    <div class="testimonial-one__single">
                                        <div class="testimonial-one__client-img-box">
                                            <?php if (!empty($value->img_url)) : ?>
                                                <div class="testimonial-one__client-img">
                                                    <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("homeitems_v", $value->img_url) ?>" alt="<?= $value->title ?>">
                                                </div>
                                            <?php endif ?>
                                            <div class="testimonial-one__icon">
                                                <span class="fa fa-quote-left"></span>
                                            </div>
                                        </div>
                                        <div class="testimonial-one__client-info-box">
                                            <p class="testimonial-one__text"><?= clean($value->content) ?></p>
                                            <div class="testimonial-one__client-info">
                                                <h3 class="testimonial-one__client-name"><?= $value->title ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Testimonial One Single End-->
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Testimonial One End-->
<?php endif ?>
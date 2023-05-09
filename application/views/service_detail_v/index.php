<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?= $page_title ?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>



<section class="services-details-two">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="services-details-two__left">
                    <div class="services-details-two__category">
                        <ul class="services-details-two__category-list list-unstyled">
                            <?php $service_categories = $this->general_model->get_all("service_categories", null, null, ["isActive" => 1]) ?>
                            <?php if (!empty($service_categories)) : ?>
                                <?php foreach ($service_categories as $key => $value) : ?>
                                    <?php $services = $this->general_model->get_all("services", null, null, ["isActive" => 1, "category_id" => $value->id]) ?>
                                    <li class="position-relative align-items-center align-self-center align-content-center flex-grow-1 <?= $this->uri->segment(3) == $value->seo_url ? "active" : null ?>"><a href="<?= base_url(lang("routes_services") . "/" . $value->seo_url) ?>"><?= $value->title ?>
                                            <?php if (!empty($services)) : ?>
                                                <i class="fas fa-angle-right" onclick="event.preventDefault();$(this).toggleClass('rotate-angle')" data-bs-toggle="collapse" href="#collapseExample<?= $key ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?= $key ?>"></i>
                                            <?php endif ?>
                                        </a>
                                        <?php if (!empty($services)) : ?>
                                            <div class="collapse" id="collapseExample<?= $key ?>">
                                                <ul class="service-details__service-list list-unstyled">
                                                    <?php foreach ($services as $sKey => $sValue) : ?>
                                                        <li class="<?= $this->uri->segment(4) == $sValue->seo_url ? "active" : null ?>">
                                                            <a href="<?= base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $sValue->seo_url) ?>"><?= $sValue->title ?></a>
                                                        </li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        <?php endif ?>
                                    </li>
                                <?php endforeach ?>
                            <?php endif ?>
                        </ul>
                    </div>
                    <div class="services-details-two__help-line">
                        <div class="services-details-two__help-line-img">
                            <img loading="lazy" class="lazyload img-fluid" data-src="<?= asset_url("public/images/services/services-details-two-help-line-img-1.webp") ?>" alt="<?= $settings->company_name ?>">
                        </div>
                        <div class="services-details-two__help-line-content">
                            <div class="services-details-two__help-line-icon">
                                <span class="fa fa-phone-volume"></span>
                            </div>
                            <p class="services-details-two__help-line-sub-title"><?= lang("contactUs") ?></p>
                            <h3 class="services-details-two__help-number">
                                <?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
                                    <a rel="dofollow" title="<?= lang("phone") ?>" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>"><?= @json_decode($settings->phone, TRUE)[0] ?></a>
                                <?php endif ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="services-details-two__right">
                    <div class="services-details-two__img">
                        <div id="carouselExample" class="carousel slide" data-bs-ride="true">
                            <div class="carousel-inner lightgallery serviceGallery">
                                <?php $i = 0 ?>
                                <?php if (!empty($service_own_images)) : ?>
                                    <?php foreach ($service_own_images as $k => $v) : ?>
                                        <?php if ($v->service_id == $service->id) : ?>
                                            <div class="carousel-item <?= $i == 0 ? "active" : null ?>" data-index="<?= $i ?>">
                                                <a rel="dofollow" title="<?= $service->title ?>" data-exthumbimage="<?= get_picture("services_v", $v->url) ?>" href="<?= get_picture("services_v", $v->url) ?>" data-index="<?= $i ?>" class="pgImage lightimg">
                                                    <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("services_v", $v->url) ?>" title="<?= $service->title ?>" alt="<?= $service->title ?>" class="rounded img-fluid lazyload w-100 d-block">
                                                </a>
                                            </div>
                                            <?php $i++ ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                                <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-secondary border rounded" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-secondary border rounded" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="carousel-indicators serviceGalleryThumb position-relative mx-0 mx-xxl-0 mt-3">
                                <div class="d-flex">
                                    <?php $i = 0 ?>
                                    <?php if (!empty($service_own_images)) : ?>
                                        <?php foreach ($service_own_images as $k => $v) : ?>
                                            <?php if ($v->service_id == $service->id) : ?>
                                                <div data-bs-target="#carouselExample" style="max-width: 135px;" class="border <?= ($i == 0 ? "active" : null) ?>" data-bs-touch="true" data-bs-slide-to="<?= $i ?>" data-bs-image="<?= get_picture("services_v", $v->url) ?>">
                                                    <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("services_v", $v->url) ?>" title="<?= $service->title ?>" alt="<?= $service->title ?>" class="rounded lazyload img-fluid w-100 d-block">
                                                </div>
                                                <?php $i++ ?>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </div>

                                <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-prev bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-secondary border rounded" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button aria-label="<?= $settings->company_name ?>" style="box-shadow:unset!important" class="carousel-control-next bg-transparent" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-secondary border rounded" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <h3 class="services-details-two__title-1"><?= $service->title ?></h3>
                    <?php if ($service->category_title) : ?>
                        <div class="fw-bold">
                            <a rel="dofollow" title="<?= $service->category_title ?>" href="<?= base_url(lang("routes_services") . "/" . $service->category_seo_url) ?>"><?= $service->category_title ?></a>
                        </div>
                    <?php endif ?>
                    <p class="services-details-two__text-1"><?= $service->description ?></p>
                    <p class="services-details-two__text-2 border rounded p-3 mt-3" style="width: fit-content;">
                        <span class="me-2"><?= lang("shareService") ?> : </span>
                        <a class="mx-1" rel="nofollow" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-facebook"></i></a>
                        <a class="mx-1" rel="nofollow" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-twitter"></i></a>
                        <a class="mx-1" rel="nofollow" title="Linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($service->title) ?>"><i class="fa-brands fa-linkedin"></i></a>
                        <a class="mx-1" rel="nofollow" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&description=<?= urlencode($service->title) ?>"><i class="fa-brands fa-pinterest"></i></a>
                        <a class="mx-1" rel="nofollow" title="Reddit" target="_blank" href="https://www.reddit.com/submit?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($service->title) ?>"><i class="fa-brands fa-reddit"></i></a>
                        <a class="mx-1" rel="nofollow" title="Whatsapp" target="_blank" href="https://wa.me/?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-whatsapp"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        if (($('#lightgallery, .lightgallery').length > 0)) {
            $('#lightgallery, .lightgallery').lightGallery({
                selector: '.lightimg',
                loop: !0,
                thumbnail: !0,
                exThumbImage: 'data-exthumbimage',
                download: false,
            })
        }
        $(".carousel").on("slid.bs.carousel", (event) => {
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.from + "]").removeClass("active");
            $(".owl-thumb-item:not('.d-none')[data-bs-slide-to=" + event.to + "]").addClass("active");
            let x = $(".owl-thumb-item.active:not('.d-none')[data-bs-slide-to=" + event.to + "]").width();
            $('.owl-thumbs').animate({
                scrollLeft: event.to * x
            }, 500);
        });
    });
</script>